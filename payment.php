<?php
    include "./layouts/header.php";
    $product_id = $_GET['product_id'] ?? 0;
    $get_number = $_GET['get_number'] ?? 1;
    
    if($product_id) {
        if(!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = 0;
        }
        $_SESSION['cart'][$product_id] += $get_number;

    }

    if(isset($_POST['update']) && ($_POST['update'] == 'update')){
        $_SESSION['cart'] = $_POST['cart'] ?? '';
    } 
    
    $carts = $_SESSION['cart'] ?? [];
    // Trả về 1 mảng chứa các từ khóa
    $ids = "";
    $ids = (array_keys($carts));

    // Hàm implode chuyển array thành string
    $cartProduct = "";
    $cartProduct = implode(",", $ids);
?>
<div class="payment__content">
    <session class="main__container">
        <div class="form__group">
            <form action="">
                <div class="customer__order">
                    <div class="form__info--product">
                        <div class="title">
                            <h4>Thông tin mua hàng</h4>
                        </div>
                        <div class="form__info--input">
                            <input type="text" class="form-control input__control" placeholder="Họ tên">
                        </div>
                        <div class="form__info--input">
                            <input type="email" class="form-control input__control" placeholder="Email">
                        </div>
                        <div class="form__info--input">
                            <input type="phone" class="form-control input__control" placeholder="Số điện thoại">
                        </div>
                        <div class="form__info--input">
                            <input type="address" class="form-control input__control" placeholder="Địa chỉ">
                        </div>
                        <div class="form__info--input">
                            <select class="form-select input__control">
                                <option selected>Tỉnh thành...</option>
                                <option value="1">Nghệ An</option>
                                <option value="2">Hà nội</option>
                                <option value="3">Bắc ninh</option>
                            </select>
                        </div>
                        <div class="form__info--input">
                            <select class="form-select input__control">
                                <option selected>Tỉnh thành...</option>
                                <option value="1">Nghệ An</option>
                                <option value="2">Hà nội</option>
                                <option value="3">Bắc ninh</option>
                            </select>
                        </div>
                        <div class="form__info--input">
                            <textarea class="form-control input__control" rows="3" placeholder="Ghi chú"></textarea>
                        </div>
                    </div>
                    <div class="form__info--payment">
                        <div class="title">
                            <h4>Thanh toán</h4>
                            <div class="payment__box">
                                <div class="form-check input__control">
                                    <input class="form-check-input" type="radio">
                                    <label class="form-check-label">
                                        Thanh toán khi giao hàng
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="order__product">
            <div class="order__list--product">
                <div class="order__list--header">
                    <div class="order__title">
                        <h4>Đơn hàng (33 sản phẩm)</h4>
                    </div>
                </div>
                <div class="order__list--body">
                    <?php
                        $products = get_all_data("SELECT * FROM products WHERE product_id IN ($cartProduct)");
                        $totalMany = 0;
                    ?>
                    <?php foreach ($products as $key => $product): ?>
                    <div class="order__list--item">
                        <div class="order__info">
                            <div class="order__info--images">
                                <img src="./assets/images/<?= $product['product_images'] ?? 0 ?>" alt="">
                                <div class="order__info--quantity">
                                    <span>
                                        <?php
                                            $sum_quantity = $carts[$product['product_id']];
                                            $sum_money = $sum_quantity * ($product['product_price']);
                                            $totalMany += $sum_money;
                                            echo $sum_quantity;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="order__info--description">
                                <p><?= $product['product_name'] ?? 0 ?></p>
                            </div>
                        </div>
                        <div class="order__price">
                            <p><?php echo number_format($sum_money);?>Đ</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="order__list--footer">
                    <div class="order__sum">
                        <h6>Tổng cộng</h6>
                    </div>
                    <div class="order__money">
                        <span><?= number_format($totalMany) ?>Đ</span>
                    </div>
                </div>
                <div class="order__summary">
                    <div class="order__link--content">
                        <a href="./cart.php"><i class="fal fa-angle-double-left"></i> Quay về giỏ hàng</a>
                    </div>
                    <div class="order__check--out">
                        <button class="btn__success" type="submit">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </session>
</div>
<?php include "./layouts/footer.php"; ?>