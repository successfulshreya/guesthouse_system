<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

$user_id = $_SESSION['user_id'];
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$data = [];

if ($from && $to) {
    $sql = "SELECT b.*, r.room_id AS room_label
            FROM bookings b
            JOIN rooms r ON b.room_id = r.id
            WHERE b.user_id = ?
            AND b.checkin_date BETWEEN ? AND ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Prepare Failed: " . $conn->error);  // helpful debugging
    }

    $stmt->bind_param("iss", $user_id, $from, $to);
    $stmt->execute();
    $data = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
        }

         body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5; /* Light gray background for a modern feel */
        }
        .sidebar {
            width: 250px; /* Slightly wider sidebar */
            background: #212529; /* Darker background for more contrast */
            color: #fff;
            flex-shrink: 0;
            transition: width 0.3s;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #495057;
        }
        .sidebar .nav-link {
            color: #adb5bd; /* Lighter gray text */
            padding: 15px 20px;
        }
        .sidebar .nav-link.active {
            background: #495057;
            color: #fff;
            border-left: 3px solid #0d6efd; /* Highlight active link */
        }
        .sidebar .nav-link:hover {
            background: #343a40;
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
           .topbar {
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
            border-radius: 8px; /* Rounded corners for the topbar */
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Subtle shadow */
        }
    </style>
</head>
    <body>
            <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column">
            <div class="sidebar-header">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none">
                                    <i class="bi bi-people fs-1"></i>
                                    <span class="fs-4 ms-3"><h5>USER<h6 class="text-white-50">(Book Room)</h6></h5></span>
                        </a>
            </div>
            <ul class="nav nav-pills flex-column flex-grow-1 p-3">
                        <li class="nav-item">
                                    <a href="availability.php" class="nav-link"><i class="bi bi-building"></i> Availability</a>
                        </li>
                        <li class="nav-item">
                                    <a href="my_booking.php" class="nav-link"><i class="bi bi-door-open"></i> My Bookings</a>
                        </li>
                        <li class="nav-item">
                                    <a href="book_room.php" class="nav-link"><i class="bi bi-calendar-check"></i> Book Room</a>
                        </li>
                           <li class="nav-item">
                                    <a href="report.php" class="nav-link"><i class="bi bi-journal"></i>Booking Report</a>
                        </li>
            </ul>
            <div class="p-3">
                        <a href="../logout.php" class="nav-link text-white-50"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </nav>

        <!-- Main content area -->
            <div class="main-content">
            <div class="topbar">
                        <h5 class="mb-0">Dashboard</h5>
                        <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-3" style="color:chocolate;">SARDA ENERGY and MINERALS LTD</h6>
                                    <span>Welcome, User</span>
                        </div>
            </div>
        
    <h3>Booking Report</h3>

    <form method="get">
        <label>From:</label>
        <input type="date" name="from" required value="<?= htmlspecialchars($from) ?>">

        <label>To:</label>
        <input type="date" name="to" required value="<?= htmlspecialchars($to) ?>">

        <button type="submit">View</button>
    </form>

    <?php if ($from && $to): ?>
        <?php if ($data && $data->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total Cost (Rs)</th>
                </tr>
                <?php while ($b = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($b['room_label']) ?></td>
                        <td><?= htmlspecialchars($b['checkin_date']) ?></td>
                        <td><?= htmlspecialchars($b['checkout_date']) ?></td>
                        <td>Rs <?= number_format($b['total_cost'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No bookings found in this date range.</p>
        <?php endif; ?>
        <?php endif; ?>
    </body>
</html>
