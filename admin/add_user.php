<?php
session_start();
if(!isset($_SESSION['user_id'])|| $_SESSION['role']!=='admin'){
    header("Location:'../index.php'");
    exit();
}
include '../db_connect.php';

$message='';
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name =trim($_POST['name'] ?? '');
    $email =trim($_POST['email'] ?? '');
    $department =trim($_POST['department'] ?? '');
    $role=in_array($_POST['role']?? '',['admin','user']) ? $_POST['role']:'user';
    $plain=$_POST['password']?? '';

// basic validation
if(empty($name)|| empty($email)|| empty($plain)){
    $message="please fill the required field.";
}else{
    $hashed= password_hash($plain,PASSWORD_DEFAULT);

    //Prepare statement to avoid sql injection
    $stmt=$conn->prepare("INSERT INTO users(name,email,password, department,role)VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss",$name,$email,$hashed,$department,$role);

    if($stmt->execute()){
        $message="Employee added successfully.";
    }else{
        $message="error:" .$stmt->error;
    }
    $stmt->close();
}

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="styleadmin.css">
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
    
  </style>

</head>
<body>

    <nav class="sidebar d-flex flex-column">
    <div class="sidebar-header">
        <a href="dashboard.php" class="text-decoration-none">
           
        </a>
        <div class="d-flex align-items-center text-white text-decoration-none">
            <i class="bi bi-person-fill-gear fs-1"></i>
            <span class="fs-4 ms-3">ADMIN</span>
        </div>
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-3">
      <li class="nav-item">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
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
    <div class="container mt-5">
    <h2>Add Employee</h2>
    <?php if($message) echo "<div class='alert alert-info'>$message</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Name<label>
            <input name="name" class="form-control" required>
        </div>
         
        <div class="mb-3">
            <label>Email<label>
            <input name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>password<label>
            <input name="password" type="text" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>department<label>
            <input name="department" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>role<label>
            <select name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">ADD Employee</button>
        <a href="dashboard.php" class="btn btn-secondary">back</a>
    </form>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr" crossorigin="anonymous"></script>
</body>
</html>



   


    