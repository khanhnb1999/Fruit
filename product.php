

<?php include "./layouts/header.php"; ?>
<div class="product__content">
    <div class="title__fruits">
        <h4>Hoa quả tươi</h4>
    </div>
    <div class="list__product">
        <?php
            $name_pr = $_GET['keyword'] ?? 0;
            if(isset($_GET['search']) && $_GET['search'] == 'send') {
                if(!empty($name_pr)) {
                    $products = get_all_data("SELECT * FROM products WHERE product_name LIKE '%$name_pr%' AND catalog_id='1'");
                }
            } else {
                $products = get_all_data("SELECT * FROM products WHERE catalog_id='1' ORDER BY product_id ASC LIMIT 8");
            }
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
                        <a href="./cart.php?product_id=<?= $product['product_id'] ?>">
                            <i class="fas fa-cart-arrow-down"></i>
                        </a>
                    </button>
                </div>
                <div class="item__icon--plus">
                    <button>
                        <a href="./detail.php?product_id=<?= $product['product_id'] ?>">
                            <i class="fas fa-plus"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <!-- end page products -->

    <div class="title__fruits">
        <h4>Rau củ tươi</h4>
    </div>
    <div class="list__product">
        <?php 
            $products = get_all_data("SELECT * FROM products WHERE catalog_id='2' ORDER BY product_id ASC LIMIT 8");
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
                        <a href="./cart.php?product_id=<?= $product['product_id'] ?>">
                            <i class="fas fa-cart-arrow-down"></i>
                        </a>
                    </button>
                </div>
                <div class="item__icon--plus">
                    <button>
                        <a href="./detail.php?product_id=<?= $product['product_id'] ?>">
                            <i class="fas fa-plus"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

    <div class="title__fruits">
        <h4>Thịt hải sản</h4>
    </div>
    <div class="list__product">
        <?php 
            $products = get_all_data("SELECT * FROM products WHERE catalog_id='3' ORDER BY product_id ASC LIMIT 8");
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
                        <a href="./cart.php?product_id=<?= $product['product_id'] ?>">
                            <i class="fas fa-cart-arrow-down"></i>
                        </a>
                    </button>
                </div>
                <div class="item__icon--plus">
                    <button>
                        <a href="./detail.php?product_id=<?= $product['product_id'] ?>"> 
                            <i class="fas fa-plus"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="feedback">
        <div class="feedback__content">
            <div class="feedback__content--border--left"></div>
                <div class="feedback__content--title">
                    <h5>Phản hồi của khách hàng</h5>
                </div>
            <div class="feedback__content--border--right"></div>
        </div>
        <div class="feedback__customer">
            <div class="feedback__customer--item">
                <img src="./assets/images/ngoc-trinh.jpg" alt="Ngoc trinh">
                <h5>Người mẫu - Ngọc Trinh</h5>
                <p>
                    Là một người khá kỹ tính, tôi luôn luôn lựa chọn
                    những thực phẩm sạch nhất. Và Đây là nơi tôi Đặt
                    trọng niềm tin.
                </p>
            </div>
            <div class="feedback__customer--item">
                <img src="./assets/images/phuong-trinh.jpg" alt="Ngoc trinh">
                <h5>Diễn viên - Phương Trinh</h5>
                <p>
                    Là một người khá kỹ tính, tôi luôn luôn lựa chọn
                    những thực phẩm sạch nhất. Và Đây là nơi tôi Đặt
                    trọng niềm tin.
                </p>
            </div>
            <div class="feedback__customer--item">
                <img src="./assets/images/hoang-yen.jpg" alt="Ngoc trinh">
                <h5>Ca sĩ - Hoàng yến</h5>
                <p>
                    Là một người khá kỹ tính, tôi luôn luôn lựa chọn
                    những thực phẩm sạch nhất. Và Đây là nơi tôi Đặt
                    trọng niềm tin.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end content page -->
<?php include "./layouts/footer.php" ?>


