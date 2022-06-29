<?php
include './functions.php';
session_start();
require_once "./library_pdo.php";

if(isset($_POST['btn-submit'])) {
    $username = $_POST['username'];
    $password  = $_POST['password'];
    
    if(isset($_POST['remember'])) { 
        setcookie("username",$username);
        setcookie("password",$_POST['password']);
    }

    // Hàm lấy 1 dòng dữ liệu
    $user =  get_one_data("SELECT * FROM users WHERE user_name='$username' AND user_password='$password'");

    if(($user)) {
        $_SESSION['btn-submit'] = $user;
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user['user_id'];
        header("Location: $baseUrl/products/list_product.php");
    
    } else {
        $message['password'] = "Mật khẩu không đúng";
    }

}

$username = "";
$password = "";
$check = false;

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    $check = true;

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
    <title>Admin - Login</title>
</head>

<body>
    <div class="grid">
        <div class="form__login">
            <div class="form__sign--in">
                <div class="form__sign--in--title">
                    <h4>Welcome back</h4>
                    <p>Please sign in to your account below</p>
                </div>
                <form action="" method="post">
                    <div class="form__sign--in--account">
                        <div class="form__sign--in--account--user">
                            <input type="text" name="username" class="form-control" placeholder="Enter username"
                                value="<?= $username ?>">
                        </div>
                        <div class="form__sign--in--account--user">
                            <input type="password" class="form-control" name="password" placeholder="Enter password"
                                value="<?= $password ?>">
                                <span style="color:red">
                                    <?= $message['password'] ?? '' ?>
                                </span>
                        </div>

                        <div class="form__sign--in--account--user">
                            <input class="form-check-input" type="checkbox" <?= ($check)?"checked" : "" ?>
                                name="remember" value="1">
                            <label class="form-check-label">Keep me logged in</label>
                        </div>
                        <div class="form__sign--in--account--user">
                            <p>No account? <a href="./registration.php">Sign up now</a></p>
                        </div>
                        <div class="form__sign--in--account--user--button">
                            <div class="form__sign--in--account--user--password">
                                <button class="btn btn__danger"><a href="./forgot_password.php">Recover
                                        password</a></button>
                            </div>
                            <div class="form__sign--in--account--user--dashboard">
                                <button class="btn btn__info" type="submit" name="btn-submit">Sign in</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>