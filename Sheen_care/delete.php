<?php
include('admin/connection.php');
session_start();

if (isset($_REQUEST['cart_id'])) {
    $cart_id = $_REQUEST['cart_id'];

    $query = "DELETE FROM cart WHERE  cart_id = $cart_id";
    $run = mysqli_query($conn, $query);

    if ($run) {
        echo "<script>window.location='cart.php';</script>";
    }
}


if (isset($_REQUEST['cart_pro_id'])) {
    $pro_id = intval($_REQUEST['cart_pro_id']);
    $_SESSION['total_cart_items'] -= $_SESSION['cart'][$pro_id];
    unset($_SESSION['cart'][$pro_id]);
    echo "<script>window.location='cart.php';</script>";
}
?>