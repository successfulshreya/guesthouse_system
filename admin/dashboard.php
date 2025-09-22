<?php
include'db_connect.php';
$session_start();
if(!isset ($_SESSION['role']!=='admin') || $_SESSION['user_id']){
    header("location:'index.php'");
    exit();
}
?>