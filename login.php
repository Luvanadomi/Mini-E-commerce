<?php
include ("connect.php");
if(isset($_POST['login'])){ 
$email=$_POST['email'];
$password=$_POST['password']; 

    $checkCredentials="SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $checkCredentialsResult=mysqli_query($conn,$checkCredentials);
    if( $checkCredentialsResult){
        $data=mysqli_fetch_assoc($checkCredentialsResult);
        session_start();
        $_SESSION['user_id']= $data['id'];
        header("Location:index.php");
    }
    else {
        echo "<script>  window.alert('Wrong email or password').onlick=this.remove();</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
        <form action="" method="post">
            <h1>Login </h1>
            <input type="email" name="email" placeholder="Enter your email" >
            <input type="password" name="password" placeholder="Enter your password" >
            <input type="submit" name="login" class="btn btn-primary" value="Login">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>