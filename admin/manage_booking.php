<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        // fetch the room id for this booking (needed to update room availability)
        $room_id = null;
        $res = $conn->prepare("SELECT room_id FROM bookings WHERE id = ?");
        $res->bind_param("i", $id);
        $res->execute();
        $res->bind_result($room_id);
        $res->fetch();
        $res->close();

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

        // automatically update room status based on booking status
        if ($room_id) {
            if ($status === 'approved') {
                // mark the room as booked
                $up = $conn->prepare("UPDATE rooms SET status = 'booked' WHERE id = ?");
                $up->bind_param("i", $room_id);
                $up->execute();
                $up->close();
            } elseif ($status === 'cancelled' || $status === 'rejected') {
                // mark the room as available
                $up = $conn->prepare("UPDATE rooms SET status = 'available' WHERE id = ?");
                $up->bind_param("i", $room_id);
                $up->execute();
                $up->close();
            }
        }

        $msg = "Booking $status successfully";
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
        b.status
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

             <style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 220px;
      background: #343a40;
      color: #fff;
      flex-shrink: 0;
    }
    .sidebar .nav-link {
      color: #ddd;
    }
    .sidebar .nav-link.active {
      background: #495057;
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background: #495057;
      color: #fff;
    }
    .sidebar .nav-link i {
      margin-right: 8px;
    }
    .main-content {
      flex-grow: 1;
      padding: 20px;
    }
    .topbar {
      height: 60px;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      border-bottom: 1px solid #e0e0e0;
    }
    .card-action {
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-action:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style> <style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .sidebar {
      width: 220px;
      background: #343a40;
      color: #fff;
      flex-shrink: 0;
    }
    .sidebar .nav-link {
      color: #ddd;
    }
    .sidebar .nav-link.active {
      background: #495057;
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background: #495057;
      color: #fff;
    }
    .sidebar .nav-link i {
      margin-right: 8px;
    }
    .main-content {
      flex-grow: 1;
      padding: 20px;
    }
    .topbar {
      height: 60px;
      background: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      border-bottom: 1px solid #e0e0e0;
    }
    .card-action {
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-action:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body >
      <nav class="sidebar d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
      <i class="bi bi-gear-fill fs-4"></i>
      <span class="fs-4">Admin</span>
    </a>
    <hr>
     <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link active"><i class="bi bi-pc"></i> Dashboard</a>
      </li>

      <li class="nav-item">
        <a href="add_user.php" class="nav-link "><i class="bi bi-person-fill"></i> Add Employee</a>
      </li>
      <li class="nav-item">
        <a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i> Add Guesthouse</a>
      </li>
      <li class="nav-item">
        <a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i> Add Room</a>
      </li>
      <li class="nav-item">
        <a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i> Manage Booking</a>
      </li>
      <li class="nav-item mt-auto">
        <a href="../logout.php" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </li>
    </ul>
  </nav>
    <!-- Main content area -->
    <div class="main-content">
      <div class="topbar">
        <h5>Dashboard</h5>
         <h4>SARDA ENERY and MINERALS LTD</h4>
        <div>
          <span class="me-3">Welcome, Admin</span>
         
        </div>
</div>


    <div class="container mt-4 list-group">
        <h2 class="container mt-4">Manage bookings of USERS</h2>
        <a href="dashboard.php" style="width:200px;" class="btn btn-secondary mb-4">Back to Dashboard</a>

        <?php if (!empty($msg)) { ?>
            <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
        <?php } ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Guesthouse</th>
                    <th>Room</th>
                    <th>CHECK-IN</th>
                    <th>CHECK-OUT</th>
                    <th>Status</th>
                    <th>Action</th>
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
                            <td><?= htmlspecialchars($row['room_label']) ?></td>
                            <td><?= htmlspecialchars($row['checkin_date']) ?></td>
                            <td><?= htmlspecialchars($row['checkout_date']) ?></td>
                            <td>
                                <span class="badge bg-info"><?= htmlspecialchars($row['status']) ?></span>
                            </td>
                            <td>
                                <?php if ($row['status'] === 'pending') { ?>
                                    <a href="?action=approve&id=<?= $row['id'] ?>" 
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Approve this booking?')">Approve</a>
                                    <a href="?action=reject&id=<?= $row['id'] ?>" 
                                       class="btn btn-warning btn-sm"
                                       onclick="return confirm('Reject this booking?')">Reject</a>
                                <?php } ?>
                                <?php if ($row['status'] !== 'cancelled') { ?>
                                    <a href="?action=cancel&id=<?= $row['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Cancel this booking?')">Cancel</a>
                                <?php } ?>
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
</body>
</html>
