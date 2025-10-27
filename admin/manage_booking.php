<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';
include '../includes/mail_config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

// Approve / Reject / Cancel booking if requested
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    $status = '';

    if ($action === 'cancel') {
        $status = 'cancelled';
    } elseif ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    }

    if ($status) {
        // fetch room_id and user_id
        $room_id = null;
        $user_id = null;

        $res = $conn->prepare("SELECT room_id, user_id FROM bookings WHERE id = ?");
        $res->bind_param("i", $id);
        $res->execute();
        $res->bind_result($room_id, $user_id);
        $res->fetch();
        $res->close();

        $currentStatus = null;
        $stmtCheck = $conn->prepare("SELECT status FROM bookings WHERE id = ?");
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $stmtCheck->bind_result($currentStatus);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($currentStatus === $status) {
            $_SESSION['flash_msg'] = "Booking is already $status.";
            header("Location: manage_booking.php");
            exit();
        }

        // update booking status
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        if ($stmt->error) {
            die("Update failed: " . $stmt->error);
        }
        $stmt->close();

        // update room status
        if ($room_id) {
            if ($status === 'approved') {
                $up = $conn->prepare("UPDATE rooms SET status = 'booked' WHERE id = ?");
                $up->bind_param("i", $room_id);
                $up->execute();
                $up->close();
            } elseif ($status === 'cancelled' || $status === 'rejected') {
                $up = $conn->prepare("UPDATE rooms SET status = 'available' WHERE id = ?");
                $up->bind_param("i", $room_id);
                $up->execute();
                $up->close();
            }
        }

        // user email
        $userEmail = null;
        if ($user_id) {
            $stmtUser = $conn->prepare("SELECT email FROM users WHERE id = ?");
            $stmtUser->bind_param("i", $user_id);
            $stmtUser->execute();
            $stmtUser->bind_result($userEmail);
            $stmtUser->fetch();
            $stmtUser->close();
        }

        if ($userEmail) {
            if ($action === 'approve') {
                $subject = "Booking Approved";
                $body = "Congrats! Your booking for room {$room_id} has been approved.";
                sendMail($userEmail, $subject, $body);
            } elseif ($action === 'reject') {
                $subject = "Booking Rejected";
                $body = "Sorry, your booking for room {$room_id} has been rejected.";
                sendMail($userEmail, $subject, $body);
            } elseif ($action === 'cancel') {
                $subject = "Booking Cancelled";
                $body = "Your booking for room {$room_id} has been cancelled by the admin.";
                sendMail($userEmail, $subject, $body);
            }
        }

        $_SESSION['flash_msg'] = "Booking $status successfully";
        header("Location: manage_booking.php");
        exit();
    }
}

// Fetch all bookings including status
$sql = "
    SELECT
        b.id,
        u.name AS user_name,
        g.name AS guesthouse_name,
        r.room_id AS room_label,
        b.checkin_date,
        b.checkout_date,
        b.status,
        b.guest_name
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN rooms r ON b.room_id = r.id
    JOIN guesthouses g ON r.guesthouse_id = g.id
    ORDER BY b.checkin_date DESC
";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-header">
        <img src="logo.png" style="width: 180px;">
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-2">
        <li><a href="dashboard.php" class="nav-link"><i class="bi bi-house-fill"></i> Dashboard</a></li>
        <li><a href="add_user.php" class="nav-link"><i class="bi bi-person-plus"></i> Add User</a></li>
        <li><a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i> Add Guesthouse</a></li>
        <li><a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i> Add Room</a></li>
        <li><a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i> Manage Booking</a></li>
    </ul>
    <div class="p-3">
        <a href="../logout.php" class="nav-link text-dark-50"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h5>Manage</h5>
        <div class="d-flex align-items-center">
            <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <?= htmlspecialchars($_SESSION['email']); ?>
        </div>
    </div>

    <div class="container mt-4 list-group">
        <h2 class="container mt-4">Manage bookings of USERS</h2>
        <a href="dashboard.php" style="width:200px;" class="btn btn-secondary mb-4">Back to Dashboard</a>

        <?php if (!empty($_SESSION['flash_msg'])) { ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['flash_msg']) ?>
            </div>
            <?php unset($_SESSION['flash_msg']); ?>
        <?php } ?>

        <table class="table table-bordered table-striped" style="width: 50%;">
            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Guesthouse</th>
                <th>Guest Name</th>
                <th>Room</th>
                <th>CHECK-IN</th>
                <th>CHECK-OUT</th>
                <th>Status</th>
                <th style="width: 400px;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['user_name']) ?></td>
                        <td><?= htmlspecialchars($row['guesthouse_name']) ?></td>
                        <td><?= htmlspecialchars($row['guest_name']) ?></td>
                        <td><?= htmlspecialchars($row['room_label']) ?></td>
                        <td><?= htmlspecialchars($row['checkin_date']) ?></td>
                        <td><?= htmlspecialchars($row['checkout_date']) ?></td>
                        <td><span class="badge bg-info"><?= htmlspecialchars($row['status']) ?></span></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle shadow-sm"
                                        type="button" id="actionMenu<?= $row['id'] ?>"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear-fill me-1"></i>Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                                    aria-labelledby="actionMenu<?= $row['id'] ?>"
                                    style="min-width: 180px; border-radius: 8px;">
                                    <?php if ($row['status'] === 'pending') { ?>
                                        <li>
                                            <a href="manage_booking.php?action=approve&id=<?= $row['id'] ?>"
                                               class="dropdown-item d-flex align-items-center text-success fw-semibold"
                                               data-confirm="Approve this booking?">
                                                <i class="bi bi-check-circle-fill me-2"></i> Approve
                                            </a>
                                        </li>
                                        <li>
                                            <a href="manage_booking.php?action=reject&id=<?= $row['id'] ?>"
                                               class="dropdown-item d-flex align-items-center text-warning fw-semibold"
                                               data-confirm="Reject this booking?">
                                                <i class="bi bi-x-circle-fill me-2"></i> Reject
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php } ?>
                                    <?php if ($row['status'] !== 'cancelled') { ?>
                                        <li>
                                            <a href="manage_booking.php?action=cancel&id=<?= $row['id'] ?>"
                                               class="dropdown-item d-flex align-items-center text-danger fw-semibold"
                                               data-confirm="Cancel this booking?">
                                                <i class="bi bi-slash-circle-fill me-2"></i> Cancel
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>NO Booking FOUND</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SIDEBAR TOGGLE SCRIPT -->
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
    }

    // Highlight current sidebar menu based on URL
    const links = document.querySelectorAll('.sidebar .nav-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ensure links inside dropdown menus actually work
        document.querySelectorAll(".dropdown-menu a").forEach(link => {
            link.addEventListener("click", function (e) {
                e.stopPropagation();
                const confirmMsg = this.getAttribute("data-confirm");
                if (!confirmMsg || confirm(confirmMsg)) {
                    window.location.href = this.getAttribute("href");
                }
            });
        });
    });
</script>

</body>
</html>
