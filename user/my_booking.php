<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

$user_id = $_SESSION['user_id'];

// fetch bookings with join to get room and guesthouse details
$sql = "SELECT 
            b.id, 
            g.name AS guesthouse_name, 
            r.room_id, 
            b.checkin_date, 
            b.checkout_date 
        FROM bookings b
        JOIN rooms r ON b.room_id = r.id
        JOIN guesthouses g ON r.guesthouse_id = g.id
        WHERE b.user_id = ? 
        ORDER BY b.checkin_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container mb-3">
    <h2 class="mt-3 mb-3">My Bookings</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Guesthouse</th>
                    <th>Room ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['guesthouse_name']) ?></td>
                        <td><?= htmlspecialchars($row['room_id']) ?></td>
                        <td><?= htmlspecialchars($row['checkin_date']) ?></td>
                        <td><?= htmlspecialchars($row['checkout_date']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No booking found.</div>
    <?php endif; ?>
</body>
</html>
