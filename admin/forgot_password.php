<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style/sass/style.css">
    <title>Fogot Password</title>
</head>
<?php include './functions.php'; ?>
<body>
    <div class="grid__forgot--password">
        <form action="forgot_password.php">
            <div class="tab__password">
                <div class="tab__header">
                    <h3>Fogot your password</h3>
                    <p>Use the form below to recover it.</p>
                </div>
                <div class="tab__body">
                    <div class="tab__body--input">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email ">
                    </div>
                    <div class="tab__body--sign--in">
                        <a href="./login.php">Sign in existing account</a>
                    </div>
                </div>
                <div class="tab__footer">
                    <button class="btn btn-primary" type="submit">Recover password</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>