<?php
require_once '../session.php';
require_once '../library_pdo.php';
$admin = $_SESSION['username'];

if($admin != 'khanhnb250399') {
     echo "<script>
          alert('Bạn không có quyền đăng nhập vào tài khoản admin');
     </script>";die;
}

if(isset($_POST['btn-update'])) {
     $ad_username = $_POST['ad-username'];
     $ad_email = $_POST['ad-email'];
     $ad_password = $_POST['ad-password'];
     $ad_address = $_POST['ad-address'];
     $ad_phone = $_POST['ad-phone'];

     $sql = "UPDATE users SET
     user_name='$ad_username',
     user_email='$ad_email',
     user_password='$ad_password',
     user_address='$ad_address',
     user_phone='$ad_phone'
     WHERE user_id='1'
     ";

     $connect = getConnection();
     $stmt = $connect->prepare($sql);
     $stmt->execute();

}

if(isset($_POST['create-account'])) {
     $mb_username = $_POST['mb-username'];
     $mb_email = $_POST['mb-email'];
     $mb_password = $_POST['mb-password'];
     $mb_address = $_POST['mb-address'];
     $mb_phone = $_POST['mb-phone'];

     $data = [
          'user_name' => $mb_username,
          'user_email' => $mb_email,
          'user_password' => $mb_password,
          'user_address' => $mb_address,
          'user_phone' => $mb_phone,
          'user_type' => 'Admin',
     ];

     insert('users',$data);
}

$getValueAd = get_one_data("SELECT * FROM users WHERE user_id='1'");

?>

<?php require_once "../layouts/header.php"; ?>
<div class="modal__content">
     <div class="form__group">
          <div class="item account__admin">
               <div class="header__title">
                    <h5>Cập nhật tài khoản</h5>
               </div>
               <form action="./account_admin.php" method="post">
                    <div class="info__manager">
                         <div class="title">
                              <span>Username</span>
                         </div>
                         <div class="get__input">
                              <input type="text" name="ad-username" class="form-control user-case"
                               placeholder="username" value="<?= $getValueAd['user_name'] ?>">
                         </div>
                    </div>
                    <div class="info__manager">
                         <div class="title">
                              <span>Email</span>
                         </div>
                         <div class="get__input">
                              <input type="email" name="ad-email" class="form-control user-case" 
                              placeholder="username@gmail.com" value="<?= $getValueAd['user_email'] ?>">
                         </div>
                    </div>
                    <div class="info__manager">
                         <div class="title">
                              <span>Password</span>
                         </div>
                         <div class="get__input">
                              <input type="password" name="ad-password" class="form-control user-case" 
                              placeholder="password" value="<?= $getValueAd['user_password'] ?>">
                         </div>
                    </div>
                    <div class="info__manager">
                         <div class="title">
                              <span>Address</span>
                         </div>
                         <div class="get__input">
                              <input type="address" name="ad-address" class="form-control user-case" 
                              placeholder="address" value="<?= $getValueAd['user_address'] ?>">
                         </div>
                    </div>
                    <div class="info__manager">
                         <div class="title">
                              <span>Phone</span>
                         </div>
                         <div class="get__input">
                              <input type="phone" name="ad-phone" class="form-control user-case" 
                              placeholder="Phone" value="<?= $getValueAd['user_phone'] ?>">
                         </div>
                    </div>
                    <div class="update__admin">
                         <button type="submit" name='btn-update'>Update</button>
                    </div>
               </form>
          </div>
          <div class="item add__member">
          <div class="header__title">
                    <h5>Thêm thành viên quản trị</h5>
               </div>
               <form action="./account_admin.php" method="post">
                    <div class="member__news">
                         <div class="title">
                              <span>Username</span>
                         </div>
                         <div class="get__input">
                              <input type="text" name="mb-username" class="form-control user-case" placeholder="Username" >
                         </div>
                    </div>
                    <div class="member__news">
                         <div class="title">
                              <span>Email</span>
                         </div>
                         <div class="get__input">
                              <input type="email" name="mb-email" class="form-control user-case" placeholder="Username@gmail.com">
                         </div>
                    </div>
                    <div class="member__news">
                         <div class="title">
                              <span>Password</span>
                         </div>
                         <div class="get__input">
                              <input type="password" name="mb-password" class="form-control user-case" placeholder="Password">
                         </div>
                    </div>
                    <div class="member__news">
                         <div class="title">
                              <span>Address</span>
                         </div>
                         <div class="get__input">
                              <input type="address" name="mb-address" class="form-control user-case" placeholder="Address" >
                         </div>
                    </div>
                    <div class="member__news">
                         <div class="title">
                              <span>Phone</span>
                         </div>
                         <div class="get__input">
                              <input type="phone" name="mb-phone" class="form-control user-case" placeholder="Phone" >
                         </div>
                    </div>
                    <div class="create__member">
                         <button type="submit" name='create-account'>Create member</button>
                    </div>
               </form>
          </div>
     </div>
</div>



<?php require_once "../layouts/footer.php"?>