<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';

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
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
        <?php  include '../common/left.php'?>
        <div class="right ">
            <br>
        <h2>Thống kê hoạt động Website</h2>
        <br>
                <div class="top row">
                
                <div class="product col">
                    <h3>PRODUCT</h3>
                    <p>Tổng số sản phẩm tồn kho : </p>
                </div>
                <div class="order col">
                    <h3>ORDER</h3>
                    <h6>Số hàng đã bán trong ngày : </h6>
                    <h6>Số hàng đã bán trong tháng : </h6>
                    <h6>Số hàng đã bán trong năm : </h6>
                </div>
                <div class="importation col">
                <h3>IMPORTATION</h3>
                    <h6>Số hàng nhập trong ngày : </h6>
                    <h6>Số hàng nhập trong tháng : </h6>
                    <h6>Số hàng nhập trong năm : </h6>
                </div>
                </div>
                <div class="bottom row">
                    <div class="user col">
                    <h3>USER</h3>
                    <h6>Số lượng khách hàng trong ngày : </h6>
                    <h6>Số lượng khách hàng trong tháng : </h6>
                    <h6>Số lượng khách hàng trong năm : </h6>
                    </div>
                    <div class="comment col">
                    <h3>COMMENT</h3>
                    <h6>Số lượng tương tác trong ngày : </h6>
                    <h6>Số lượng tương tác trong tháng : </h6>
                    <h6>Số lượng ktương tác trong năm : </h6>
                    </div>
                </div>
            
        
        </div>
    </main>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>