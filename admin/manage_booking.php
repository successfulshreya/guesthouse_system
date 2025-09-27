<?php
session_start();
if(!isset($_SESSION['user_id'])||
$_SESSION['role']!=='admin'){
    header("Location:../index.php");
    exit();
}
include '../db_connect.php';
//cancel booking admin
if(isset($_GET['cancel_id'])){
    $cancel_id=intval($_GET['cancel_id']);
    $stmt=$conn->prepare("DELETE FROM booking WHERE id = ?");
    $stmt->bind_param("i" , $cancel_id);
    $stmt->execute();
    $stmt->close();
    $msg="Booking cancelled successfully ";
}

//fetch all the bookings
$sql= "SELECT
        b.id,
        u.name AS user_name, 
        g.name AS guesthouse_name,
        r.room_id, 
        b.checkin_date, 
        b.checkout_date
        FROM booking b 
        JOIN users u ON b.user_id = u.id
        JOIN rooms r ON r.room_id = r.id
        JOIN guesthouse g ON r.guesthouse_id = g.id
        WHERE B.USER_ID = ?
        ORDER BY b.checkin_date DESC";
        $result = $conn->query($sql);
    ?>



<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class=" bg-light ">
    <div class="container mt-4 list-group">
     <h2 class="container mt-4">Manage bookings of USERS</h2>
     <a href="dashboard.php" style="width:200px;" class="btn btn-secondary mb-4">Back to Dashboard</a>
    
                <?php if(!empty($msg)){ ?>
                    <div class="alert alert-success"> <?=$msg ?> </div>
                <?php } ?>
  
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Guesthouse</th>
                <th>Room</th>
                <th>CHECK-IN</th>
                <th>CHECK-OUT</th>
                <th>Action</th>
             </tr>
          </thead>
           <tbody>
            
               <?php
                if ($result === false) {
               // Query failed, error already shown above (die) or handle gracefully
                   } elseif($result->num_rows > 0) {
                        $i=1; 
                         While($row = $result->fetch_assoc()){ 
                ?>
                <tr>
                    <td><?=$i++?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['guesthouse_name']) ?></td>
                    <td><?= htmlspecialchars($row['room_id']) ?></td>
                    <td><?= htmlspecialchars($row['checkin_date']) ?></td>
                    <td><?= htmlspecialchars($row['checkout_date']) ?></td>
                      <td> <a href="?cancel_id=<?=$row['id']?>"
                      onclick="return confirm('cancel this booking ?')"
                      class="btn btn-danger btn-sm">Cancel</a> </td>
               </tr>
               <?php
              }}else {
               // no rows
                echo "<tr><td colspan='7' class='text-center'>NO Booking FOUND</td></tr>";
              }
             ?>
            </tbody>
        </table>

    </div>
</body>

