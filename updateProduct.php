<?php 
include ("connect.php"); 
include ("include/header.php"); 
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
}
if(isset($_POST['update'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName =  $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowedExt = array('jpg','jpeg','png','jfif','webp');
    $productId=$_POST['productId'];
    $old_img = $_POST['old_img'];

    if(!empty($fileName) ){
        if(in_array($fileActualExt,$allowedExt)){
            
        $fileNameNew = "img-".rand(1,100000000).".".$fileActualExt;
        $fileDestination = 'images/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);

        $post_img="UPDATE products SET img = '$fileNameNew' WHERE id='$productId'";  
        $post_img_run=mysqli_query($conn,$post_img);

        $postCart_img="UPDATE cart SET img = '$fileNameNew' WHERE product_id='$productId'";  
        $postCart_img_run=mysqli_query($conn,$postCart_img);


        if($post_img_run){
            header("Location:managePosts.php");
        }else{
            echo "<script>window.alert('Something went wrong')</script>";
        }
    }else{
        echo "<script>window.alert('Please fill all the fields')</script>";
    }
    }

    if(!empty($name) && !empty($price)){
        $postData="UPDATE products SET  name = '$name', price = '$price' WHERE id='$productId'";  
        $postData_run=mysqli_query($conn,$postData);

        $postCartData="UPDATE cart SET  name = '$name', price = '$price' WHERE product_id='$productId'";  
        $postCartData_run=mysqli_query($conn,$postCartData);

        if($postData_run){
            header("Location:managePosts.php");
        }else{
            echo "<script>window.alert('Something went wrong')</script>";
        }
    }

}
 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
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

if(isset($_GET['productId'])){
        $productId=$_GET['productId'];
        $user = "SELECT * FROM products WHERE id = '$productId'";
        $user_run = mysqli_query($conn,$user);
        $productsData = mysqli_fetch_assoc($user_run);

}
?> 
        <form  method="post"  enctype="multipart/form-data">
            <h1>Update product</h1>
            <input type="hidden" name="productId" value="<?php echo "$productsData[id]"; ?>">
            <input type="hidden" name="old_img" value="<?php echo"$productData[img]"; ?>" >
            <input type="text" name="name"  value="<?php echo "$productsData[name]";?>"> 
            <input type="text" name="price"  value="<?php echo "$productsData[price]";?>"> 
            <img src="images/<?php echo"$productsData[img]"; ?>"  alt="">
            <input type="file" name="image">
            <input type="submit" name="update" class="btn btn-primary" value="Update"> 
            <a href="managePosts.php"  class="text-light btn btn-danger">Cancel</a> 

        </form>
</div>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>