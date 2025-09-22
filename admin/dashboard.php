<?php
session_start();

if(!isset($_SESSION['user_id'])||
$_SESSION['role'] !== 'admin'){
header("Location:../index.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>admin dashboard</title>
    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
</head>
<body class="container mt-4">
<h2>ADMIN DASHBOARD</h2>
<P>WELCOME,ADMIN</P>
<div class="list-group">
    <a href="add_user.php" class="list-group-item list-group-item-action">Add Employee(user)</a>
    <a href="add_guesthouse.php" class="list-group-item list-group-item-action">Add Guesthouse</a>
    <a href="add_room.php" class="list-group-item list-group-item-action">Add Room</a>
    <a href="booking.php" class="list-group-item list-group-item-action">Manage  Booking</a>
    <a href="../logout.php" class="list-group-item list-group-item-action">logout</a>
</div>
</body>

</html>