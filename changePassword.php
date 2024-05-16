<?php 
include ("connect.php");
include ("include/header.php"); 
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
}
if(isset($_POST['update'])){
    $user_id = $_POST['user_id'];

$currentPassword = $_POST['password'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

$get_user = "SELECT * FROM users WHERE id='$user_id'";
$get_user_run = mysqli_query($conn,$get_user);
$get_userData = mysqli_fetch_assoc($get_user_run);


if($currentPassword == $get_userData['password']){
    if(!empty($newPassword) && !empty($confirmPassword) ){
        if($newPassword ==  $confirmPassword ){
            $updatePass = "UPDATE users SET password = '$newPassword' WHERE id='$user_id'";
            $update_run = mysqli_query($conn,$updatePass);
        
        }else{
            echo "<script> alert('New Password and Confirm Password must match')</script>";
        }

    }else{
        echo "<script> alert('New Password and Confirm Password must not be empty')</script>";
    }


  
}
else{
        echo "<script> alert('Current password is not correct')</script>";
}
        } 
 
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script> 
        $(function() { 
        $("#footer").load("include/footer.html");
        });
    </script>
</head>
<body>

<div class="container">
    <?php 

    if(isset($_GET['user_id'])){
            $user_id=$_GET['user_id'];
            $user = "SELECT * FROM users WHERE id = '$user_id'";
            $user_run = mysqli_query($conn,$user);
            $userData = mysqli_fetch_assoc($user_run);

    }
    ?>  
        <form action="" method="post">
            <h1>Update password</h1>
            <input type="hidden" name="user_id" value="<?php echo "$userData[id]";?>" >  
            <input type="password" name="password" placeholder="Your current password" >
            <input type="password" name="newPassword" placeholder="New password" >
            <input type="password" name="confirmPassword" placeholder="Enter your new password" >
            <input type="submit" name="update" class="btn btn-primary" value="Update"> 
            <a href="updateProfile.php?user_id=<?php echo "$userData[id]";?>"  class="text-light btn btn-danger">Cancel</a> 

        </form>
</div>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>