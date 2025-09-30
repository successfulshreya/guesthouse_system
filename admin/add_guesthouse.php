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
  </style> <style>
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
    <nav class="sidebar d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
      <i class="bi bi-gear-fill fs-4"></i>
      <span class="fs-4">Admin</span>
    </a>
    <hr>
     <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link active"><i class="bi bi-pc"></i> Dashboard</a>
      </li>

      <li class="nav-item">
        <a href="add_user.php" class="nav-link "><i class="bi bi-person-fill"></i> Add Employee</a>
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
