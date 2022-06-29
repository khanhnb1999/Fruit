<?php

include "./library_pdo.php";
if(isset($_POST['register'])) {
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $address = $_POST['address'];
     $phone = $_POST['phone'];
     $user_type = "Admin";

     $user = get_one_data("SELECT * FROM users WHERE user_name='$username' OR user_email='$email'");
     if(empty($user)) {
          $data = [
               'user_name' => $username,
               'user_email' => $email,
               'user_password' => $password,
               'user_address' => $address,
               'user_phone' => $phone,
               'user_type' => $user_type,
          ];

          insert('users', $data);
          header("Location: ./products/list_product.php");
     }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="./assets/style/sass/style.css">
     <title>Registration</title>
</head>
<?php include './functions.php'; ?>
<body>
     <div class="grid">
          <div class="form__registration">
               <form action="./registration.php" method="post">
                    <div class="modal__content">
                         <div class="title">
                              <span>Welcome</span>
                         </div>
                         <div class="modal__body">
                              <div class="input__control">
                                   <input type="text" name="username" class="form-control form__control"  placeholder="Username">
                              </div>
                              <div class="input__control">
                                   <input type="email" name="email" class="form-control form__control"placeholder="Email">
                              </div>
                              <div class="input__control">
                                   <input type="password" name="password" class="form-control form__control"  placeholder="Password">
                              </div>
                              <div class="input__control">
                                   <input type="password" class="form-control form__control" placeholder="Re-password">
                              </div>
                              <div class="input__control">
                                   <input type="address" name="address" class="form-control form__control"  placeholder="Address">
                              </div>
                              <div class="input__control">
                                   <input type="phone" name="phone" class="form-control form__control" placeholder="Phone">
                              </div>
                              <div class="form__check">
                                   <input class="form-check-input" type="checkbox">
                                   <label class="form-check-label">
                                        Indeterminate checkbox
                                   </label>
                              </div>
                              <div class="form__account">
                                   <span>Already have an account?
                                        <a href="./login.php">Login in</a> | <a href="./forgot_password.php">Recover
                                             password</a>
                                   </span>
                              </div>
                         </div>
                         <div class="modal__footer">
                              <button type="submit" name="register">Create account</button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</body>

</html>