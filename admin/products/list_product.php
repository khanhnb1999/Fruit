<?php

    require '../session.php';
    require '../library_pdo.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $pages_one = 8;
    $start_from = ($page - 1) * $pages_one;
    $sql = "SELECT * FROM products ORDER BY product_id ASC LIMIT $start_from,$pages_one";
    
    if (isset($_GET['search-keyword'])) {
        $keyword = $_GET['sr-keyword'];
        if (!empty($keyword)) {
            $sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'";
        }
    }
    
    $connect = getConnection();
    $stmt = $connect->prepare($sql); 
    $stmt->execute();
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";print_r($product);die;

?>

<?php include '../layouts/header.php' ?>
<session>
    <div class="content p-3" style=" margin: 100px auto">
        <div class="content__button--add d-flex justify-content-end mb-3">
            <div class="add__device">
                <a href="./add_product.php" class="btn btn-success">ADD </a>
            </div>
        </div>
        <form action="./delete_product.php" method="post">
            <div class="content__list">
                <table class="table table-hover text-center">
                    <thead>
                        <tr class="table-primary">
                            <th>CHECK</th>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>IMAGES</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product as $value) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name='ids[]' id='check_all' value='<?= $value['product_id'] ?? 0; ?>'>
                                </td>
                                <td><?= $value['product_id'] ?></td>
                                <td style="font-weight:600"><?= $value['product_name'] ?></td>
                                <td>
                                    <img src="image/<?= $value['product_images'] ?>" width="70px" alt="">
                                </td>
                                <td style="font-weight:600"><?= number_format($value['product_price']) ?></td>
                                <td><?= $value['product_quantity'] ?></td>
                                <td>
                                    <a href="update_product.php?product_id=<?= $value['product_id'] ?>" class="btn btn-info">UPDATE</a>
                                    <a onclick="return confirm('Bạn có muốn xóa không!!!')" 
                                    href="delete_product.php?product_id=<?= $value['product_id'] ?>" class="btn btn-danger">DELETE</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="checkbox">
                <a href="#" class="btn btn-success" id="btn1">Check all</a>
                <a href="#" class="btn btn-warning text-white mx-3" id="btn2">Uncheck all</a>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
        <div class="pagination d-flex justify-content-center mt-5">
            <div class="pagination__item">
                <?php
                    $connect = getConnection();
                    $sql = "SELECT * FROM products";
                    $stmt = $connect->prepare($sql);
                    $stmt->execute();
                    $total_record = $stmt->rowCount();
                    $total_page = ceil($total_record / $pages_one);

                    // if ($page > 1) {
                    //     echo "<a href='list_product.php?page=($page-1)' class='btn btn-success me-1'>Previous</a>";
                    // }

                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            echo "<a class='active btn btn-info text-white'>$i</a>";
                        } else {
                            echo "<a href='list_product.php?page=$i' class='btn btn-secondary mx-1'>$i</a>";
                        }
                    }

                    // if ($i > $page && $page != $total_page) {
                    //     echo "<a href='list_product.php?page=($page+1)' class='btn btn-success ms-1'>Next</a>";
                    // }
                ?>

            </div>
        </div>
    </div>
</session>

<?php include '../layouts/footer.php' ?>

