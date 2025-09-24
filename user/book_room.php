
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';

$gh_result = $conn->query("SELECT id, name, address FROM guesthouses ORDER BY name");

$msg = '';
if (isset($_GET['success'])) {
    $msg = "Room booked successfully!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $guesthouse_id = intval($_POST['guesthouse_id']);
    $room_id = intval($_POST['room_id']);
    $checkin_date = trim($_POST['checkin_date']);
    $checkout_date = trim($_POST['checkout_date']);

    if ($guesthouse_id && $room_id && $checkin_date && $checkout_date) {
        // Check if the room is already booked for the selected dates
        $stmt = $conn->prepare("SELECT id FROM bookings WHERE room_id = ? AND checkin_date < ? AND checkout_date > ?");
        $stmt->bind_param("iss", $room_id, $checkout_date, $checkin_date);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Room is already booked for the selected dates.";
        } else {
            // Proceed to insert booking
               $stmt->close();
                $stmt = $conn->prepare( "INSERT INTO bookings (user_id,  room_id, checkin_date, checkout_date) VALUES (?, ?, ?, ?)");
             if ($stmt === false) {
                 die("Prepare failed: " . htmlspecialchars($conn->error));}
                $stmt->bind_param("iiss", $user_id,  $room_id, $checkin_date, $checkout_date);
             
                if ($stmt->execute()) {
                     $stmt->close();
                     header("Location: book_room.php?success=1");
                    exit();
                      } else {
                          $msg = "Error: " . htmlspecialchars($stmt->error);
                        }
                 }
                   $stmt->close();
                   } else {
                            $msg = "Please fill all required fields.";
                       }
                    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
        //fetching rooms dynamically based on guesthouse
        function loadRooms(ghld) {
            if (!ghld) {
                document.getElementById("roomSelect").innerHTML = "<option value=''>Select guesthouse first</option>";
                return;
            }
            fetch("get_room.php?guesthouse_id=" + ghld)
            .then(res=>res.text())
            .then(data=>{
                document.getElementById("roomSelect").innerHTML = data;
            })
            .catch(err =>{
                console.error("Error fetching roooms:",err);
            });
            
        }
    </script>
</head>
<body class="container mb-3">
    <h2>Book Rooms</h2>

    <?php if (!empty($msg)): ?>
        <div class='alert alert-info'><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST">
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
