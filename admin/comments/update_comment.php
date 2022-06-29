<?php
require_once '../session.php';
require_once '../library_pdo.php';

$flagRole = canDo('Binh_luan');

if(!$flagRole){
   echo "Bạn không có quyền bình luận";
   die;
}

if(isset($_POST['check-comment'])) {
     $comment_id = $_POST['comment-id'] ;
     $status = $_POST['status'];
     $sql = "UPDATE comments SET status='$status' WHERE id='$comment_id';";
     $connect = getConnection();
     $stmt = $connect->prepare($sql);
     $stmt->execute();
     header("Location: list_comment.php");
}


$getId = $_GET['id'];
$value = get_one_data("SELECT * FROM comments WHERE id='$getId'");

?>

<?php include '../layouts/header.php'?>

<div class="box__comment">
     <div class="content">
          <form action="update_comment.php?id=<?= $value['id'] ?>" method="post">
               <input type="hidden" name="comment-id" value="<?= $value['id'] ?>">
               <div class="description">
                    <h4>Nội dung</h4>
                    <span><?= $value['content'] ?></span>
               </div>
               <div class="check__box">
                    <div class="check__right">
                         <div class="form-check">
                              <input class="form-check-input" name="status" type="checkbox" value="1" >
                              <label class="form-check-label" >Show</label>
                         </div>
                    </div>
                    <div class="check__left">
                         <div class="form-check">
                              <input class="form-check-input" name="status" type="checkbox" value="0" >
                              <label class="form-check-label" >Hide</label>
                         </div>
                    </div>
               </div>
               <div class="check__submit">
                    <button type="submit" class="btn" name="check-comment">Update</button>
               </div>
          </form>
     </div>
</div>

<?php include '../layouts/footer.php'?>