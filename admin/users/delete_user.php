<?php
require_once '../session.php';
require_once '../library_pdo.php';

$user_id = $_GET['user_id'];
if(isset($user_id)) {
    $user_id = $_GET['user_id'];
    $where = "user_id = $user_id";
    delete('users', $where);
    header("Location: list_user.php");
}

?>