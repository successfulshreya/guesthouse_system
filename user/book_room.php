<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

// fetch guesthouses
$gh_result = $conn->query("SELECT id, name, address FROM guesthouses ORDER BY name");

$msg = '';
if (isset($_GET['success'])) {
    $msg = "Room booked successfully!";
}

// handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $guesthouse_id = intval($_POST['guesthouse_id']);
    $room_id = intval($_POST['room_id']);
    $checkin_date = trim($_POST['checkin_date']);
    $checkout_date = trim($_POST['checkout_date']);
    $guest_name = trim($_POST['guest_name']);
    $guest_designation = trim($_POST['guest_designation']);

    if ($guesthouse_id && $room_id && $checkin_date && $checkout_date && $guest_name) {
        // check room availability
        $stmt = $conn->prepare("SELECT id FROM bookings WHERE room_id = ? AND checkin_date < ? AND checkout_date > ? AND status IN ('pending','approved')");
        $stmt->bind_param("iss", $room_id, $checkout_date, $checkin_date);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Room is already booked for the selected dates.";
        } else {
            $stmt->close();

            // insert booking with guest info and pending status
            $stmt = $conn->prepare(
                "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, guest_name, guest_designation, status)
                 VALUES (?, ?, ?, ?, ?, ?, 'pending')"
            );
            $stmt->bind_param("iissss", $user_id, $room_id, $checkin_date, $checkout_date, $guest_name, $guest_designation);

            if ($stmt->execute()) {
                $stmt->close();
                // mark room as booked
                $up = $conn->prepare("UPDATE rooms SET status='booked' WHERE id=?");
                $up->bind_param("i", $room_id);
                $up->execute();
                $up->close();

                header("Location: book_room.php?success=1");
                exit();
            } else {
                $msg = "Error: " . htmlspecialchars($stmt->error);
            }
        }
        $stmt->close();
    } else {
        $msg = "Please fill all required fields (Guest Name, Guesthouse, Room, Dates).";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Fetch rooms dynamically based on guesthouse
        function loadRooms(guesthouseId) {
            if (!guesthouseId) {
                document.getElementById("roomSelect").innerHTML = "<option value=''>Select guesthouse first</option>";
                return;
            }
            fetch("get_room.php?guesthouse_id=" + guesthouseId)
            .then(res => res.text())
            .then(data => {
                document.getElementById("roomSelect").innerHTML = data;
            })
            .catch(err => console.error("Error fetching rooms:", err));
        }
    </script>
</head>
<body class="container mb-3">
    <h2 class="mt-3 mb-3">Book Rooms for Guests</h2>

    <?php if (!empty($msg)): ?>
        <div class='alert alert-info'><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="guest_name" class="form-label">Guest Name</label>
            <input type="text" name="guest_name" id="guest_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="guest_designation" class="form-label">Guest Designation</label>
            <input type="text" name="guest_designation" id="guest_designation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="guesthouse_id" class="form-label">Guesthouse</label>
            <select name="guesthouse_id" id="guesthouse_id" class="form-control" required onchange="loadRooms(this.value)">
                <option value="">Select a guesthouse</option>
                <?php
                if ($gh_result) {
                    while ($row = $gh_result->fetch_assoc()) {
                        echo '<option value="' . intval($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room</label>
            <select name="room_id" id="roomSelect" class="form-control" required>
                <option value="">Select a room</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="checkin_date" class="form-label">Check-in Date</label>
            <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="checkout_date" class="form-label">Check-out Date</label>
            <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
        </div>

        <button class="btn btn-primary">Book Room</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>
