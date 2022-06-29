<!DOCTYPE html>
<html lang="en">
    <?php include ("../library_pdo.php"); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="../ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../assets/style/sass/style.css">
    <link rel="icon" href="./../assets/images/logo3.ico">
    <title>
          <?php
               // basename() trả lại tên tệp đường dẫn được chỉ định
               // $_SERVER['PHP_SELF'] trả về tên tệp của tập lệnh hiện đang thực thi
               $currentFileName = basename($_SERVER['PHP_SELF']);
               echo getTitle($currentFileName);
          ?>
     </title>
</head>
<?php include './../functions.php'; ?>
<body>
    <div class="sidebar">
        <div class="sidebar__navbar">
            <div class="sidebar__content">
                <ul class="sidebar__nav">
                    <li class="sidebar__nav--group">
                        <button class="dropdown__btn">
                            <i class="fas fa-archive"></i>
                            <span>Products</span>
                            <i class="fal fa-angle-down icon__right"></i>
                        </button>
                        <ul class="dropdown__nav">
                            <li class="dropdown__item">
                                <a href="../products/list_product.php" class="dropdown__item--link">List product</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar__nav--group">
                        <button class="dropdown__btn">
                            <i class="fas fa-abacus"></i>
                            <span>Catalogs</span>
                            <i class="fal fa-angle-down icon__right"></i>
                        </button>
                        <ul class="dropdown__nav">
                            <li class="dropdown__item">
                                <a href="../catalogs/list_catalog.php" class="dropdown__item--link">List catalog</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar__nav--group">
                        <button class="dropdown__btn">
                            <i class="fas fa-newspaper"></i>
                            <span>News</span>
                            <i class="fal fa-angle-down icon__right"></i>
                        </button>
                        <ul class="dropdown__nav">
                            <li class="dropdown__item">
                                <a href="../news/list_news.php" class="dropdown__item--link">List news</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar__nav--group">
                        <button class="dropdown__btn">
                            <i class="fas fa-users "></i>
                            <span>Users</span>
                            <i class="fal fa-angle-down icon__right"></i>
                        </button>
                        <ul class="dropdown__nav">
                            <li class="dropdown__item">
                                <a href="../users/list_user.php" class="dropdown__item--link">List user</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar__nav--group">
                        <button class="dropdown__btn">
                            <i class="fas fa-comment-alt-check "></i>
                            <span>Comments</span>
                            <i class="fal fa-angle-down icon__right"></i>
                        </button>
                        <ul class="dropdown__nav">
                            <li class="dropdown__item">
                                <a href="../comments/list_comment.php" class="dropdown__item--link">List comments</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <header class="header">
        <div class="header__top">
            <ul class="nav__left">
                <li class="header__brand">
                    <div class="brand">
                        <img src="../assets/image/logo2.png" alt="">
                    </div>
                    <span class="icon__bars"><i class="fal fa-bars"></i></span>
                </li>
                <li class="header__search">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                        <div class="input__group">
                            <span class="input-search">
                                <input type="text" placeholder="Tìm kiếm" name="sr-keyword">
                            </span>
                            <span class="input-btn">
                                <button type="submit" class="btn__dark" name="search-keyword" value="search">
                                    <i class="fas fa-search"></i>
                                 </button>
                            </span>
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav__right">
                <li class="item user__avatar">
                    <img src="../assets/image/avatar.jpg" alt="">
                </li>
                <li class="item user__account">
                    <span id="user">
                        <?php
                        if(isset($_SESSION['username'])) {
                            echo $_SESSION['username'] ?? 0;
                        }
                        ?>
                        <i class="fal fa-angle-down icon__dropdown"></i>
                    </span>
                    <ul class="dropdown__menu" id="myDropdown">
                        <li class="nav__item">
                            <a href="../settings/list.php" class="nav__link"><i class="far fa-cog "></i> Settings</a>
                        </li>
                        <li class="nav__item">
                            <a href="../users/account_admin.php" class="nav__link"><i class="far fa-user "></i> Profile</a>
                        </li>
                        <li class="nav__item">
                            <a href="<?php echo $baseUrl; ?>/login.php" class="nav__link"><i class="fal fa-sign-out "></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <div class="main__content">