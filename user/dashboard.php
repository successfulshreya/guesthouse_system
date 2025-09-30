<?php
session_start();
if(!isset($_SESSION['user_id'])|| 
$_SESSION['role']!=='user'){
header("Location:../index.php");
exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Panel DASHBOARD</title>
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
      <span class="fs-4">User Panel
        </span>
    </a>
    <hr>
    
    <ul class="nav nav-pills flex-column">
     
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


    <div class="container mb-3">
           <P style="color:aqua;">WELCOME,User !</P>
        <div class="list-group">
            <a href="my_booking.php" class="list-group-item list-group-item-action">My Booking</a>
            <a href="book_room.php" class="list-group-item list-group-item-action">Book Room</a>
            <a href="availability.php" class="list-group-item list-group-item-action">check avaible rooms</a>
            <a href="../logout.php" class="list-group-item list-group-item-action">logout</a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>

</body>
</html>