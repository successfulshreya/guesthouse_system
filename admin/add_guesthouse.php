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

    </head>
    <body>
    
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
         <h5>Add Guesthouse</h5>
        <div class="d-flex align-items-center">
            <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i></button>
           <?php echo htmlspecialchars($_SESSION['email']); ?>
        </div>
    </div>

         <div class="container">
            <br>
          <h2 class="card-title">Add guesthouse</h2>
          <p class="card-text">Add new guesthouse name with address.</p>

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
