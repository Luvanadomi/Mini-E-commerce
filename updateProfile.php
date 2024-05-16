<?php 
include ("connect.php");
include ("include/header.php");  
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
}if(isset($_POST['update'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $user_id=$_POST['user_id'];

    if(!empty($name) && !empty($email)){
        $update = "UPDATE users SET first_name = '$name', email = '$email' WHERE id='$user_id'";
        $update_run = mysqli_query($conn,$update);
    
    }else{
        echo "<script> alert('Fields must not be empty')</script>";
    
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
       <form  method="post">
            <h1>Update profile</h1>
            <input type="hidden" name="user_id" value="<?php echo "$userData[id]";?>" >
            <input type="text" name="name" value="<?php echo "$userData[first_name]";?>">
            <input type="email" name="email" value="<?php echo "$userData[email]";?>"> 
            <input type="submit" name="update" class="btn btn-primary" value="Update"> 
            <a href="changePassword.php?user_id=<?php echo "$userData[id]"; ?>" class="text-light btn btn-warning">Change password?</a> 
            <a href="index.php"   class="btn btn-danger">Cancel</a> 
         </form> 
</div>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>