<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}
?>

<?php
include '../db_connect.php';
$guesthouse_id = 13; 

// Prepare the SQL statement.
$sql = "SELECT r.id, r.room_id, IF(b.id IS NOT NULL, 'booked', 'available') AS today_status 
        FROM rooms r
        LEFT JOIN bookings b ON r.id = b.room_id AND CURDATE() BETWEEN b.checkin_date AND b.checkout_date 
        WHERE r.guesthouse_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $guesthouse_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Panel Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div>
        <div class="sidebar-header">
          <img src="../admin/logo.png" alt="Logo" style="width: 180px;" ><br>
            <div class="user-title" style="font-family:Georgia, 'Times New Roman', Times, serif">USER</div>
            <div class="user-subtitle">Dashboard</div>
        </div>

        <ul class="nav nav-pills flex-column">
            <li class="nav-item"><a href="dashboard.php" class="nav-link active"><i class="bi bi-house-fill"></i> Dashboard</a></li>
            <li class="nav-item"><a href="availability.php" class="nav-link"><i class="bi bi-building"></i> Availability</a></li>
            <li class="nav-item"><a href="my_booking.php" class="nav-link"><i class="bi bi-card-list"></i> My Bookings</a></li>
            <li class="nav-item"><a href="book_room.php" class="nav-link"><i class="bi bi-calendar-check"></i> Book Room</a></li>
            <li class="nav-item"><a href="report.php" class="nav-link"><i class="bi bi-journal"></i> Booking Report</a></li>
        </ul>
    </div>

    <div class="p-3">
        <a href="../logout.php" class="nav-link text-muted"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0">Dashboard</h5>
        <div class="d-flex align-items-center">
            <h6 class="mb-0 me-3" style="color:chocolate;">SARDA ENERGY and MINERALS LTD </h6>
            <?php echo htmlspecialchars($_SESSION['email']) ?>
            <i class="bi bi-person-circle fs-2 ms-2"></i>
        </div>
    </div>

        <div class="avail">
            <!-- VIP Karishma -->
            <div>
                <h6>Today's Room Availability <b style="color: #4556e9ff;">[VIP KARISHMA (RAIPUR)]</b></h6>
                <div class="room-container">
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <div class="room-box <?= $row['today_status']=='available' ? 'room-available' : 'room-booked' ?>">
                            <?= htmlspecialchars($row['room_id']) ?><br>
                            <strong><?= ucfirst($row['today_status']) ?></strong>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Colony Siltara -->
            <div>
                <h6>Today's Room Availability <b style="color: #3f4aeeff;">[COLONY (Siltara)]</b></h6>
                <div class="room-container">
                    <!-- Example, replace with actual PHP loop if data available -->
                    <div class="room-box room-available">101<br><strong>Available</strong></div>
                    <div class="room-box room-booked">102<br><strong>Booked</strong></div>
                    <div class="room-box room-available">103<br><strong>Available</strong></div>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="my_booking.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-door-open"></i>
                            </div>
                            <h5 class="card-title mb-0">My Bookings</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="book_room.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h5 class="card-title mb-0">Book a Room</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="availability.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-building"></i>
                            </div>
                            <h5 class="card-title mb-0">Check Available Rooms</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
