<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

$user_id = $_SESSION['user_id'];

// handle user cancel request
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // get room id for this booking (might be null if room deleted)
    $res = $conn->prepare("SELECT room_id FROM bookings WHERE id = ? AND user_id = ?");
    $res->bind_param("ii", $id, $user_id);
    $res->execute();
    $res->bind_result($room_id);
    $res->fetch();
    $res->close();

    if ($room_id) {
        // update booking status
        $stmt = $conn->prepare("UPDATE bookings SET status='cancelled' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
        $stmt->close();

        // mark room as available again
        $up = $conn->prepare("UPDATE rooms SET status='available' WHERE id = ?");
        $up->bind_param("i", $room_id);
        $up->execute();
        $up->close();

        $msg = "Booking cancelled successfully.";
    } else {
        // only update booking if room already deleted
        $stmt = $conn->prepare("UPDATE bookings SET status='cancelled' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
        $stmt->close();
        $msg = "Booking cancelled successfully (room already deleted).";
    }
}

// fetch bookings with join to get room and guesthouse details + status
$sql = "SELECT 
            b.id, 
            g.name AS guesthouse_name, 
            r.room_id, 
            b.checkin_date, 
            b.checkout_date,
            b.status
        FROM bookings b
        LEFT JOIN rooms r ON b.room_id = r.id
        LEFT JOIN guesthouses g ON r.guesthouse_id = g.id
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mb-3">
    <h2 class="mt-3 mb-3">My Bookings</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Guesthouse</th>
                    <th>Room ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= $row['guesthouse_name'] ? htmlspecialchars($row['guesthouse_name']) : 'Deleted Guesthouse' ?></td>
                        <td><?= $row['room_id'] ? htmlspecialchars($row['room_id']) : 'Deleted Room' ?></td>
                        <td><?= htmlspecialchars($row['checkin_date']) ?></td>
                        <td><?= htmlspecialchars($row['checkout_date']) ?></td>
                        <td>
                            <span class="badge bg-info"><?= htmlspecialchars($row['status']) ?></span>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'pending' || $row['status'] === 'approved'): ?>
                                <a href="?action=cancel&id=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Cancel this booking?')">Cancel</a>
                            <?php else: ?>
                                <em>N/A</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No booking found.</div>
    <?php endif; ?>
</body>
</html>
