<?php
include('admin/connection.php');

$quantity = $_POST["new_quantity"];
$cart_id =  $_POST["cart_id"];
     

     $update = "UPDATE cart SET quantity = $quantity WHERE cart_id = $cart_id";
     $run = mysqli_query($conn,$update);           
?>