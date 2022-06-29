
<?php include "./layouts/header.php"; ?>
<div class="news__details">
    <?php
        $newId = $_GET['new_id'] ;
        $new = get_one_data("SELECT * FROM news WHERE news_id=$newId");
    ?>
    <div class="info__fruit">
        <div class="title">
            <span>
                <?= $new['news_title'] ?>
            </span>
        </div>
        <div class="date__fruit">
            <?= $new['news_date'] ?>
        </div>
        <div class="image">
            <img src="./admin/news/image/<?= $new['news_images'] ?>" alt="">
        </div>
        <div class="description">
            <?= $new['news_content'] ?>
        </div>
    </div>
</div>
<!-- end content -->
<?php include "./layouts/footer.php"; ?>