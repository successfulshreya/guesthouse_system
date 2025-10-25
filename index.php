<!-- login system -->
 <?php
 session_start();
 include'db_connect.php';

 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email= $_POST['email'];
    $password= $_POST['password'];

    //user check
$sql = "SELECT * FROM users WHERE email='$email'";
$result=$conn->query($sql);
 
if($result->num_rows == 1){
    $row = $result->fetch_assoc();

    //password verify
    if(password_verify($password,$row['password'])){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] =$row['role'];
        $_SESSION['email'] = $row['email'];


        if($row['role']== 'admin'){
            header("location:admin/dashboard.php");

        }else{
            header("location:user/dashboard.php");
        }
        exit();
    }else{
        $error="wrong password!";
    }
    }else{
        $error ="user NOT Found!";
    }
}
 
 ?>

 <!DOCTYPE html>
 <html>
    <head>
        <title>Guesthouse Login</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    </head>
    <body class="container mt-5">
        <h2>Login</h2>

        <?php 
        if(!empty($error)) echo "<p style='color:red;'>$error</p>";
        ?>

        <form method="POST">
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary">Login</button>
        </form>
    </body>
 </html>