<?php
require_once '../session.php';
require_once '../library_pdo.php';

$catalog_id = $_GET['catalog_id'];
if(isset($catalog_id)) {
    $catalog_id = $_GET['catalog_id'];
    $where = "catalog_id=$catalog_id";
    delete('catalogs',$where );
    header("Location: list_catalog.php");
}

$ids = $_POST['ids'] ?? 0;
if (!empty($ids)) {
    foreach ($ids as $id) {
        $where = "catalog_id = $id";
        delete('catalogs', $where);
    }

    header("Location: list_catalog.php");
}

?>