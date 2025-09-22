<?php
session_start();
if(!isset($_SESSION['user_id'])|| $_SESSION['role']!=='admin'){
    header(Location:'../index.php');
    exit();
}
include"../db_connect.php";

$message='';
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name =trim($_POST['name'] ?? '');
    $email =trim($_POST['email'] ?? '');
    $department =trim($_POST['department'] ?? '');
    $role=in_array($_POST['role']?? '',['admin','user']) ? $_POST['role']:'user';
    $plain=$_POST['password']?? '';

// basic validation
if(empty($name)|| empty($email)|| empty($plain)){
    $message="please fill the requierd field.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
</head>
<body class="container mt-4">
    <h2>Add Employee</h2>
    <?php if($message) echo "<div class='alert alert-info'>$message</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Name<label>
            <input name="name" class="form-control" requierd>
        </div>
         
        <div class="mb-3">
            <label>Email<label>
            <input name="email" class="form-control" requierd>
        </div>

        <div class="mb-3">
            <label>password<label>
            <input name="password" type="text" class="form-control" requierd>
        </div>
        
        <div class="mb-3">
            <label>department<label>
            <input name="department" class="form-control" requierd>
        </div>

        <div class="mb-3">
            <label>role<label>
            <select name="role" class="form-control">
                <option value="user">User</option>\
                <option value="admin">Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">ADD Employee</button>
        <a href="dashboard.php" class="btn btn-secondary">back</a>
    </form>
</body>
</html>