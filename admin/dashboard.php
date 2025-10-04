<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
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
      <span class="fs-4">Admin
        </span>
    </a>
    
    <hr>
    
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="add_user.php" class="nav-link active"><i class="bi bi-person-fill"></i> Add Employee</a>
      </li>
      <li class="nav-item">
        <a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i> Add Guesthouse</a>
      </li>
      <li class="nav-item">
        <a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i> Add Room</a>
      </li>
      <li class="nav-item">
        <a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i> Manage Booking</a>
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

    <div class="mt-4">
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card card-action p-3">
            <i class="bi bi-person-plus fs-2 text-primary"></i>
            <h6 class="mt-2">Add Employee</h6>
            <p class="text-muted">Create a new user account</p>
            <a href="add_user.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card card-action p-3">
            <i class="bi bi-building fs-2 text-success"></i>
            <h6 class="mt-2">Add Guesthouse</h6>
            <p class="text-muted">Add new guesthouse info</p>
            <a href="add_guesthouse.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card card-action p-3">
            <i class="bi bi-door-open fs-2 text-warning"></i>
            <h6 class="mt-2">Add Room</h6>
            <p class="text-muted">Manage rooms in guesthouses</p>
            <a href="add_room.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card card-action p-3">
            <i class="bi bi-calendar-check fs-2 text-info"></i>
            <h6 class="mt-2">Manage Booking</h6>
            <p class="text-muted">View and manage bookings</p>
            <a href="manage_booking.php" class="stretched-link"></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card card-action p-3">
            <i class="bi bi-box-arrow-right fs-2 text-danger"></i>
            <h6 class="mt-2">Logout</h6>
            <p class="text-muted">Sign out from the system</p>
            <a href="../logout.php" class="stretched-link"></a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>
