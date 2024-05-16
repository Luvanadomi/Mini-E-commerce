<?php
include ("connect.php");
if(isset($_POST['register'])){
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirmPassword=$_POST['confirmPassword'];

    $checkUser="SELECT * FROM users WHERE email='$email'  ";
    $checkUserResult=mysqli_query($conn,$checkUser);
    if(mysqli_num_rows( $checkUserResult)>0){
        echo "<script>  window.alert('User already added').onlick=this.remove();</script>";
    }


    else if($password==$confirmPassword && !empty($name) && !empty($email) && !empty($password) && !empty($confirmPassword)){
        $sql="INSERT INTO users (first_name,email,password)
        VALUES ('$name','$email','$password');";
        $result=mysqli_query($conn,$sql);
        header("Location:login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
        <form action="" method="post">
            <h1>REGISTER NOW</h1>
            <input type="text" name="name" placeholder="Enter your name" >
            <input type="email" name="email" placeholder="Enter your email" >
            <input type="password" name="password" placeholder="Enter your password" >
            <input type="password" name="confirmPassword" placeholder="Enter your password again" >
            <input type="submit" name="register" class="btn btn-primary" value="Register">
            <p>Already have an account? <a href="login.php">Login</a></p>



        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>