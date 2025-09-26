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
    </head>
    <body class="container mb-3">
        <h2>User DASHBOARD</h2>
           <P style="color:aqua;">WELCOME,User !</P>
        <div class="list-group">
            <a href="my_booking.php" class="list-group-item list-group-item-action">My Booking</a>
            <a href="book_room.php" class="list-group-item list-group-item-action">Book Room</a>
            <a href="availability.php" class="list-group-item list-group-item-action">check avaible rooms</a>
            <a href="../logout.php" class="list-group-item list-group-item-action">logout</a>
        </div>
</body>
</html>