<?php
require_once '../session.php';
require_once '../library_pdo.php';
$message = [];

$flagRole = canDo('Dang_bai');
if(!$flagRole){
    echo "Bạn không có quyền đăng bài viết";
    die;
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news_id = $_POST['news_id'];
    $news_title = $_POST['news_title'];
    $news_images = $_POST['fileToUpload'];
    $news_content = $_POST['news_content'];
    $news_date = $_POST['news_date'];
    
    $file = $_FILES['fileToUpload'];
    

    // test capacity file
    if(($file['size'] < 0) ) {
        $message['fileToUpload'] = "File không được để trống";
    }

    // test type file
    $img = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    if($file['size'] > 0) {
        if(!in_array($ext, $img)) {
            $message['fileToUpload'] = "File không đúng định dạng";
        }
        $news_images = $file['name'];
    }

    if(!array_filter($message)) {
        $sql = "UPDATE news SET
        news_title='$news_title',
        news_images='$news_images',
        news_content='$news_content',
        news_date='$news_date'
        WHERE news_id='$news_id'";
         
        $connect = getConnection(); 
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        move_uploaded_file($file['tmp_name'], 'image/' .$news_images);
        header("Location: list_news.php");
    }
    
}

// select products 
$news_id = $_GET['news_id'];
$value = get_one_data("SELECT * FROM news WHERE news_id='$news_id'");
?>


<?php include '../layouts/header.php'?>

<div  style="width:1500px; margin: 160px auto" class="border p-3">
    <form action="update_news.php?news_id=<?=$value['news_id']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="news_id" value="<?= $value['news_id'] ?>">
        <div class="row description">
            <div class="col-lg-6 input__fruit">
                <textarea type="text" class="form-control" name="news_title" rows="3"  id="editor1">
                    <?= $value['news_title'] ?>
                </textarea>
            </div>
            <div class="col-lg-6 input__fruit ">
                <textarea type="text" class="form-control" name="news_content" rows="7"  id="editor2">
                    <?= $value['news_content'] ?>
                </textarea>
            </div>
        </div>
        <div class="row news__image mt-3">
            <div class="col-lg-6 input__fruit">
                <input type="hidden" name="fileToUpload" value="<?=$value['news_images']?>">
                <input type="file" class="form-control" name="fileToUpload">
                <div class="my-1"><img src="image/<?=$value['news_images']?>" width="100px" alt=""></div>
            </div>
            <div class="col-lg-6 input__fruit">
                <input type="date" class="form-control" name="news_date" placeholder="Enter created date" value="<?= $value['news_date'] ?>">
            </div>
        </div>
        <div class="input__fruit my-3">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>

<?php include '../layouts/footer.php'?>