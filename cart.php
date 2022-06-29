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
 
    
    $ids = "";
    // Trả về 1 mảng chứa các từ khóa
    $ids = (array_keys($carts)) ;
  
    
    $cartProduct = "";
    // Hàm implode chuyển array thành string
    $cartProduct = implode(",", $ids) ;
    
?>
<!-- end header and connect database php admin -->
<form method="post" action="cart.php">
    <div class="cart__content">
        <div class="main__container">
            <session class="session">
                <form action="./cart.php" method="post" enctype="multipart/form-data">
                    <div class="order__cart">
                        <div class="cart__thead">
                            <div class="thead__product">Sản phẩm</div>
                            <div class="thead__info">Thông tin sản phẩm</div>
                            <div class="thead__price">Đơn giá</div>
                            <div class="thead__quantity">Số lượng</div>
                            <div class="thead__money">Thành tiền</div>
                            <div class="thead__remove">Xóa</div>
                        </div>
                        <?php
                            $products = get_all_data("SELECT * FROM products WHERE product_id IN ($cartProduct)");
                            $totalMany = 0;
                        ?>
                        <?php foreach ($products as $key => $product): ?>
                        <div class="cart__tbody">
                            <div class="cart__tbody--image">
                                <a href="./detail.php?product_id=<?= $product['product_id'] ?? 0 ?>">
                                    <img src="./admin/products/image/<?= $product['product_images'] ?>" alt="">
                                </a>
                            </div>
                            <div class="cart__tbody--info">
                                <?= $product['product_name'] ?>
                            </div>
                            <div class="cart__tbody--price">
                                <?= number_format($product['product_price']) ?><sup>đ</sup>
                            </div>
                            <div class="cart__tbody--quantity">
                                <?php
                                    $sum_quantity = $carts[$product['product_id']];
                                    $sum_money = $sum_quantity * ($product['product_price']);
                                    $totalMany += $sum_money;
                                ?>
                                <div onclick="setProductNumber(<?= $product['product_id'] ?? 0; ?>, true)" class="cart__tbody--quantity--add">
                                    <button class="btn__add" type="button">-</button>
                                </div>
                                <div class="cart__tbody--quantity--input">
                                    <input id="product_number_<?= $product['product_id'] ?? 0; ?>" type="number"
                                        name="cart[<?= $product['product_id'] ?? 0; ?>]" class="cart__tbody--number"
                                        value="<?= $carts[$product['product_id']] ?>">
                                    <input id="product_price_<?= $product['product_id'] ?? 0; ?>" type="hidden"
                                        value="<?= number_format($product['product_price']) ?? 0; ?>">
                                </div>
                                <div onclick="setProductNumber(<?= $product['product_id'] ?? 0; ?>, false)" class="cart__tbody--quantity--less">
                                    <button class="btn__less" type="button">+</button>
                                </div>
                            </div>
                            <div id="product_total_price_<?= $product['product_id'] ?? 0; ?>" 
                                class="into__money"> <?php echo number_format($sum_money);  ?>
                            </div>
                            <div class="icon__delete">
                                <a onclick="return confirm('Bạn có muốn xóa không')"
                                    href="./delete_car.php?cart_id=<?= $product['product_id'] ?>"><i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </session>
        </div>
        <div class="checkout">
            <div class="checkout__total--money">
                <p>Tổng tiền:
                    <span><?= number_format($totalMany) ?>Đ</span>
                </p>
            </div>
            <div class="checkout__product">
                <div class="checkout__continue">
                    <button class="btn__gray">
                        <a href="./product.php">Tiếp tục mua hàng</a>
                    </button>
                </div>
                <div class="checkout__product--update">
                    <button type="submit" class="btn__primary" name="update" value="update">
                        Cập nhật giỏ hàng
                    </button>
                </div>
                <div class="checkout__order">
                    <button class="btn__success">
                        <a href="./payment.php">Tiến hành đặt hàng</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php  include "./layouts/footer.php"; ?>
<script type="text/javascript">
function setProductNumber(productId, increment = false) {
    var inputVal = parseInt($("#product_number_" + productId).val());
    var price = parseInt($("#product_price_" + productId).val());
    if (increment) {
        inputVal--;
        if (!inputVal) inputVal = 1;
    } else {
        inputVal++;
    }
    $("#product_number_" + productId).val(inputVal);
    var priceProduct = numberFormat(price * inputVal, 3, '.', '');
    $("#product_total_price_" + productId).html(priceProduct);
}

function numberFormat(number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);

    var nstr = number.toString();
    nstr += '';
    x = nstr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

    return x1 + x2;
}
</script>