<?php 
session_start();
    if(isset($_GET['cart_id'])){
        unset($_SESSION['cart'][$_GET['cart_id']]);
    }
    header ("Location: cart.php");
?>