<!DOCTYPE html>
<html lang="en">
<?php include("./admin/library_pdo.php"); session_start(); ?>
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
     <link rel="stylesheet" href="./sass/style.css" />
     <link rel="icon" href="./assets/images/logo3.ico" />
     <title>
          <?php
               // basename() trả lại tên tệp đường dẫn được chỉ định
               // $_SERVER['PHP_SELF'] trả về tên tệp của tập lệnh hiện đang thực thi
               $currentFileName = basename($_SERVER['PHP_SELF']);
               echo getTitle($currentFileName);
          ?>
     </title>
</head>
<body>
     <header class="header">
          <div class="box__modal">
               <div class="header__top">
                    <div class="header__top--left">
                         <p>
                              <i class="fas fa-phone-square-alt"></i>
                              <span>Hotline: 1900 6750</span>
                         </p>
                    </div>
                    <!-- end header hotline we contact -->
                    <div class="header__top--right">
                         <ul class="navbar__register">
                              <li>
                                   <button id="btn-open">
                                        <i class="fas fa-user"></i> Đăng kí
                                   </button>
                                   <div class="box__overlay" id="myForm">
                                        <div class="form__registration">
                                             <form action="./check_user.php" id="user-account" method="post">
                                                  <div class="modal__content">
                                                       <button type="button" class="btn__close">
                                                            <i class="fas fa-times"></i>
                                                       </button>
                                                       
                                                       <div class="modal__body">
                                                            <div id="tab-register" class="user-tab-body active">
                                                                 <div class="title">
                                                                      <span>Welcome</span>
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="text" name="username" require class="form-control form__control" placeholder="Username">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="email" name="email" require class="form-control form__control" placeholder="Username@gmail.com">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="password" name="password" require class="form-control form__control" placeholder="Password">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="password" class="form-control form__control" placeholder="Re-password">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="address" name="address" class="form-control form__control" placeholder="Address">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="phone" name="phone" class="form-control form__control" placeholder="Phone">
                                                                 </div>
                                                                 <div class="form__check">
                                                                      <input class="form-check-input" type="checkbox">
                                                                      <label class="form-check-label"> Remember</label>
                                                                 </div>
                                                                 <div class="modal__footer">
                                                                      <button type="submit" name="register-user">Create account</button>
                                                                 </div>
                                                            </div>
                                                            <div id="tab-login" class="user-tab-body">
                                                                 <div class="form__login__title">
                                                                      <h4>Welcome back</h4>
                                                                      <p>Please sign in to your account below</p>
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="text" name="username1" class="form-control form__control" placeholder="Username">
                                                                 </div>
                                                                 <div class="input__control">
                                                                      <input type="password" name="password1" class="form-control form__control" placeholder="Enter password">
                                                                      <span style="color:red">
                                                                           <?= $message['password'] ?? '' ?>
                                                                      </span>
                                                                 </div>
                                                                 <div class="keep__me">
                                                                      <input class="form-check-input" type="checkbox" name="remember" value="1">
                                                                      <label class="form-check-label">Keep me logged in</label>
                                                                 </div>
                                                                 <div class="dashboard">
                                                                      <button class="btn btn__info" type="submit" name="login-user">Login in</button>
                                                                 </div>

                                                            </div>
                                                            <div id="tab-forgot" class="user-tab-body recover__password">
                                                                 <div class="tab__password">
                                                                      <div class="tab__header">
                                                                           <h3>Fogot your password</h3>
                                                                           <p>Use the form below to recover it.</p>
                                                                      </div>
                                                                      <div class="tab__body ">
                                                                           <div class="tab__body--input">
                                                                                <input type="email" class="form-control form__control" name="email2" placeholder="Username@gmail.com">
                                                                           </div>
                                                                      </div>
                                                                      <div class="tab__footer">
                                                                           <button class="btn btn__danger" type="submit" name="recover-user">Recover password</button>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="modal__footer">
                                                            <div class="form__account">
                                                                 <ul class="group__account">
                                                                      <li class="user-switch-form box-register d-none" data-tab="tab-register">Sign up</li>
                                                                      <li class="user-switch-form box-login" data-tab="tab-login">Login</li>
                                                                      <li class="user-switch-form box-forgot" data-tab="tab-forgot">Forgot password</li>
                                                                 </ul>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </li>
                              <div class="separate"></div>
                              <li>
                                   <div class="heading__cart">
                                        <button>
                                             <a href="./cart.php"><i class="fas fa-cart-plus "></i> Giỏ hàng</a>
                                        </button>
                                        <!-- <div class="top__cart--content">
                                             <?php
                                                  $productId = $_GET["product_id"] ?? 0;
                                                  $getNumber = $_GET["get_Number"] ?? 0;
                                                  if($productId) {
                                                       if(!isset($_SESSION['cart'][$productId])) {
                                                            $_SESSION['cart'][$productId] = 0;
                                                       }
                                                       $_SESSION['cart'][$productId] += $getNumber;
                                                       
                                                  }

                                                  $carts = $_SESSION['cart'] ?? 0;
                                                  $ids = "";
                                                  $ids = (array_keys($carts));
                                                  $cartProduct = implode(",", $ids);
                                                  $pr_all = get_all_data("SELECT * FROM products WHERE product_id IN ($cartProduct)");
                                                  $totalMany = 0;
                                             ?>
                                             <ul class="nav__item--header">
                                                  <?php foreach ($pr_all as $key => $value): ?>
                                                       <ul class="nav__item__small">
                                                            <li>
                                                                 <a href="">
                                                                      <img src="./admin/products/image/<?= $value['product_images'] ?? 0 ?>" alt="">
                                                                 </a>
                                                            </li>
                                                            <li>
                                                                 <p><?= $value['product_name'] ?? 0 ?></p>
                                                                 <span><?= number_format($value['product_price']) ?? 0 ?><sup>đ</sup></span>
                                                            </li>
                                                            <li class="delete__pr">
                                                                 <a href="./delete_car.php?cart_id=<?= $value['product_id']?>">
                                                                      <i class=" fas fa-times-circle"> </i>
                                                                 </a>
                                                                
                                                            </li>
                                                            <?php
                                                            $sum_quantity = $carts[$value['product_id']];
                                                            $sum_money = $sum_quantity * ($value['product_price']);
                                                            $totalMany += $sum_money;
                                                            ?>
                                                       </ul>
                                                  <?php endforeach ?>
                                             </ul>
                                             <ul class="nav__item--body">
                                                  <li>Tổng cộng</li>
                                                  <li><span>
                                                       <?= number_format($totalMany) ?><sup>đ</sup>
                                                  </span></li>
                                             </ul>
                                             <ul class="nav__item--footer">
                                                  <li>
                                                       <a href="./cart.php">Giỏ hàng</a>
                                                  </li>
                                                  <li>
                                                       <a href="./payment.php">Thanh toán</a>
                                                  </li>
                                             </ul>
                                        </div> -->
                                   </div>
                              </li>
                         </ul>
                    </div>

               </div>
          </div>
          <?php
               $setting = get_one_data("SELECT * FROM settings");
          ?>
          <div class="header__navbar">
               <div class="navbar__side">
                    <div class="header__navbar--left">
                         <ul class="logo__store">
                              <li>
                                   <a href="./index.php"><img src="./admin/settings/image/<?= $setting['logo'] ?>" alt=""></a>
                              </li>
                         </ul>
                         <ul class="menu__item">
                              <li>
                                   <a href="./index.php">Home</a>
                              </li>
                              <li>
                                   <a href="./product.php" >Sản phẩm</a>
                              </li>
                              <li>
                                   <a href="./news.php" >Tin tức</a>
                              </li>
                              <li>
                                   <a href="./contact.php">Liên hệ</a>
                              </li>
                         </ul>
                    </div>
                    <div class="header__navbar--right">
                         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                              <input type="text" placeholder="Tìm sản phẩm" name="keyword"
                              value="<?php echo (isset($_GET['keyword']) ? $_GET['keyword'] : '') ?>">
                              <button type="submit" name="search" value="send">
                                   <i class="fas fa-search"></i>
                              </button>
                         </form>
                    </div>
               </div>
          </div>
          <!-- end header navbar about menu and button search -->

          <div class="header__banner">
               <img src="./admin/settings/image/<?= $setting['banner'] ?>" class="header__banner--store" alt="Banner store fruit">
          </div>
          <!-- end banner images about store -->
     </header>
