<?php
require_once '../session.php';
require_once '../library_pdo.php';

// check admin có được quyền đăng bài hay ko
    $flagRole = canDo('Dang_bai');
    if(!$flagRole){
        echo "Bạn không có quyền đăng bài viết";
        die;
    }

$message = [];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news_title = $_POST['news_title'];
    $news_images = $_POST['fileToUpload'];
    $news_content = $_POST['news_content'];
    $news_date = $_POST['news_date'];
    
    // test file upload
    $file = $_FILES['fileToUpload'];
    $news_images = $file['name'];

    // test capacity file
    if(($file['size'] < 0) ) {
        $message['fileToUpload'] = "File không được để trống";
    }

    // test type file
    $img = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    if(!in_array($ext, $img)) {
        $message['fileToUpload'] = "File không đúng định dạng";
    }

    $data = [
        'news_title' => $news_title,
        'news_images' => $news_images,
        'news_content' => $news_content,
        'news_date' =>$news_date,
    ];


    if(!array_filter($message)) {
        insert('news',$data);
        move_uploaded_file($file['tmp_name'], 'image/' .$news_images);
        header("Location: list_news.php");
    }
    
}

?>


<?php include '../layouts/header.php'?>

<div style="width:1500px; margin: 160px auto" class="border p-3">
    <form action="add_news.php" method="post" enctype="multipart/form-data">
       <div class="row description">
            <div class="col-lg-6 input__fruit">
                <h6>TIÊU ĐỀ</h6>
                <textarea type="text" class="form-control" name="news_title" rows="3" id="editor1"></textarea>
            </div>
            <div class="col-lg-6 input__fruit ">
            <h6>NỘI DUNG TIN TỨC</h6>
                <textarea type="text" class="form-control" name="news_content" rows="7" id="editor2"></textarea>
            </div>
       </div>
        <div class="row news__image mt-3">
            <div class="col-lg-6 input__fruit">
                <h6>IMAGES</h6>
                <input type="file" class="form-control" name="fileToUpload">
                <div class=""><img src="image/<?=$value['news_images']?>" width="100px" alt=""></div>
            </div>
            <div class="col-lg-6 input__fruit">
                <h6>NGÀY ĐĂNG TIN</h6>
                <input type="date" class="form-control" name="news_date" placeholder="Enter created date">
            </div>
        </div>
        <div class="input__fruit my-3">
            <button type="submit" class="btn btn-success">Add news</button>
        </div>
    </form>
</div>

<?php include '../layouts/footer.php'?>