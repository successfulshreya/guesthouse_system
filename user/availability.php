<?php
session_start();

// Check if user is logged in and has role 'user'; otherwise redirect to login/home
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';  // include DB connection (defines $conn)

// Fetch list of guesthouses (id, name) to populate the dropdown in the form
$gh_result = $conn->query("SELECT id, name FROM guesthouses ORDER BY name");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  </style>
    </head>
    <body>


      <!-- Sidebar -->
  <nav class="sidebar d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
      <i class="bi bi-gear-fill fs-4"></i>
      <span class="fs-4"> <b>User</b>
        </span>
    </a>
    <hr>
    
    <ul class="nav nav-pills flex-column">
     <li class="nav-item">
         <a href="Dashboard.php" class="nav-link"><i class="bi bi-building"></i> Dashboard</a>
       </li>

      <li class="nav-item">
        <a href="availability.php" class="nav-link"><i class="bi bi-building"></i> Availability</a>
      </li>
      <li class="nav-item">
        <a href="my_booking.php" class="nav-link"><i class="bi bi-door-open"></i>My Bookings</a>
      </li>
      <li class="nav-item">
        <a href="book_room.php" class="nav-link"><i class="bi bi-calendar-check"></i> Book Room</a>
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


<div class="container my-4"><br>
    <h2>Check Room Availability</h2>

    <!-- Form for user to choose guesthouse and date range -->
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <!-- Guesthouse dropdown -->
            <div class="col-md-4">
                <label class="form-label">Guesthouse</label>
                <select name="guesthouse_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    <?php while ($r = $gh_result->fetch_assoc()): ?>
                        <option value="<?php echo $r['id']; ?>"
                            <?php if (isset($_GET['guesthouse_id']) && $_GET['guesthouse_id'] == $r['id']) echo 'selected'; ?>>
                            <?= htmlspecialchars($r['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Check-in date input -->
            <div class="col-md-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="checkin" class="form-control"
                       value="<?= isset($_GET['checkin']) ? htmlspecialchars($_GET['checkin']) : '' ?>"
                       min="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Check-out date input -->
            <div class="col-md-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="checkout" class="form-control"
                       value="<?= isset($_GET['checkout']) ? htmlspecialchars($_GET['checkout']) : '' ?>"
                       min="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Submit button -->
            <div class="col-md-2 align-self-end">
                <button class="btn btn-primary w-100">Check</button>
            </div>
        </div>
    </form>

<?php
// Only run this block if the form was submitted with all required fields
if (isset($_GET['guesthouse_id'], $_GET['checkin'], $_GET['checkout'])) {
    $guesthouse_id = intval($_GET['guesthouse_id']);
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    $today = date('Y-m-d');

    // Validate dates
    if ($checkin < $today) {
        echo "<div class='alert alert-danger'>Check-in date cannot be in the past.</div>";
    } elseif ($checkout < $checkin) {
        echo "<div class='alert alert-danger'>Check-out date must be after check-in date.</div>";
    } else {
        // Prepare SQL to fetch all rooms in the selected guesthouse
        $rooms_stmt = $conn->prepare("SELECT id, room_id FROM rooms WHERE guesthouse_id = ?");
        $rooms_stmt->bind_param("i", $guesthouse_id);
        $rooms_stmt->execute();
        $rooms_result = $rooms_stmt->get_result();

        if ($rooms_result->num_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($room = $rooms_result->fetch_assoc()) {
                $room_id = $room['id'];

                // Check booking overlap
                $book_stmt = $conn->prepare("
                    SELECT 1 FROM bookings
                    WHERE room_id = ?
                      AND checkin_date < ?
                      AND checkout_date > ?
                ");
                $book_stmt->bind_param("iss", $room_id, $checkout, $checkin);
                $book_stmt->execute();
                $book_stmt->store_result();

                if ($book_stmt->num_rows > 0) {
                    echo "<tr>
                            <td>" . htmlspecialchars($room['room_id']) . "</td>
                            <td><span class='badge bg-danger'>Booked</span></td>
                            <td>-</td>
                          </tr>";
                } else {
                    echo "<tr>
                            <td>" . htmlspecialchars($room['room_id']) . "</td>
                            <td><span class='badge bg-success'>Available</span></td>
                            <td>
                                <form method='POST' action='book_room.php' class='m-0'>
                                    <input type='hidden' name='guesthouse_id' value='$guesthouse_id'>
                                    <input type='hidden' name='room_id' value='$room_id'>
                                    <input type='hidden' name='checkin_date' value='$checkin'>
                                    <input type='hidden' name='checkout_date' value='$checkout'>
                                    <button class='btn btn-sm btn-primary'>Book Now</button>
                                </form>
                            </td>
                          </tr>";
                }

                $book_stmt->close();
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>No rooms found for this guesthouse.</div>";
        }
    }
}
?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>
