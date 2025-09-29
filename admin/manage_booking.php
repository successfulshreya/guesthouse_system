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

// Cancel booking, if requested
if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $cancel_id);
    $stmt->execute();
    if ($stmt->error) {
        die("Delete failed: " . $stmt->error);
    }
    $stmt->close();
    $msg = "Booking cancelled successfully";
}

// Fetch all bookings with correct table name and alias
$sql = "
    SELECT
        b.id,
        u.name AS user_name,
        g.name AS guesthouse_name,
        r.room_id AS room_label,
        b.checkin_date,
        b.checkout_date
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
</head>
<body class="bg-light">
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
                                <a href="?cancel_id=<?= $row['id'] ?>"
                                   onclick="return confirm('Cancel this booking?')"
                                   class="btn btn-danger btn-sm">Cancel</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>NO Booking FOUND</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
