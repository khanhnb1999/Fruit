<?php
require_once '../session.php';
require_once '../library_pdo.php';

    // $flagRole = canDo('San_pham');
    // if(!$flagRole){
    //     echo "Bạn không có quyền đăng sản phẩm";
    //     die;
    // }
$message = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_images = $_POST['fileToUpload'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_content = $_POST['product_content'];
    $product_created_date = $_POST['product_created_date'];
    $product_update_date = $_POST['product_update_date'];
    $catalog_id = $_POST['catalog_id'];

    // test file upload
    $file = $_FILES['fileToUpload'];

    $img = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    if($file['size'] > 0) {
        if(!in_array($ext, $img)) {
            $message['fileToUpload'] = "File không đúng định dạng";
        }
        $product_images = $file['name'];
    }

    if(!array_filter($message)) {
        // update data in database

        $connect = getConnection();
        $sql = "UPDATE products SET
            product_name='$product_name',
            product_images='$product_images',
            product_price='$product_price',
            product_quantity='$product_quantity',
            product_content='$product_content',
            product_created_date='$product_created_date',
            product_update_date='$product_update_date',
            catalog_id='$catalog_id'
            WHERE product_id='$product_id'";

        $stmt = $connect->prepare($sql);
        $stmt->execute();
        move_uploaded_file($file['tmp_name'], 'image/' .$product_images);
        header("Location: list_product.php");
    }
    
}

$catalog = get_all_data("SELECT * FROM catalogs");
$product_id = $_GET['product_id'];
$value = get_one_data("SELECT * FROM products WHERE product_id='$product_id'");

?>

<?php include '../layouts/header.php'?>

<div class="form__product">
    <div class="content border p-3">
        <form action="update_product.php?product_id=<?=$value['product_id']?>" method="post"
            enctype="multipart/form-data">
            <div class="input__news">
                <input type="hidden" name="product_id" value="<?= $value['product_id'] ?>">
                <div class="item">
                    <input type="text" class="form-control input__control" name="product_name"value="<?= $value['product_name'] ?>">
                </div>
                <div class="item">
                    <input type="text" class="form-control input__control" name="product_price" value="<?= $value['product_price'] ?>">
                </div>
                <div class="item">
                    <input type="text" class="form-control input__control" name="product_quantity" value="<?= $value['product_quantity'] ?>">
                </div>
                <div class="item">
                    <input type="date" class="form-control input__control" name="product_created_date" value="<?= $value['product_created_date'] ?>">
                </div>
                <div class="item">
                    <input type="date" class="form-control input__control" name="product_update_date"  value="<?= $value['product_update_date'] ?>">
                </div>
                <div class="item">
                    <div class="group">
                        <div class="item__catalog">
                            <select name="catalog_id" id="" class="form-control input__control">
                                <option value="">Loại sản phẩm</option>
                                <?php foreach($catalog as $cat): ?>
                                    <?php if($cat['catalog_id'] == $value['catalog_id']) : ?>
                                        <option selected value="<?= $cat['catalog_id'] ?>"><?= $cat['catalog_name'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $cat['catalog_id'] ?>"><?= $cat['catalog_name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="item__images">
                            <input type="hidden" name="fileToUpload" value="<?=$value['product_images']?>">
                            <input type="file" class="form-control input__control" name="fileToUpload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="input__fruit my-3">
                <div class="my-1"><img src="image/<?=$value['product_images']?>" width="100px" alt=""></div>
                <textarea type="text" class="form-control " name="product_content" rows="7" id="editor1"><?= $value['product_content'] ?></textarea>
            </div>
            <div class="input__fruit my-3">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>

<?php include '../layouts/footer.php'?>