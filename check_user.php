<?php

session_start();
include "./admin/library_pdo.php";

if(isset($_POST['register-user'])) {
     $username = $_POST['username'] ;
     $email = $_POST['email'];
     $password = $_POST['password'];
     $address = $_POST['address'];
     $phone = $_POST['phone'];
     $user_type = "Customer";

     $user = get_one_data("SELECT * FROM users WHERE user_name='$username' OR user_email='$email'");
     if(empty($user)) {
          $_SESSION['username'] = $username;
          $data = [
               'user_name' => $username,
               'user_email' => $email,
               'user_password' => $password,
               'user_address' => $address,
               'user_phone' => $phone,
               'user_type' => $user_type,
          ];

          insert('users', $data);
     }
     header("Location: index.php");
}


if(isset($_POST['login-user'])) {
     $username1 = $_POST['username1'];
     $password1 = $_POST['password1'];
     $user_login = get_one_data("SELECT * FROM users WHERE user_name='$username1' AND user_password='$password1'");
     if($user_login) {
          header("Location: index.php");
     } else {
          $message['password1'] = "Mật khẩu không đúng";
     }
}


?>