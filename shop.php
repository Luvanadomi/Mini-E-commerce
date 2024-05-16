<?php 
include ("connect.php");
include ("include/header.php"); 
session_start();
$user_id=$_SESSION['user_id'];
if(!$user_id){
    header("Location:login.php");
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
<div class="products">
<div class="table-container">
    <table>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Total Price</td>
            <th>Action</th> 
        </tr>

        <?php   
        
         $total=0;
         $totalPrice=0;
         $displayProducts="SELECT * FROM cart WHERE user_id = '$user_id'";
         $displayProductsResults=mysqli_query($conn,$displayProducts);    
         while($displayProductsData=mysqli_fetch_assoc($displayProductsResults)){
            
            ?>
        <tr> 
            <?php $total=$displayProductsData['price']* $displayProductsData['quantity'];?>
            <td><img src="images/<?php echo "$displayProductsData[img]"   ?> "></td>
            <td><?php echo"$displayProductsData[name]" ?></td>
            <td>$<?php echo"$displayProductsData[price]" ?></td>
            <td><?php echo"$displayProductsData[quantity]" ?></td> 
            <td>$<?php echo"$total" ?></td> 
            <td><a href="delete.php?productId=<?php echo "$displayProductsData[id]"?>" class="text-light btn btn-danger delete" >Delete</a></td> 
            <?php $totalPrice+=$total;?>
        </tr>
        <?php  
        }   
        ?>
        <tr>
            
            <td colspan="4">Total amount:</td>
            <td >$<?php echo"$totalPrice"?></td>
            <td><a href="delete.php?deleteAll" class="text-light btn btn-danger" >Delete All</a></td> 

        </tr>
        
    </table>
</div>  
</div>
 
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>