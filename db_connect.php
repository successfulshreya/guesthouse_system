<?php
$host = "localhost";   //server
$user = "root"; 
$pass = "";
$db = "guesthouse_db";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die("Database Connection Failed:" .$conn->connect_error);
}

?>
