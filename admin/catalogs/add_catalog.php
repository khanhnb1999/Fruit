<?php
require_once '../session.php';
require_once '../library_pdo.php';
$message = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catalog_name = $_POST['catalog_name'];

    if(empty($catalog_name)) {
        $message['catalog_name'] = "Không được để trống tên catalogs";
    }
    else {
        $data = [
            'catalog_name' => $catalog_name,
        ];
        insert('catalogs', $data);
        header("Location: list_catalog.php");
    }
}

?>
<?php include '../layouts/header.php'?>

<session>
    <div class="main__content " style="margin-top:150px">
        <div class="main_content--add--fruit">
            <form action="add_catalog.php" method="post" enctype="multipart/form-data"
                class="d-flex align-items-center">
                <div class="input__fruit my-3">
                    <input type="text" class="form-control" name="catalog_name" placeholder="Enter catalog names">
                    <span style="color:red">
                        <?= isset($message['catalog_name']) ? $message['catalog_name'] : ""?>
                    </span>
                </div>
                <div class="input__fruit my-3">
                    <button type="submit" class="btn btn-success mx-3">Add catalog</button>
                </div>
            </form>
        </div>
    </div>
</session>

<?php include '../layouts/footer.php'?>