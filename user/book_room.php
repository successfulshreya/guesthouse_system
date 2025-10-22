<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';
include '../includes/mail_config.php';

// fetch guesthouses
$gh_result = $conn->query("SELECT id, name, address FROM guesthouses ORDER BY name");

$msg='';
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
            // $stmt_rate = $conn->prepare(
            //     "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, guest_name, guest_designation, status)
            //      VALUES (?, ?, ?, ?, ?, ?, 'pending')"
            // );
              $stmt_rate = $conn->prepare("SELECT 
              rate_per_day FROM rooms WHERE id=?");
              $stmt_rate->bind_param("i",$room_id);
              $stmt_rate->execute();
              $res_rate = $stmt_rate->get_result();
              $room = $res_rate->fetch_assoc();
              $rate = $room['rate_per_day'];
              $stmt_rate->close();


             // calculate days
             $days = (strtotime($checkout_date) - strtotime($checkin_date))/(60*60*24);
             if($days<1) $days= 1;

             $total_cost = $days * $rate;

             // insert booking with totalcost
            $stmt = $conn->prepare(
                "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date,
                 guest_name, guest_designation, status, total_cost)
                 VALUES (?, ?, ?, ?, ?, ?, 'pending',?)"
            );


            $stmt->bind_param("iissssi", $user_id, $room_id, $checkin_date, $checkout_date, $guest_name,
             $guest_designation, $total_cost);

            if ($stmt->execute()) {
                $stmt->close();

                // ✅ abhi yaha mail bhejna hai
                $admin_email = "shreyasahuu01@gmail.com";
                $subject = "New Room Booking Request";
                $body = "<h3>New Room Booking Request</h3>
                         <p>User <b>{$user_id}</b> has made a new booking request for room <b>{$room_id}</b>.</p>
                         <p>Check-in: {$checkin_date}</p>
                         <p>Check-out: {$checkout_date}</p>
                         <p>Guest Name: {$guest_name}</p>
                         <p>Guest Designation: {$guest_designation}</p>";

                sendMail($admin_email, $subject, $body);

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
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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
    <style>
      body {
        min-height: 100vh;
        display: flex;
      }
      /* .sidebar {
        width: 220px;
        background: #343a40;
        color: #fff;
        flex-shrink: 0;
      }
      .sidebar .nav-link { color: #ddd; }
      .sidebar .nav-link.active { background: #495057; color: #fff; }
      .sidebar .nav-link:hover { background: #495057; color: #fff; }
      .sidebar .nav-link i { margin-right: 8px; } */
      .main-content { flex-grow: 1; padding: 20px; }
      .topbar {
        height: 60px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        border-bottom: 1px solid #e0e0e0;
      }
      .card-action { cursor: pointer; transition: transform 0.2s, box-shadow 0.2s; }
      .card-action:hover { transform: translateY(-4px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
  <nav class="sidebar d-flex flex-column">
    <div class="sidebar-header">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none">
            <i class="bi bi-people fs-1"></i>
            <span class="fs-4 ms-3"><H6>USER<br><h6 class="text-white-50">(Book Room)</h6></H6></span>
        </a>
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-3">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link"><i class="bi bi-building"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="availability.php" class="nav-link"><i class="bi bi-building"></i> Availability</a>
        </li>
        <li class="nav-item">
            <a href="my_booking.php" class="nav-link"><i class="bi bi-door-open"></i> My Bookings</a>
        </li>
        <li class="nav-item">
            <a href="book_room.php" class="nav-link"><i class="bi bi-calendar-check"></i> Book Room</a>
        </li>
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
        </div>
    </div>

    <div class="container mb-3"><br>
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

        <div class="mb-3">
        <label>Rate per Day: Rs.<span id="rate">1200</span></label><br>
        <label>Total Cost: Rs.<span id="total_cost">0</span></label>
        </div>

          <button class="btn btn-primary">Book Room</button>
          <a href="dashboard.php" class="btn btn-secondary">Back</a>
      </form>
    </div>
  </div>

  <script>
    const roomSelect = document.getElementById('roomSelect');
    const rateSpan = document.getElementById('rate');
    const totalSpan = document.getElementById('total_cost');
    const checkin = document.getElementById('checkin_date');
    const checkout = document.getElementById('checkout_date');

    function calcTotal() {
    const rate = parseFloat(rateSpan.textContent);
    const inDate = new Date(checkin.value);
    const outDate = new Date(checkout.value);

    // Get the difference in milliseconds, then convert to days
    const diff = (outDate - inDate) / (1000 * 60 * 60 * 24);

    // Update the total cost if the difference is a valid positive number
    if (diff > 0) {
        totalSpan.textContent = (diff * rate).toFixed(2);
    } else {
        totalSpan.textContent = '0';
    }
     }

      checkin.addEventListener('change', calcTotal);
      checkout.addEventListener('change', calcTotal);

      roomSelect.addEventListener('change', function() {
      const roomId = this.value;
     
     if(!roomId) {
           rateSpan.textContent = '0';
           totalSpan.textContent = '0';
           return;
     }
     
     fetch('get_room_rate.php?room_id=' + encodeURIComponent(roomId))
           .then(res => res.text())
           .then(rate => {
                  rateSpan.textContent = rate;
                  calcTotal();
           })
           .catch(error => {
                  // Log the error to the console for debugging
                  console.error('Failed to fetch room rate:', error);
                  rateSpan.textContent = 'Error';
                  totalSpan.textContent = 'Error';
           });
    });

</script>
</body>
</html>
