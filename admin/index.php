<?php
include './functions.php';
session_start();

if(isset($_SESSION['username'])) {
    header("Location: $baseUrl/products/list_product.php");
}else{
    header("Location: $baseUrl/login.php");
}