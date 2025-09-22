<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    header("Location:../index.php");
    exit();
}
include'../db_connect.php';

$msg='';
if($_SERVER['REQUEST_METHOD']==="POST"){
    $name=trim($_POST['name']);
    $address=trim($_POST['address']);
    if($name === '' || $address=== ''){
        $msg="fill all the field";
    }else{
        $stmt=$conn->prepare("INSERT INTO guesthouses (name,address) VALUES(?,?)");
        $stmt->bind_param("ss", $name, $address);
        if($stmt->execute()){
            $msg="Guesthouse added";
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
</head>
<body class="container mb-4">
<h2 class="card-title">Add guesthouse</h2>
<p class="card-text">add new guesthouse name with address.</p>

<div class="card" style="width: 48rem; height:300px">
  <div class="card-body">

   <form method="POST">

    <div class="mb-3">
      <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control"aria-describedby="enter your name">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" aria-describedby="address">
    </div>
<br>


<button class="btn btn-primary">ADD Guesthouse</button>
        <a href="dashboard.php" class="btn btn-secondary">back</a>
</form>

    
  </div>
</div>

</body>
</html>
