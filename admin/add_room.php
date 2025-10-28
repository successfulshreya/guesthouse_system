<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';

// fetch guesthouses for select box
$gh_result = $conn->query("SELECT id, name FROM guesthouses ORDER BY name");

$msg = '';
if(isset($_GET['success'])){
    $msg="Room Added Successfully :) !!";
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // get inputs safely
    $guesthouse_id = intval($_POST['guesthouse_id'] ?? 0);
    $room_id = trim($_POST['room_id'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $rate_per_day = floatval($_POST['rate_per_day'] ?? 0);

    if ($guesthouse_id <= 0 || $room_id === '' || $status === '' || $rate_per_day <= 0) {
        $msg = "Please fill all the fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO rooms (guesthouse_id, room_id, status,rate_per_day) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $guesthouse_id, $room_id, $status,$rate_per_day);

        if ($stmt->execute()) {
            // $msg = "Room added successfully.";
            header("Location:add_room.php?success=1");
            exit();
        } else {
            $msg = "Error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

             <style>
  /* body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5;
        }
        .sidebar {
            width: 250px;
            background: #0974dfff;
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
            color: #adb5bd;
            padding: 15px 20px;
        }
        .sidebar .nav-link.active {
            background: #495057;
            color: #fff;
            border-left: 3px solid #0d6efd;
        }
        .sidebar .nav-link:hover {
            background: #428bd4ff;
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
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
    
    .card-action {
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-action:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    } */
  
  </style>
</head>
<body >

<!-- SIDEBAR -->
<nav class="sidebar d-flex flex-column" id="sidebar">
   <div class="sidebar-header">
            <img src="logo.png" alt="Logo" style="width: 180px;" ><br><br>
                <div class="user-title" style="font-family:Georgia, 'Times New Roman', Times, serif">ADMIN</div>
            <div class="user-subtitle">Dashboard</div>
        </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-2">
          <li><a href="dashboard.php" class="nav-link"><i class="bi bi-house-fill"></i> Dashboard</span></a></li>
        <li><a href="add_user.php" class="nav-link"><i class="bi bi-person-plus"></i><span> Add User</span></a></li>
        <li><a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i><span> Add Guesthouse</span></a></li>
        <li><a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i><span> Add Room</span></a></li>
        <li><a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i><span> Manage Booking</span></a></li>
    </ul>
    <div class="p-3">
         <a href="../logout.php" class="nav-link text-dark-50"><i class="bi bi-box-arrow-right"></i><span> Logout</span></a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h5>Add Room</h5>
        <div class="d-flex align-items-center">
            <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i></button>
           <?php echo htmlspecialchars($_SESSION['email']); ?>
        </div>
    </div>


   
    <div class="container mt-4">
    <h2>Add Room</h2>

    <?php if ($msg): ?>
        <div class='alert alert-info'><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="guesthouse_id" class="form-label">Guesthouse</label>
            <select name="guesthouse_id" id="guesthouse_id" class="form-control" required>
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
            <label for="room_id" class="form-label">Room Number</label>
            <input type="text" name="room_id" id="room_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

           <div class="mb-3">
            <label for="rate_per_day" class="form-label">Rate per day(rs.)</label>
            <input type="number" name="rate_per_day" id="rate_per_day" class="form-control" step="0.01" required>
        </div> 

        <button type="submit" class="btn btn-primary">Add Room</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
            </div>
            <!-- SIDEBAR TOGGLE SCRIPT -->
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
    }

    // Highlight current sidebar menu based on URL
    const links = document.querySelectorAll('.sidebar .nav-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>
