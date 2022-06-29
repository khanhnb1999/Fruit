<?php
require_once '../session.php';
require_once '../library_pdo.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catalog_id = $_POST['catalog_id'];
    $catalog_name = $_POST['catalog_name'];

    if(empty($catalog_name)) {
        $message['catalog_name'] = "Không được để trống tên catalogs";
    }
    else {
        $connect = getConnection();
        $sql = "UPDATE catalogs SET catalog_name='$catalog_name' WHERE catalog_id='$catalog_id'";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        header("Location: list_catalog.php");
    }
}

$catalog_id = $_GET['catalog_id'];
$value = get_one_data("SELECT * FROM catalogs WHERE catalog_id='$catalog_id'");
?>

<?php include '../layouts/header.php'?>


<div class="main_content--add " style="margin: 150px;">
    <form action="update_catalog.php?catalog_id=<?=$value['catalog_id']?>" method="post" enctype="multipart/form-data"
        class="d-flex align-items-center">
        <input type="hidden" name="catalog_id" value="<?= $value['catalog_id'] ?>">
        <div class="input__fruit my-3">
            <input type="text" class="form-control" name="catalog_name" placeholder="Enter catalog names"value="<?= $value['catalog_name'] ?>">
        </div>
        <div class="input__fruit my-3">
            <button type="submit" class="btn btn-success mx-3">Update catalog</button>
        </div>
    </form>
</div>


<?php include '../layouts/footer.php'?>