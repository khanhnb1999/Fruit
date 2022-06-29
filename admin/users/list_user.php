<?php
require_once '../session.php';
require_once '../library_pdo.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $pages_one = 6;
    $start_from = ($page - 1) * $pages_one;
    $sql = "SELECT * FROM users ORDER BY user_id ASC LIMIT $start_from,$pages_one";

    if (isset($_GET['search-keyword'])) {
        $keyword = $_GET['sr-keyword'];
        if (!empty($keyword)) {
            $sql = "SELECT * FROM users WHERE user_name LIKE '%$keyword%'";
        }
    }

    $connect = getConnection();
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<?php include '../layouts/header.php'?>


<div class="content p-3" style="margin-top:90px">
    <div class="content__button--add d-flex justify-content-end m-3">
        <div class="content__button--add--user ">
            <a href="" class="btn btn-success">ADD USERS</a>
        </div>
    </div>
    <div class="content__list--user">
        <form action="./delete_user.php" method="post">
            <div class="content__list--user">
                <table class="table table-hover text-center">
                    <thead>
                        <tr class="table-primary">
                            <th>CHECK</th>
                            <th>ID</th>
                            <th>NAMES</th>
                            <th>EMAIL</th>
                            <th>ADDRESS</th>
                            <th>TYPES</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $value): ?>
                        <tr>
                            <td>
                            <input type="checkbox" name='ids[]' id='check_all' value='<?= $value['user_id'] ?? 0; ?>'>
                            </td>
                            <td><?=$value['user_id']?></td>
                            <td><?=$value['user_name']?></td>
                            <td><?=$value['user_email']?></td>
                            <td><?=$value['user_address']?></td>
                            <td><?=$value['user_type']?></td>
                            <td>
                                <a href="update_user.php?user_id=<?=$value['user_id']?>" class="btn btn-info">UPDATE</a>
                                <a onclick="return confirm('Bạn có muốn xóa không!!!')"
                                    href="delete_user.php?user_id=<?=$value['user_id']?>" class="btn btn-danger">DELETE</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
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
                $sql = "SELECT * FROM users";
                $stmt = $connect->prepare($sql);
                $stmt->execute();
                $total_record = $stmt->rowCount();
                $total_page = ceil($total_record / $pages_one);

                if ($page > 1) {
                    echo "<a href='list_user.php?page=($page-1)' class='btn btn-success me-1'>Previous</a>";
                }

                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<a class='active btn btn-info text-white'>$i</a>";
                    } else {
                        echo "<a href='list_user.php?page=$i' class=' btn btn-secondary mx-1'>$i</a>";
                    }
                }

                if ($i > $page && $page != $total_page) {
                    echo "<a href='list_user.php?page=($page+1)' class='btn btn-success ms-1'>Next</a>";
                }
                ?>

            </div>
        </div>
    </div>
</div>


<?php include '../layouts/footer.php'?>