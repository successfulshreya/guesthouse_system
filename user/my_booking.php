<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';
include '../includes/mail_config.php';

$user_id = $_SESSION['user_id']; // ✅ pehle hi set kar liya
$msg = '';

// handle user cancel request
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // get room id for this booking
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

        // ✅ send cancellation mail
        $admin_email = "shreyasahuu01@gmail.com";
        $subject = "Booking Cancelled by User";
        $body = "User <b>{$user_id}</b> has cancelled their booking (Booking ID: {$id}). Please review.";
        sendMail($admin_email, $subject, $body);

    } else {
        // only update booking if room already deleted
        $stmt = $conn->prepare("UPDATE bookings SET status='cancelled' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
        $stmt->close();
        $msg = "Booking cancelled successfully (room already deleted).";

        // ✅ send mail in this case also
        $admin_email = "shreyasahuu01@gmail.com";
        $subject = "Booking Cancelled by User";
        $body = "User <b>{$user_id}</b> cancelled a booking (ID: {$id}) but room was already deleted.";
        sendMail($admin_email, $subject, $body);
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
    <link rel="stylesheet" href="../style.css">
      <!--  Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>

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
<body>

 <body style="display: flex; min-height: 100vh; background: #f0f2f5;">

<!--  Sidebar -->
<nav class="sidebar d-flex flex-column p-3">
    <div class="sidebar-header text-center mb-3">
        <i class="bi bi-people fs-1"></i>
        <div class="mt-2"><strong>USER</strong></div>
        <small class="text-white-50">(Reports)</small>
    </div>

    <ul class="nav nav-pills flex-column">
        
        <li class="nav-item"><a href="dashboard.php" class="nav-link text-light"><i class="bi bi-building"></i> Dashboard</a></li>
        <li class="nav-item"><a href="availability.php" class="nav-link text-light"><i class="bi bi-building"></i> Availability</a></li>
        <li class="nav-item"><a href="my_booking.php" class="nav-link text-light"><i class="bi bi-door-open"></i> My Bookings</a></li>
        <li class="nav-item"><a href="book_room.php" class="nav-link text-light"><i class="bi bi-calendar-check"></i> Book Room</a></li>
        <li class="nav-item"><a href="report.php" class="nav-link active text-light"><i class="bi bi-journal"></i> Booking Report</a></li>
    </ul>

    <div class="mt-auto p-3">
        <a href="../logout.php" class="nav-link text-white-50"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</nav>

<!--  Main content -->
<div class="main-content flex-grow-1">

    <!--  Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">My Booking </h5>
            <small class="text-muted">View your bookings</small>
        </div>
        <div>
            <strong style="color:chocolate">SARDA ENERGY and MINERALS LTD</strong>
        </div>
    </div>

 

    <div class="container mb-3"><br>
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
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>
