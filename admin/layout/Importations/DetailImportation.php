<?php include '../../../common/authorization.php'; ?>
<?php 
    include '../../../common/connectSQL.php';
?>
<?php  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql  = "SELECT * from importations join importation_products on importations.id = importation_products.importation_id 
    join users on users.id = importations.user_id
    join products on products.id = importation_products.product_id 
    join vendors on vendors.id = importations.vendor_id where importations.id = $id" ;
    $qr = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($qr);
    //var_dump($qr);
    // var_dump($row);
    $sql_sp  = "SELECT * from importations  
    join importation_products on importations.id = importation_products.importation_id 
    join products on products.id = importation_products.product_id
    where importations.id = $id" ;
    $qr_sp = mysqli_query($conn,$sql_sp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/dashboard.css">
    <link rel="stylesheet" href="./../../css/Addfood.css">
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
        <?php  include '../common/left.php '?>
        <div class="right">
            <h1>Detail importation</h1>
            <h2><a href="#">Dasboard</a>/Detail Imprtation</h2>
            <div class="detail">
                <h1>Phiếu Nhập Kho Công Ty ACC</h1>
                <p>Ngày nhập: <?php  echo $rows['import_date']?></p>
                <p>Số :  <?php  echo $id ?> </p>
                <p>Đơn vị giao hàng : <?php  echo $rows['name'] ?> </p>
                <p>Người giao hàng : <?php  echo $rows['employee_name'] ?> </p>
                <table class="" border="1" cellpadding="20px" >
                    <thead>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Đơn vị tính</th>
                    <th>Thành tiền</th>
                    </thead>
                    <tbody >
                        
                        <?php 
                        $i = 0;
                        $tong = 0; 
                        while ($row = $qr_sp ->fetch_row()) { 
                            $i++;
                            echo "
                            <tr>
                            <td>".$i."</td>
                            <td>".$row[10]."</td>
                            <td>".$row[8]."</td>
                            <td>".$row[7]."</td>
                            <td>VND</td>
                            <td>".$row[8] * $row[7]."</td>
                            </tr>";
                            $tong += $row[8] * $row[7];
                        }
                         ?>
                         
                    </tbody>
                </table>
                <p><b style="margin-right:560px">Tổng:</b> <?php echo $tong ?></p>
                <p>Người nhận hàng : <?php echo $rows['last_name'] ."  " . $rows['first_name'] ?></p>
            </div>
        </div>
    </main>
    <footer>
        <span>Copyright @ Your website 2021</span>
        <span>Privacy policy . Term conditions</span>
    </footer>
</body>
<script>
    function XacNhanXoa(){
       return confirm("Bạn có chắc chắc muốn xóa danh mục nay hay không ?");
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>