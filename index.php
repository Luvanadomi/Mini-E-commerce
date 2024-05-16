<?php
include ("connect.php"); 
include ("include/header.php");  
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
}else{
    $user="SELECT * FROM users WHERE id=$user_id";
    $resultUser=mysqli_query($conn,$user);
    if($resultUser){
        $userData=mysqli_fetch_assoc($resultUser);
    }
} 
if(isset($_POST['add'])){ 
    $product_name=$_POST['product_name'];
    $product_img=$_POST['product_img'];
    $product_price=$_POST['product_price'];
    $product_id=$_POST['product_id'];
    $product_quantity=$_POST['product_quantity']; 
    $checkProduct = "SELECT * FROM cart WHERE name='$product_name'  AND user_id='$user_id' AND product_id='$product_id' ";
    $checkProductResult = mysqli_query($conn, $checkProduct);
    if(mysqli_num_rows($checkProductResult) > 0) { 
        $updateQuantity = "UPDATE cart SET quantity = quantity + $product_quantity
                                            WHERE name='$product_name'  AND user_id='$user_id' AND product_id='$product_id' ";
        $updateResult = mysqli_query($conn, $updateQuantity);
        if($updateResult){
            echo "<script>window.alert('Product quantity updated successfully')</script>";
        } 
    } else { 
        $addProduct="INSERT INTO cart (user_id,product_id,name,price,img,quantity)
                    VALUES('$user_id','$product_id','$product_name', '$product_price','$product_img','$product_quantity')
                    ";
        $addProductResult=mysqli_query($conn,$addProduct);
        if($addProductResult){
            echo "<script>window.alert('Product added successfully')</script>";
        }  
    }
    
}

if(isset($_GET['productId'])){
$productId=$_GET['productId'];
$delete="DELETE  FROM cart WHERE id='$productId' AND  user_id='$user_id'";
$result=mysqli_query($conn,$delete); 
    header("Location:index.php");
}
if(isset($_GET['deleteAll'])){
    $deleteAll="DELETE  FROM cart WHERE user_id='$user_id' ";
    $deleteResult=mysqli_query($conn,$deleteAll); 
    header("Location:index.php");
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

 
 
<div id="info-container">
    <div id="info">
        <p>User's name:  <?php echo "$userData[first_name]";   ?></p>
        <p>User's email:    <?php echo "$userData[email]";  ?></p> 
    </div>
</div>

<div class="products">

<?php

$products="SELECT * FROM products";
$productsResult=mysqli_query($conn,$products);

if($productsResult){
   
   while($productsData=mysqli_fetch_assoc($productsResult)){ ?>

    <div class="product">
        <form method="post"> 
            <p> <?php echo "$productsData[name]"   ?> <p>
            <img src="images/<?php echo "$productsData[img]"   ?> ">
            <p> $<?php echo "$productsData[price]"   ?> </p>
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="submit" name="add" value="Add to cart">  
            <input type="hidden" name="product_name"  value="<?php echo "$productsData[name]" ?> " >
            <input type="hidden" name="product_img" value="<?php echo "$productsData[img]" ?> " >
            <input type="hidden" name="product_price" value="<?php echo "$productsData[price]" ?> " >
            <input type="hidden" name="product_id" value="<?php echo "$productsData[id]" ?> " >


        </form>
    </div>
<?php

   }
}
?>
</div>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>