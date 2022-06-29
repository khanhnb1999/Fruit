<?php

require_once '../library_pdo.php';

$message = [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $contact = $_POST['contact'];
     $description = $_POST['description'];

     if($_FILES['logo']['size'] > 0) {
          $logo = $_FILES['logo']['name'];
          $banner = $_FILES['banner']['name'];
          move_uploaded_file($_FILES['logo']['tmp_name'], 'image/' . $logo);
          move_uploaded_file($_FILES['banner']['tmp_name'], 'image/' . $banner);
     
          $data = [
               'logo' => $logo,
               'banner' => $banner,
               'contact' => $contact,
               'description' => $description,
          ];
          
          insert('settings',$data);
          header("Location: list.php");
          
     }
    
}

?>

<?php include '../layouts/header.php'?>

<div style="width:1500px; margin: 160px auto" class="border p-3">
    <form action="add.php" method="post" enctype="multipart/form-data">
          <div class="row store__info">
               <div class="col-lg-6 contact">
                    <h5 for="">THÔNG TIN LIÊN HỆ</h5>
                    <textarea type="text" class="form-control" name="contact" rows="7" id="editor1"></textarea>
               </div>
               <div class="col-lg-6 description">
                    <h5 for="">GIỚI THIỆU CÔNG TY</h5>
                    <textarea type="text" class="form-control" name="description" rows="7" id="editor2"></textarea>
               </div>
          </div>
          <div class="row form__group mt-3">
               <div class= "col-lg-6 input__fruit ">
                    <label for=""><b>LOGO</b></label>
                    <input type="file" class="form-control" name="logo">
               </div>
               <div class="col-lg-6 input__fruit">
               <label for=""><b>BANNER</b></label>
                    <input type="file" class="form-control" name="banner">
               </div>
          </div>
          <div class="input__fruit my-3">
               <button type="submit" class="btn btn-success">Add</button>
          </div>
    </form>
</div>

<?php include '../layouts/footer.php'?>