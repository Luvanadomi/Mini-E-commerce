<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
    
<navbar class="navbar">  
    <i class="fa-brands fa-slack icon"></i>
        <div class="left-side">
        <ul class="items"> 
            <li class="item"><a  href="index.php">Home</a></li> 
            <li class="item"><a href="add_Product.php?user_id=<?php echo "$userData[id]"; ?>">Add product</a></li>  
            <li class="item"><a href="updateProfile.php?user_id=<?php echo "$userData[id]"; ?>">Update Profile</a></li>  
            <li class="item"><a href="managePosts.php?user_id=<?php echo "$userData[id]"; ?>">Manage your posts</a></li> 
           <li class="item"><a href="logout.php">Logout</a></li>   
       </ul>
    </div>
    <div class="right-side">   
        <ul> 
            <li class="item hide-later"><a href="shop.php"><i class="fa-solid fa-cart-shopping "> </i></a></li>
        </ul> 
        <i class="fa-solid fa-bars" id="hamburger"></i>
    </div>
</navbar> 
</body>
<script src="main.js"></script>
</html>
 