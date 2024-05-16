<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$name="e-commerce";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$name);

if(!$conn){
    die("Conncection failed");
}