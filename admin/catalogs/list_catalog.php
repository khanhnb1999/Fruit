<?php
require_once '../session.php';
require_once '../library_pdo.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$pages_one = 3;
$start_from = ($page - 1) * $pages_one;
$sql = "SELECT * FROM catalogs ORDER BY catalog_id ASC LIMIT $start_from,$pages_one";

    if (isset($_GET['search-keyword'])) {
        $keyword = $_GET['sr-keyword'];
        if (!empty($keyword)) {
            $sql = "SELECT * FROM catalogs WHERE catalog_name LIKE '%$keyword%'";
        }
    }
    $connect = getConnection();
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $catalog = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include '../layouts/header.php'?>

<div class="content p-3 " style="margin: 120px auto;">
    <div class="content__button d-flex justify-content-end mb-3">
        <div class="content__button">
            <a href="./add_catalog.php" class="btn btn-success">ADD CATALOG</a>
        </div>
    </div>
    <div class="content__list--catalog">
        <form action="./delete_catalog.php" method="post">
            <div class="content__list--fruit">
                <table class="table table-hover text-center">
                    <thead>
                        <tr class="table-primary">
                            <th>CHECK</th>
                            <th>ID</th>
                            <th>CATALOG NAME</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($catalog as $value): ?>
                            <tr>
                                <td>
                                <input type="checkbox" name='ids[]' id='check_all' value='<?= $value['catalog_id'] ?? 0; ?>'>
                                </td>
                                <td><?=$value['catalog_id']?></td>
                                <td><?=$value['catalog_name']?></td>
                                <td>
                                    <a href="update_catalog.php?catalog_id=<?=$value['catalog_id']?>"
                                        class="btn btn-info">UPDATE</a>
                                    <a onclick="return confirm('Bạn có muốn xóa không!!!')"
                                        href="delete_catalog.php?catalog_id=<?=$value['catalog_id']?>"
                                        class="btn btn-danger">DELETE</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="checkbox">
                <a href="#" class="btn btn-success" id="btn1">Check all</a>
                <a href="#" class="btn btn-warning text-white mx-3" id="btn2">Uncheck all</a>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không')">Delete</button>
            </div>
        </form>
        <div class="pagination d-flex justify-content-center mt-5">
            <div class="pagination__item">
                <?php
                $connect = getConnection();
                $sql = "SELECT * FROM catalogs";
                $stmt = $connect->prepare($sql);
                $stmt->execute();
                $total_record = $stmt->rowCount();
                $total_page = ceil($total_record / $pages_one);

                if ($page > 1) {
                    echo "<a href='list_catalog.php?page=($page-1)' class='btn btn-success me-1'>Previous</a>";
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<a class='active btn btn-info text-white'>$i</a>";
                    } else {
                        echo "<a href='list_catalog.php?page=$i' class=' btn btn-secondary mx-1'>$i</a>";
                    }
                }

                if ($i > $page && $page != $total_page) {
                    echo "<a href='list_catalog.php?page=($page+1)' class='btn btn-success ms-1'>Next</a>";
                }
                ?>

            </div>
        </div>
    </div>
</div>


<?php include '../layouts/footer.php'?>