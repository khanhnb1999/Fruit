<?php

require_once "../library_pdo.php";

$getId = $_GET['id'];
if(isset($getId)) {
     $getId = $_GET['id'];
     $where = "setting_id = $getId";
     delete('settings', $where);
     header("Location: list.php");
}



?>