<?php
require_once '../session.php';
require_once '../library_pdo.php';

$product_id = $_GET['product_id'] ?? 0;
if (!empty($product_id)) {
    $product_id = $_GET['product_id'];
    $where = "product_id = $product_id";
    delete('products', $where);
    header("Location: list_product.php");
}

$ids = $_POST['ids'] ?? 0;
if (!empty($ids)) {
    foreach ($ids as $id) {
        $where = "product_id = $id";
        delete('products', $where);
    }

    header("Location: list_product.php"); 
}
