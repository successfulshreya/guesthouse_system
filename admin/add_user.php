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
        $message="User added successfully.";
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
    <title>Add User</title>
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
        <h5>Add User</h5>
        <div class="d-flex align-items-center">
            <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i></button>
           <?php echo htmlspecialchars($_SESSION['email']); ?>
        </div>
    </div>

    <div class="container mt-5">
    <h2>Add User</h2>
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

        <button class="btn btn-primary">ADD User</button>
        <a href="dashboard.php" class="btn btn-secondary">back</a>
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



   


    