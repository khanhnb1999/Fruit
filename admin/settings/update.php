<?php
require_once '../session.php';
require_once '../library_pdo.php';
$message = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $id = $_POST['id'];
     $logo = $_POST['logo'];
     $banner = $_POST['banner'];
     $contact = $_POST['contact'];
     $description = $_POST['description'];

     if($_FILES['banner']['size'] > 0) {
          $banner = $_FILES['banner']['name'];
     }
     if($_FILES['logo']['size'] > 0) {
          $logo = $_FILES['logo']['name'];
     }

     $sql = "UPDATE settings SET
     logo = '$logo',
     banner = '$banner',
     contact = '$contact',
     description = '$description'
     WHERE setting_id='$id'";
     
     $connect = getConnection(); 
     $stmt = $connect->prepare($sql);
     $stmt->execute();
     move_uploaded_file($_FILES['logo']['tmp_name'], 'image/' . $logo);
     move_uploaded_file($_FILES['banner']['tmp_name'], 'image/' . $banner);
     header("Location: list.php");
}
$id = $_GET['id'];
$value = get_one_data("SELECT * FROM settings WHERE setting_id='$id'");

?>

<?php include '../layouts/header.php'?>

<div style="width:1500px; margin: 160px auto" class="border p-3">
    <form action="update.php?id=<?=$value['setting_id']?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $value['setting_id'] ?>">
          <div class="row store__info">
               <div class="col-lg-6 contact">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <textarea type="text" class="form-control" name="contact" rows="7" id="editor1">
                         <?= $value['contact'] ?>
                    </textarea>
               </div>
               <div class="col-lg-6 description">
               <h5 for="">GIỚI THIỆU CÔNG TY</h5>
                    <textarea type="text" class="form-control" name="description" rows="7" id="editor2">
                         <?= $value['description'] ?>
                    </textarea>
               </div>
          </div>
          <div class="row form__group mt-3">
               <div class="col-lg-6 input__fruit">
                    <p class="m-1"><b>LOGO</b></p>
                    <input type="hidden" name="logo" value="<?=$value['logo']?>">
                    <input type="file" class="form-control" name="logo">
                    <div class="my-1">
                         <img src="image/<?=$value['logo']?>" width="100px" alt="">
                    </div>
               </div>
               <div class="col-lg-6 input__fruit">
                    <p class="m-1"><b>BANNER</b></p>
                    <input type="hidden" name="banner" value="<?=$value['banner']?>">
                    <input type="file" class="form-control" name="banner">
                    <div class="my-1">
                         <img src="image/<?=$value['banner']?>" width="100px" alt="">
                    </div>
               </div>
          </div>
          <div class="input__fruit my-3">
               <button type="submit" class="btn btn-success">Update</button>
          </div>
    </form>
</div>

<?php include '../layouts/footer.php'?>