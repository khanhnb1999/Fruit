<?php include "./layouts/header.php"; ?>

<?php

if (isset($_POST['btn-submit'])) {
     if(isset($_SESSION['username'])) {
          $comment = $_POST['comment'];
          $productId = $_GET['product_id'];
          $username = $_SESSION['username'] ;
          
          if (!empty($username)) {
               $user_id = get_one_data("SELECT * FROM users WHERE user_name='$username'");
               $userId = $user_id['user_id'];
               $date = date('Y-m-d');
               
               $data = [
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'content' => $comment,
                    'comment_date' =>$date,
                    'status' => '0',
               ];
               insert('comments',$data);
          }
     } else {
          echo "<div class='message-account'>
                    <button class='close-time'>
                         <i class='fas fa-times-circle'></i>
                    </button>
                    <span>Đăng nhập tài khoản</span>
               </div>";
     }
    
}

?>

<!-- end header -->
<div class="grid__app">
     <div class="content">
          <div class="product__description">
               <div class="product__detail">
                    <div class="product__detail--images">
                         <?php
                              $product_id = $_GET['product_id'];
                              $value = get_one_data("SELECT * FROM products WHERE product_id='$product_id'");
                         ?>
                         <div class="images__larger">
                              <a href="">
                                   <img src="./admin/products/image/<?= $value['product_images'] ?? 0 ?>"alt="">
                              </a>
                         </div>
                         <div class="images__slide">
                              <?php
                                   $products = get_all_data("SELECT * FROM products ORDER BY product_id ASC LIMIT 4");
                              ?>
                              <?php foreach ($products as $key => $product) : ?>
                              <div class="images__slide--item">
                                   <a href="">
                                        <img src="./admin/products/image/<?= $product['product_images'] ?? 0 ?>" alt="">
                                   </a>
                              </div>
                              <?php endforeach; ?>
                         </div>
                    </div>
                    <!-- info images product -->
                    <div class="product__detail--info">
                         <div class="product__detail--info--title">
                              <h4>
                                   <?= $value['product_name'] ?? 0 ?>
                              </h4>
                         </div>
                         <div class="product__detail--info--status">
                              <p>Trạng thái:
                                   <span>
                                        <i class="fas fa-check"></i> Còn hàng
                                   </span>
                              </p>
                         </div>
                         <div class="product__detail--info--price">
                              <h4>
                                   <?= number_format($value['product_price']) ?><sup>đ</sup>
                              </h4>
                         </div>
                         <div class="product__detail--info--description">
                              <p>
                                   <?= $value['product_content'] ?? 0 ?>
                              </p>
                         </div>
                         <div class="form__group">
                              <form action="./cart.php" method="get" enctype="multipart/form-data">
                                   <div class="order">
                                        <div class="order__quantity">
                                             <input type="hidden" value="<?= $value['product_id'] ?? 0 ?>"
                                                  name="product_id">
                                             <label for="" class="form__label">Số lượng:</label>
                                             <input type="number" class="form__input" name="get_number" value="1"
                                                  size="20">
                                        </div>
                                        <div class="order__buying">
                                             <button type="submit" class="btn__success" name="btn_submit"
                                                  value="add_product">
                                                  Mua hàng
                                             </button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <div class="tabs">
                    <div class="tabs__current">
                         <a href="#">Mô tả</a>
                    </div>
                    <div class="tabs__description">
                         <span>
                              <?= $value['product_content'] ?>
                         </span>
                    </div>
               </div>
               <div class="show__comments">
                    <?php
                         $comment = get_all_data("SELECT * FROM comments WHERE status = '1'");
                    ?>
                    <ul>
                         <?php foreach ($comment as $key => $value) : ?>
                              <span><?= $value['comment_date'] ?? 0 ?></span>
                              <li><?= $value['content'] ?? 0 ?></li>
                         <?php endforeach; ?>
                    </ul>
               </div>
               <div class="comment">
                    <div class="review__comment">
                         <span class="show-comment">Bình luận</span>
                    </div>
                    <div class="reply__comment">
                         <form action="./detail.php?product_id=<?php echo $product_id; ?>" method="post">
                              <div class="form__group">
                                   <div class="avatar">
                                        <span><i class="far fa-user"></i></span>
                                   </div>
                                   <div class="comments">
                                        <div class="comment__input">
                                             <input type="text" size="50" name="comment" class="form-control rep-message"
                                                 id="message" placeholder="Nhập bình luận...">
                                        </div>
                                        <div class="comment__send">
                                            <div class="go-send active">
                                                  <button type="submit" name="btn-submit" value="btn-submit">
                                                       <i class="fas fa-angle-double-right"></i>
                                                  </button>
                                            </div>
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
          <div class="navbar__catalogs">
               <div class="aside">
                    <div class="aside__title">
                         <h5>DANH MỤC</h5>
                    </div>
                    <div class="menu__list--menu">
                         <ul class="navbar__item">
                              <li>
                                   <a href="./index.php">
                                        <i class="fas fa-arrow-alt-circle-right"></i>Trang chủ
                                   </a>
                              </li>
                              <li>
                                   <a href="./product.php">
                                        <i class="fas fa-arrow-alt-circle-right "></i>Sản phẩm
                                   </a>
                              </li>
                              <li>
                                   <a href="./news.php">
                                        <i class="fas fa-arrow-alt-circle-right "></i>Tin tức
                                   </a>
                              </li>
                              <li>
                                   <a href="./detail.php">
                                        <i class="fas fa-arrow-alt-circle-right"></i>Chi tiết
                                   </a>
                              </li>
                              <li>
                                   <a href="">
                                        <i class="fas fa-arrow-alt-circle-right"></i>Liên hệ
                                   </a>
                              </li>
                         </ul>
                    </div>
               </div>
               <!-- end list category and outstanding product -->
               <div class="product__featured">
                    <div class="product__featured--title">
                         <h5>Sản phẩm nổi bật</h5>
                    </div>
                    <div class="featured__news">
                         <?php
                              $products = get_all_data("SELECT * FROM products ORDER BY product_id ASC LIMIT 5");
                         ?>
                         <?php foreach ($products as $key => $product) : ?>
                         <div class="featured__news--item">
                              <div class="featured__images">
                                   <a href="./detail.php?product_id=<?= $product['product_id'] ?>">
                                        <img src="./admin/products/image/<?= $product['product_images'] ?>" alt="">
                                   </a>
                              </div>
                              <div class="featured__info">
                                   <p>
                                        <a href="./detail.php?product_id=<?= $product['product_id'] ?>">
                                             <?= $product['product_name'] ?>
                                        </a>
                                   </p>
                                   <span>
                                        <?= number_format($product['product_price']) ?><sup>đ</sup>
                                   </span>
                              </div>
                         </div>
                         <?php endforeach; ?>
                    </div>
               </div>
          </div>
     </div>

     <div class="news">
          <div class="news__update">
               <div class="news__update--border--left"></div>
               <div class="news__update--title">
                    <h5>Sản phẩm nối bật</h5>
               </div>
               <div class="news__update--border--right"></div>
          </div>
     </div>

     <div class="list__product">
          <?php
               $products = get_all_data("SELECT * FROM products WHERE catalog_id='1' ORDER BY product_id ASC LIMIT 4");
          ?>
          <?php foreach ($products as $key => $product) : ?>
          <div class="list__product--item">
               <figure>
                    <a href="./detail.php?product_id=<?= $product['product_id'] ?>">
                         <img src="./admin/products/image/<?= $product['product_images'] ?>" alt="">
                    </a>
               </figure>
               <h6>
                    <?= $product['product_name'] ?>
               </h6>
               <span>
                    <?= number_format($product['product_price']) ?><sup>đ</sup>
               </span>
               <div class="item__icon">
                    <div class="item__icon--car">
                         <button>
                              <a href="./cart.php?product_id=<?= $product['product_id'] ?>"><i
                                        class="fas fa-cart-arrow-down"></i>
                              </a>
                         </button>
                    </div>
                    <div class="item__icon--plus">
                         <button>
                              <a href="./detail.php?product_id=<?= $product['product_id'] ?>"> <i
                                        class="fas fa-plus"></i>
                              </a>
                         </button>
                    </div>
               </div>
          </div>
          <?php endforeach; ?>
     </div>
</div>
<!-- end main content -->
<?php include "./layouts/footer.php"; ?>