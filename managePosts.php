<?php 
include ("connect.php"); 
include ("include/header.php"); 
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
} 

if(isset($_POST['delete'])){
    $product_id=$_POST['product_id'];
    $delete="DELETE  FROM products WHERE id='$product_id' ";
    $result=mysqli_query($conn,$delete);  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage  Posts</title>
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
<div class="back">
  <a href="index.php"><i class="fa-solid fa-tent-arrow-turn-left"></i></a>  

</div>
 <div class="products">

<?php

$products="SELECT * FROM products WHERE user_id='$user_id' ";
$productsResult=mysqli_query($conn,$products);

if($productsResult){
   
   while($productsData=mysqli_fetch_assoc($productsResult)){ ?>

    <div class="product">
        <form method="post"> 
            <p> <?php echo "$productsData[name]"   ?> <p>
            <img src="images/<?php echo "$productsData[img]"   ?> ">
            <p>$<?php echo "$productsData[price]"   ?> </p> 
            <a href="updateProduct.php?productId=<?php echo "$productsData[id]";?>"  class="text-light btn btn-warning">Update</a> 
            <input type="submit" name="delete" class="btn btn-danger" value="Delete"> 
            <input type="hidden" name="product_id"  value="<?php echo "$productsData[id]";?>" >  

        </form>
    </div>
<?php

   }
}
?>
</div>
<div id="footer"></div>
   