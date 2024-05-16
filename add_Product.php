<?php 
include("connect.php");
include ("include/header.php"); 
if(isset($_POST['post'])){
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $fileName = $image['name'];
    $fileTmpName = $image['tmp_name'];
    $fileSize = $image['size'];
    $fileError = $image['error'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowedExt = array('jpg','jpeg','png','jfif','webp');


    if(!empty($name) && !empty($price) && !empty($image)){
        if(in_array($fileActualExt,$allowedExt)){
            if($fileError === 0 ){
                if($fileSize < 100000000){

                    $fileNameNew = "img-".rand(1,100000000).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);

                    $addPost = "INSERT INTO products (user_id,name,img,price)
                    VALUES ('$user_id','$name','$fileNameNew','$price')";
                    $addPost_run = mysqli_query($conn,$addPost);
                    
                    if($addPost_run){
                        header("location:index.php");
                    }else{
                        echo "<script> alert('Post is not posted ')</script>";
                
                    }

                }else{
                echo "<script> alert('File is to big ')</script>";

                }
            }else{
            echo "<script> alert('Error uploading the file ')</script>";
        }
        }else{
            echo "<script> alert('This type of image in not suported ')</script>";
        }
    }else{
        echo "<script> alert('Please do not leave empty fields ')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New product</title>
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
        <form  method="post" enctype="multipart/form-data">
            <h1>Create post</h1>
            <input type="hidden" name="user_id" value="<?php if(isset($_GET['user_id'])){  echo"$_GET[user_id]"; } ?>">
            <input type="text" name="name" placeholder="Enter product's name" > 
            <input type="text" name="price" placeholder="Enter price" > 
            <input type="file" name="image" > 
            <input type="submit" name="post" class="btn btn-primary" value="Post"> 
            <a href="index.php"  class="text-light btn btn-danger">Cancel</a> 

        </form>
</div>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>