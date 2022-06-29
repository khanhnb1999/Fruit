<?php
require_once '../session.php';
require_once '../library_pdo.php';

    $flagRole = canDo('Binh_luan');

     if(!$flagRole){
          echo "Bạn không có quyền bình luận";
        die;
     }


     if (isset($_GET['page'])) {
          $page = $_GET['page'];
     } else {
          $page = 1;
     }

     $pages_one = 3;
     $start_from = ($page - 1) * $pages_one;
     $sql = "SELECT * FROM comments ORDER BY id ASC LIMIT $start_from,$pages_one";

     if (isset($_GET['search-keyword'])) {
          $keyword = $_GET['sr-keyword'];
          if (!empty($keyword)) {
              $sql = "SELECT * FROM comments WHERE content LIKE '%$keyword%'";
          }
      }

     $connect = getConnection();
     $stmt = $connect->prepare($sql); 
     $stmt->execute();
     $comment = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include '../layouts/header.php' ?>
<session>
     <div class="content p-3" style=" margin: 100px auto">
          <form action="./delete_comment.php" method="post">
               <div class="content__list">
                    <table class="table table-hover text-center">
                         <thead>
                         <tr class="table-primary">
                              <th>CHECK</th>
                              <th>ID</th>
                              <th>USER_ID</th>
                              <th>PRODUCT_ID</th>
                              <th>CONTENT</th>
                              <th>DATE</th>
                              <th>STATUS</th>
                              <th>ACTIONS</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php foreach ($comment as $value) : ?>
                              <tr>
                                   <td>
                                        <input type="checkbox" name='ids[]' id='check_all' value='<?= $value['id'] ?? 0; ?>'>
                                   </td>
                                   <td><?= $value['id'] ?? 0 ?></td>
                                   <td style="font-weight:600"><?= $value['user_id'] ?></td>
                                   <td style="font-weight:600"><?= $value['product_id'] ?></td>
                                   <td><?= $value['content'] ?></td>
                                   <td><?= $value['comment_date'] ?></td>
                                   <td><?= $value['status'] ?></td>
                                   <td>
                                        <a onclick="return confirm('Bạn có muốn xóa không!!!')" 
                                        href="delete_comment.php?id=<?= $value['id'] ?>" class="btn btn-danger">DELETE</a>
                                        <a href="update_comment.php?id=<?= $value['id'] ?>" class="btn btn-info">UPDATE</a>
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
                    $sql = "SELECT * FROM comments";
                    $stmt = $connect->prepare($sql);
                    $stmt->execute();
                    $total_record = $stmt->rowCount();
                    $total_page = ceil($total_record / $pages_one);

                    if ($page > 1) {
                         echo "<a href='list_comment.php?page=($page-1)' class='btn btn-success me-1'>Previous</a>";
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                         if ($i == $page) {
                         echo "<a class='active btn btn-info text-white'>$i</a>";
                         } else {
                         echo "<a href='list_comment.php?page=$i' class=' btn btn-secondary mx-1'>$i</a>";
                         }
                    }

                    if ($i > $page && $page != $total_page) {
                         echo "<a href='list_comment.php?page=($page+1)' class='btn btn-success ms-1'>Next</a>";
                    }
                    ?>

               </div>
        </div>
     </div>
</session>

<?php include '../layouts/footer.php' ?>

