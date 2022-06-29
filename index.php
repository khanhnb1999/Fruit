<?php require('./layouts/header.php'); ?>

<div class="home__content">
     <div class="list__category">
          <div class="list__category--item">
               <a href=""><img src="./assets/images/banner1.jpg" alt="Banner1"></a>
          </div>
          <div class="list__category--item">
               <a href=""><img src="./assets/images/banner2.jpg" alt="Banner1"></a>
          </div>
          <div class="list__category--item">
               <a href=""><img src="./assets/images/banner3.jpg" alt="Banner1"></a>
          </div>
     </div>

     <div class="list__product">
          <div class="navbar__catalog">
               <div class="navbar__title">
                    <?php $catalog = get_all_data("SELECT * FROM catalogs");?>
                    <ul class="tabs">
                         <?php foreach ($catalog as $key => $cate): ?>
                              <li class="nav__item">
                                   <span data-tab="tab-<?= $cate['catalog_id'] ?? 0; ?>"class="tabs-link  
                                        <?php if (!$key) {echo ' current has-content';}?>">
                                        <?php echo $cate['catalog_name'] ?? ''; ?>
                                   </span>
                              </li>
                         <?php endforeach;?>
                    </ul>
                    <ul class="form__group">
                         <form action="./index.php" method="get">
                              <div class="form__item">
                                   <li>
                                        <input type="text" name="keyword" class="search__pr" placeholder="Tìm sản phẩm"
                                        value="<?php echo (isset($_GET['keyword']) ? $_GET['keyword'] : '') ?>">
                                   </li>
                                   <li>
                                        <button type="submit" name="search" class="btn__search" value="send">
                                             <i class="fas fa-search"></i>
                                        </button>
                                   </li>
                              </div>
                         </form>
                    </ul>
               </div>
          </div>

          <?php
               foreach ($catalog as $key => $cate):
               $cateId = $cate['catalog_id'] ?? 0;
               $name_pr = $_GET['keyword'] ?? 0;

               if(isset($_GET['search']) && $_GET['search'] == 'send') {
                    if(!empty($name_pr)) {
                         $products = get_all_data("SELECT * FROM products WHERE product_name LIKE '%$name_pr%'");
                    } else {
                         $products = get_all_data("SELECT * FROM products WHERE catalog_id=$cateId ORDER BY product_id DESC LIMIT 8");
                    }
               } else {
                    $products = get_all_data("SELECT * FROM products WHERE catalog_id=$cateId ORDER BY product_id DESC LIMIT 8");
               }
          ?>
          <div id="tab-<?= $cate['catalog_id'] ?? 0 ?>">
               <div class="product__info tab-content <?php if (!$key) {echo ' current ';}?>">
                    <?php foreach ($products as $key => $product):?>
                    <div class="product__info--item">
                         <figure>
                              <a href="./detail.php?product_id=<?=$product['product_id']?>">
                                   <img src="./admin/products/image/<?=$product['product_images']?>" alt="">
                              </a>
                         </figure>
                         <h6>
                              <?=$product['product_name']?>
                         </h6>
                         <span>
                              <?= number_format($product['product_price']) ?><sup>đ</sup>
                         </span>
                         <div class="product__info--icon">
                              <div class="product__info--icon--car">
                                   <button class="product__info--icon--btn">
                                        <a href="./cart.php?product_id=<?=$product['product_id']?>">
                                             <i class="fas fa-cart-arrow-down"></i>
                                        </a>
                                   </button>
                              </div>
                              <div class="product__info--icon--plus">
                                   <button class="product__info--icon--btn">
                                        <a href="./detail.php?product_id=<?=$product['product_id']?>">
                                             <i class="fas fa-plus"></i>
                                        </a>
                                   </button>
                              </div>
                         </div>
                    </div>
                    <?php endforeach;?>
               </div>
          </div>
          <?php endforeach;?>
     </div>

     <div class="content__banner">
          <img src="./assets/images/banner-content.jpg" alt="Banner 5">
     </div>

     <div class="product__outstanding">
          <div class="product__outstanding--title">
               <div class="product__outstanding--title--name">
                    <h5>Thịt - Hải sản</h5>
               </div>
          </div>
          <div class="product__info ">
               <?php 
                    $products = get_all_data("SELECT * FROM products WHERE catalog_id='3' ORDER BY product_id DESC LIMIT 4");
               ?>
               <?php foreach ($products as $key => $product) : ?>
               <div class="product__info--item ">
                    <figure>
                         <a href="./detail.php?product_id=<?=$product['product_id']?>">
                              <img src="./admin/products/image/<?=$product['product_images']?>" alt="">
                         </a>
                    </figure>
                    <h6>
                         <?=$product['product_name']?>
                    </h6>
                    <span>
                         <?= number_format($product['product_price']) ?><sup>đ</sup>
                    </span>
                    <div class="product__info--icon">
                         <div class="product__info--icon--car">
                              <button class="product__info--icon--btn">
                                   <a href=""><i class="fas fa-cart-arrow-down"></i></a>
                              </button>
                         </div>
                         <div class="product__info--icon--plus">
                              <button class="product__info--icon--btn">
                                   <a href="./detail.php?product_id=<?=$product['product_id']?>">
                                        <i class="fas fa-plus"></i>
                                   </a>
                              </button>
                         </div>
                    </div>
               </div>
               <?php endforeach; ?>
          </div>
     </div>

     <div class="policy">
          <div class="policy__detail">
               <img src="./assets/images/banner-6.jpg" alt="Chính sách vận chuyển">
          </div>
          <div class="policy__detail">
               <img src="./assets/images/banner-6.jpg" alt="Chính sách vận chuyển">
          </div>
     </div>

     <div class="news">
          <div class="news__update">
               <div class="news__update--border--left"></div>
               <div class="news__update--title">
                    <h5>Tin cập nhật</h5>
               </div>
               <div class="news__update--border--right"></div>
          </div>
          <div class="news__post">
               <?php 
                    $news = get_all_data("SELECT * FROM news ORDER BY news_id ASC LIMIT 3");
               ?>
               <?php foreach ($news as $key => $new): ?>
               <div class="news__post--item">
                    <a href="">
                         <img src="./admin/news/image/<?=$new['news_images']?>" alt="">
                    </a>
                    <h6>
                         <a href=""><?=$new['news_title']?></a>
                    </h6>
                    <span>
                         <?=$new['news_content']?>
                    </span>
                    <div class="news__btn">
                         <button> <a href="">Chi tiết</a></button>
                    </div>
               </div>
               <?php endforeach; ?>
          </div>
     </div>
     
</div>
<?php include "./layouts/footer.php";?>
