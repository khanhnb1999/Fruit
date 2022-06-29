<?php
require_once '../session.php';
require_once '../library_pdo.php';

    $flagRole = canDo('Binh_luan');

    if(!$flagRole){
    echo "Bạn không có quyền bình luận";
    die;
    }
;

$getId = $_GET['id'] ?? 0;
if (!empty($getId)) {
    $getId = $_GET['id'];
    $where = "id = $getId";
    delete('comments', $where);
    header("Location: list_comment.php");
}

$ids = $_POST['ids'] ?? 0;
if (!empty($ids)) {
    foreach ($ids as $id) {
        $where = "id = $id";
        delete('comments', $where);
    }
    header("Location: list_comment.php");
}
