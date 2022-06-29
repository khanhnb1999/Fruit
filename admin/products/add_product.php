<?php
require_once '../session.php';
require_once '../library_pdo.php';


$message = [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_images = "no_images.jpg";
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_content = $_POST['product_content'];
    $product_created_date = $_POST['product_created_date'];
    $product_update_date = $_POST['product_update_date'];
    $catalog_id = $_POST['catalog_id'];

    // test file upload
    $file = $_FILES['fileToUpload'];
    $product_images = $file['name'];

    $data = [
        'product_name' => $product_name,
        'product_images' => $product_images,
        'product_price' => $product_price,
        'product_quantity' =>$product_quantity,
        'product_content' => $product_content,
        'product_created_date' => $product_created_date,
        'product_update_date' => $product_update_date,
        'catalog_id' => $catalog_id,
    ];
    
        insert('products',$data);
        move_uploaded_file($file['tmp_name'], 'image/' .$product_images);
        header("Location: list_product.php");
    
    
}


$catalog = get_all_data("SELECT * FROM catalogs");
?>

<?php include '../layouts/header.php'?>

<div class="form__product">
    <div class="content border p-3">
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="input__news">
                <div class="item ">
                    <input type="text" class="form-control input__control" name="product_name" placeholder="Tên sản phẩm">
                </div>
                <div class="item">
                    <input type="text" class="form-control input__control" name="product_price" placeholder="Giá sản phẩm">
                </div>
                <div class="item">
                    <input type="number" class="form-control input__control" name="product_quantity" placeholder="Số lượng sản phẩm">
                </div>
                <div class="item">
                    <input type="date" class="form-control input__control" name="product_created_date"placeholder="Ngày nhập">
                </div>
                <div class="item">
                    <input type="date" class="form-control input__control" name="product_update_date" placeholder="Ngày xuất">
                </div>
                <div class="item">
                    <div class="group">
                        <div class="item__catalog">
                            <select name="catalog_id" id="" class="form-control input__control">
                                <option value="">Loại sản phẩm</option>
                                <?php foreach($catalog as $cat): ?>
                                <option value="<?= $cat['catalog_id'] ?>"><?= $cat['catalog_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="item__images">
                            <div class="input__fruit my-3">
                                <input type="file" class="form-control input__control" name="fileToUpload">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input__fruit my-3">
                <textarea type="text" class="form-control" name="product_content" rows="10" id="editor1"></textarea>
            </div>
            <div class="input__fruit my-3">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>
<?php include '../layouts/footer.php'?>