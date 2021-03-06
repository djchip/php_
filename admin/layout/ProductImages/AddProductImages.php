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
                <h4>T??n s???n ph???m: <?php echo $row_up['name'] ?></h4>
                <hr/>
                <form method ="POST" id="formUpload" action="" enctype ="multipart/form-data">
                    <br>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <label for="">Ch???n ???nh ????? th??m: </label><br/>
                    <input type="file" id="img_file" name="img_file[]" multiple="true" accept="image/*" onchange="previewImg(event);" class="col-6"><br/>
                    <div class="box-preview-img"></div>
                    <button type="reset" class="btn-reset">B??? ch???n t???t c???</button>
                    <br>
                    <input type="submit" class="btn-submit" name="save" value="L??u" class="end text-right" style="height:30px;line-height:30px;">
                    <div class="output"></div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    // Xem h??nh ???nh tr?????c khi upload
    function previewImg(event) {
        // G??n gi?? tr??? c??c file v??o bi???n files
        var files = document.getElementById('img_file').files;
        // Show khung ch???a ???nh xem tr?????c
        $('#formUpload .box-preview-img').show();
        // Th??m ch??? "Xem tr?????c" v??o khung
        $('#formUpload .box-preview-img').html('<p>Xem tr?????c</p>');
        // D??ng v??ng l???p for ????? th??m c??c th??? img v??o khung ch???a ???nh xem tr?????c
        for (i = 0; i < files.length; i++)
        {
            // Th??m th??? img theo i
            $('#formUpload .box-preview-img').append('<img src="" id="' + i +'" width=90px >');
            // Th??m src v??o m???i th??? img theo id = i
            $('#formUpload .box-preview-img img:eq('+i+')').attr('src', URL.createObjectURL(event.target.files[i]));
        }   
    }
    // N??t reset form upload
    $('#formUpload .btn-reset').on('click', function() {
        // L??m tr???ng khung ch???a h??nh ???nh xem tr?????c
        $('#formUpload .box-preview-img').html('');
    
        // Hide khung ch???a h??nh ???nh xem tr?????c
        $('#formUpload .box-preview-img').hide();
    
        // Hide khung hi???n th??? k???t qu???
        $('#formUpload .output').hide();
    });
// X??? l?? ???nh v?? upload
$('#formUpload .btn-submit').on('click', function() {
    // G??n gi?? tr??? c???a n??t ch???n t???p v??o var img_file
    $img_file = $('#formUpload #img_file').val();
 
    // C???t ??u??i c???a file ????? ki???m tra
    $type_img_file = $('#formUpload #img_file').val().split('.').pop().toLowerCase();
 
    // N???u kh??ng c?? ???nh n??o
    if ($img_file == '')
    {
        // Show khung k???t qu???
        $('#formUpload .output').show();
 
        // Th??ng b??o l???i
        $('#formUpload .output').html('Vui l??ng ch???n ??t nh???t m???t file ???nh.');
    }
    // Ng?????c l???i n???u file ???nh kh??ng h???p l??? v???i c??c ??u??i b??n d?????i
    else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1)
    {
        // Show khung k???t qu???
        $('#formUpload .output').show();
 
        // Th??ng b??o l???i
        $('#formUpload .output').html('File ???nh kh??ng h???p l??? v???i c??c ??u??i .png, .jpeg, .jpg, .gif.');
    }
    // Ng?????c l???i
    else
    {
        // Ti???n h??nh upload 
        $('#formUpload').ajaxSubmit({ 
            // Tr?????c khi upload
            beforeSubmit: function() {
                target:   '#formUpload .output',
 
                // ???n khung k???t qu???
                $('#formUpload .output').hide();
 
                // Show thanh ti???n tr??nh
                $("#formUpload .progress").show();
 
                // ?????t m???c ?????nh ????? d??i thanh ti???n tr??nh l?? 0
                $("#formUpload .progress-bar").width('0');
            },
 
            // Trong qu?? tr??nh upload
            uploadProgress: function(event, position, total, percentComplete){ 
                // K??o d??n ????? d??i thanh ti???n tr??nh theo % ti???n ????? upload
                $("#formUpload .progress-bar").css('width', percentComplete + '%');
 
                // Hi???n th??? con s??? % tr??n thanh ti???n tr??nh
                $("#formUpload .progress-bar").html(percentComplete + '%');
            },
            // Sau khi upload xong
            success: function() {    
                // Show khung k???t qu??? 
                $('#formUpload .output').show();
 
                // Th??m class success v??o khung k???t qu???
                $('#formUpload .output').addClass('success');
 
                // Th??ng b??o th??nh c??ng
                $('#formUpload .output').html('Upload ???nh th??nh c??ng.');
            },
            // N???u x???y ra l???i
            error : function() {
                // Show khung k???t qu???
                $('#formUpload .output').show();
 
                // Th??ng b??o l???i
                $('#formUpload .output').html('Kh??ng th??? upload ???nh v??o l??c n??y, h??y th??? l???i sau.');
            }
        }); 
        return false; 
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>

