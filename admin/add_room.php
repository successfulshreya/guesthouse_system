<?php
session_start();
if(!isset($_SESSION['user_id'])||$_SESSION['role']!=='admin'){
    header("Location:../index.php");
}
include'../db_connect.php';

//fetch guesthouses for select box
$gh_result=$conn->query("SELECT id, name FROM guesthouses ORDER BY name");


$msg='';
if($_SERVER[REQUEST_METHOD]==="POST"){

    $guesthouse_id=intval($_POST['guesthouse_id']);
    $room_no = trim($_POST['room_no']);
    if($guesthouse_id <= 0 || $room_no === ''){
        $msg="please fill the field";
    }else{
        $stmt=$conn->prepare("INSERT INTO rooms(guesthouse_id, room_no)VALUES(?,?)")
        $stmt->bind_param("is",$guesthouse_id,$room_no);

         if($stmt->execute()){
        $message="Employee added successfully.";
        }else{
        $message="error:" .$stmt->error;
        }
    $stmt->close();
    }
    $status=trim($_POST['status']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
</head>
<body class="container mt-4">
    <!-- i will continueeee -->