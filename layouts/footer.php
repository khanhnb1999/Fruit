<footer class="footer">
     <div class="main__footer">
          <div class="item regulation policy">
               <h6>Quy định - chính sách</h6>
               <p>Hướng dẫn đặt hàng và thanh toán</p>
               <p>Chính sách giao hàng và đổi trả</p>
               <p>Chính sách bảo mật thông tin</p>
          </div>
          <div class="item category">
               <h6>Danh mục</h6>
               <div class="list__menu">
                    <a href="#">Home</a>
                    <a href="#">Sản phẩm</a>
                    <a href="#">Tin tức</a>
                    <a href="#">Liên hệ</a>
               </div>
          </div>
          <div class="item contact">
               <?php
                    $value = get_one_data("SELECT * FROM settings ORDER BY setting_id ASC LIMIT 1");
               ?>
               <h6>Liên hệ</h6>
               <span>
                    <?= $value['contact'] ?>
               </span>
               <div class="form__group">
                    <div class="side__input">
                         <input type="text" class="send__email" placeholder="Email">
                    </div>
                    <div class="side__send">
                         <button>Gửi</button>
                    </div>
               </div>
          </div>
          <div class="item about__as">
               <div class="logo__store">
                    <h6>Về chúng tôi</h6>
                    <a href=""><img src="./admin/settings/image/<?= $value['logo'] ?>" alt=""></a>
                    <span>
                         <?= $value['description'] ?>
                    </span>
               </div>
          </div>
     </div>
     <div class="footer__sidebar">
          <div class="footer__sidebar--message">
               <a href="" class="message__link"><i class="fab fa-facebook"></i></a>
          </div>
          <div class="footer__sidebar--message">
               <a href="" class="message__link"><i class="fab fa-facebook-messenger"></i></a>
          </div>
          <div class="footer__sidebar--message">
               <a href="" class="message__link"><i class="fab fa-google"></i></a>
          </div>
          <div class="footer__sidebar--message">
               <a href="" class="message__link"><i class="fab fa-instagram"></i></a>
          </div>
     </div>
</footer>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
     integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</script>
<script type="text/javascript" src="./assets/script/home.js"></script>
<script type="text/javascript" src="./assets/script/main.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js">
</script>

</body>

</html>