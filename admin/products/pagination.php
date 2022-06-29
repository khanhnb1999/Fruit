<?php
require_once '../connect.php';

// Tạo 1 biến (số tin 1 trang)
$pages_one = 8;

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Tạo biến total_record (chứa tổng số bản ghi trong bảng products)
$total_record = $stmt->rowCount();

// Tạo biến total_page (tính ra số trang)
$total_page = ceil($total_record/$pages_one);


for($page = 1; $page <= $total_page; $page++)  {
    echo "<a href='pagination.php?page=$page'>$page</a>";
}

?>