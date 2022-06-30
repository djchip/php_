<?php include '../../../common/authorization.php'; ?>
<?php
        include '../../../common/connectSQL.php';
        $productId = $_GET['id'];
        foreach($_FILES['img_file']['name'] as $name => $value){
            $name_img = stripslashes($_FILES['img_file']['name'][$name]);
            $source_img = $_FILES['img_file']['tmp_name'][$name];
            $path_img = "../../img/" . $name_img;
            if(isset($_POST['save'])){
                $sql = "INSERT INTO product_images (image_url, product_id) VALUES ('$name_img',$productId)";
                move_uploaded_file($source_img, $path_img);
                $qr = mysqli_query($conn, $sql);
                }
        }
        $sql_productName = "select * from products where id = $productId";
        $query_productName = mysqli_query($conn, $sql_productName);
        $row_up = mysqli_fetch_assoc($query_productName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/dashboard.css">
    <link rel="stylesheet" href="./../../css/Addfood.css">
    <style>
        .progress{
            padding: 2px; border: 1px solid #e5e5e5; border-radius: 4px; margin-bottom: 10px; display: none;
        }
        .progress-bar{
            background-color: #428bca; color: #fff; text-align: center; border-radius: 4px; padding: 2px 0; width: 0;
        }
        input[type=file] {display: block; font-size: 14px;}
        button.btn-reset {background-color: #fff; border: 2px solid #ccc; color: #444;}
        .output {display: none; background-color: #d9534f; color: #fff; padding: 7px; border-radius: 4px; margin-top: 10px;}
        .success {background-color: #5cb85c;}
        .box-preview-img {margin-top: 10px; display: none;}
        .box-preview-img p {font-weight: bold;}
        .box-preview-img img {width: 90px; height: 90px; border: 1px solid #e5e5e5; margin-right: 5px; margin-top: 5px;}
    </style>
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
    <?php  include '../common/left.php'?>
        <div class="right">
            <h1>Add Product Images</h1>
            <h2><a href="#">Dasboard</a>/Add Product Images</h2>
            <div class="content_basic">
                <h4>Tên sản phẩm: <?php echo $row_up['name'] ?></h4>
                <hr/>
                <form method ="POST" id="formUpload" action="" enctype ="multipart/form-data">
                    <br>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <label for="">Chọn ảnh để thêm: </label><br/>
                    <input type="file" id="img_file" name="img_file[]" multiple="true" accept="image/*" onchange="previewImg(event);" class="col-6"><br/>
                    <div class="box-preview-img"></div>
                    <button type="reset" class="btn-reset">Bỏ chọn tất cả</button>
                    <br>
                    <input type="submit" class="btn-submit" name="save" value="Lưu" class="end text-right" style="height:30px;line-height:30px;">
                    <div class="output"></div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    // Xem hình ảnh trước khi upload
    function previewImg(event) {
        // Gán giá trị các file vào biến files
        var files = document.getElementById('img_file').files;
        // Show khung chứa ảnh xem trước
        $('#formUpload .box-preview-img').show();
        // Thêm chữ "Xem trước" vào khung
        $('#formUpload .box-preview-img').html('<p>Xem trước</p>');
        // Dùng vòng lặp for để thêm các thẻ img vào khung chứa ảnh xem trước
        for (i = 0; i < files.length; i++)
        {
            // Thêm thẻ img theo i
            $('#formUpload .box-preview-img').append('<img src="" id="' + i +'" width=90px >');
            // Thêm src vào mỗi thẻ img theo id = i
            $('#formUpload .box-preview-img img:eq('+i+')').attr('src', URL.createObjectURL(event.target.files[i]));
        }   
    }
    // Nút reset form upload
    $('#formUpload .btn-reset').on('click', function() {
        // Làm trống khung chứa hình ảnh xem trước
        $('#formUpload .box-preview-img').html('');
    
        // Hide khung chứa hình ảnh xem trước
        $('#formUpload .box-preview-img').hide();
    
        // Hide khung hiển thị kết quả
        $('#formUpload .output').hide();
    });
// Xử lý ảnh và upload
$('#formUpload .btn-submit').on('click', function() {
    // Gán giá trị của nút chọn tệp vào var img_file
    $img_file = $('#formUpload #img_file').val();
 
    // Cắt đuôi của file để kiểm tra
    $type_img_file = $('#formUpload #img_file').val().split('.').pop().toLowerCase();
 
    // Nếu không có ảnh nào
    if ($img_file == '')
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('Vui lòng chọn ít nhất một file ảnh.');
    }
    // Ngược lại nếu file ảnh không hợp lệ với các đuôi bên dưới
    else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1)
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.');
    }
    // Ngược lại
    else
    {
        // Tiến hành upload 
        $('#formUpload').ajaxSubmit({ 
            // Trước khi upload
            beforeSubmit: function() {
                target:   '#formUpload .output',
 
                // Ẩn khung kết quả
                $('#formUpload .output').hide();
 
                // Show thanh tiến trình
                $("#formUpload .progress").show();
 
                // Đặt mặc định độ dài thanh tiến trình là 0
                $("#formUpload .progress-bar").width('0');
            },
 
            // Trong quá trình upload
            uploadProgress: function(event, position, total, percentComplete){ 
                // Kéo dãn độ dài thanh tiến trình theo % tiến độ upload
                $("#formUpload .progress-bar").css('width', percentComplete + '%');
 
                // Hiển thị con số % trên thanh tiến trình
                $("#formUpload .progress-bar").html(percentComplete + '%');
            },
            // Sau khi upload xong
            success: function() {    
                // Show khung kết quả 
                $('#formUpload .output').show();
 
                // Thêm class success vào khung kết quả
                $('#formUpload .output').addClass('success');
 
                // Thông báo thành công
                $('#formUpload .output').html('Upload ảnh thành công.');
            },
            // Nếu xảy ra lỗi
            error : function() {
                // Show khung kết quả
                $('#formUpload .output').show();
 
                // Thông báo lỗi
                $('#formUpload .output').html('Không thể upload ảnh vào lúc này, hãy thử lại sau.');
            }
        }); 
        return false; 
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>

