<?php
include ("connect.php"); 
session_start();
$user_id=$_SESSION['user_id'];


if(isset($_GET['productId'])){
$productId=$_GET['productId'];
$delete="DELETE  FROM cart WHERE id='$productId' AND  user_id='$user_id'";
$result=mysqli_query($conn,$delete); 
    header("Location:shop.php");
}
if(isset($_GET['deleteAll'])){
    $deleteAll="DELETE  FROM cart WHERE user_id='$user_id' ";
    $deleteResult=mysqli_query($conn,$deleteAll); 
    header("Location:shop.php");
  
}