<?php
require_once '../session.php';
require_once '../library_pdo.php';

$flagRole = canDo('Dang_bai');
if(!$flagRole){
    echo "Bạn không có quyền đăng bài viết";
    die;
}
$news_id = $_GET['news_id'];
if(isset($news_id)) {
    $news_id = $_GET['news_id'];
    $where = "news_id = $news_id";
    delete('news', $where);
    header("Location: list_news.php");
}


$ids = $_POST['ids'] ?? 0;
if (!empty($ids)) {
    foreach ($ids as $id) {
        $where = "news_id = $id";
        delete('news', $where);
    }

    header("Location: list_news.php");
}
?>