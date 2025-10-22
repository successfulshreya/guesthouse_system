<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    header("Location:../index.php");
    exit();
}
include '../db_connect.php';

$msg='';
if(isset($_GET['success'])){
    $msg="Guesthouse added successfully!!!!";
}
if($_SERVER['REQUEST_METHOD']==="POST"){
    $name=trim($_POST['name' ]?? '');
    $address=trim($_POST['address'] ?? '');
    if($name === '' || $address=== ''){
        $msg="fill all the field";
    }else{
        $stmt=$conn->prepare("INSERT INTO guesthouses(name,address) VALUES(?,?)");
        $stmt->bind_param("ss", $name, $address);
        if($stmt->execute()){
            header("Location:add_guesthouse.php?success=1");
            exit();
        }else{
            $msg="error:" . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Guesthouse</title>
        <link rel="stylesheet" href="styleadmin.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
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

       body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5;
        }
        .sidebar {
            width: 250px;
            background: #212529;
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
            background: #343a40;
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
  </style>
    </head>
    <body>
    
<!-- Sidebar -->
<nav class="sidebar d-flex flex-column">
    <div class="sidebar-header">
        <a href="dashboard.php" class="text-decoration-none">
            <img src="../sardalogo.jpg" style="width:fix-content; height:80px; padding-bottom:10px;">
        </a>
        <div class="d-flex align-items-center text-white text-decoration-none">
            <i class="bi bi-person-fill-gear fs-1"></i>
            <span class="fs-4 ms-3">ADMIN</span>
        </div>
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-3">
      <li class="nav-item">
            <a href="dashboard.php" class="nav-link"><i class="bi bi-house-fill"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="add_user.php" class="nav-link"><i class="bi bi-person-plus"></i> Add Employee</a>
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
            <span>Welcome, Admin</span>
        </div>
      </div>

         <div class="container">
            <br>
          <h2 class="card-title">Add guesthouse</h2>
          <p class="card-text">add new guesthouse name with address.</p>

      <div class="card" style="width: 48rem; height:400px">
            <div class="card-body">
              <?php if($msg): ?>
                 <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
              <?php endif; ?>
       
         <form method="POST">
                <div class="mb-3">
                  <label for="Name" class="form-label">Name</label>
                  <input type="text" name=name class="form-control"aria-describedby="enter your name">
                </div>

                <div class="mb-3">
                   <label for="address" class="form-label">Address</label>
                   <input type="text"  name= address class="form-control" aria-describedby="address">
                 </div>
            <BR>
                <button class="btn btn-primary">ADD Guesthouse</button>
                <a href="dashboard.php" class="btn btn-secondary">back</a>
        </form>
              </div>
  </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>
