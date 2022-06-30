<?php include '../../../common/authorization.php'; ?>
<?php 
    include '../../../common/connectSQL.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql_up = "select * from product_images join products on product_images.product_id = products.id where product_images.product_id = $id";
    $query_up = $conn->query($sql_up);
    //var_dump($query);
    $row_up = mysqli_fetch_assoc($query_up);
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
    <style>
        .blue{
            background-color: #ff6f0c;
            border-style: none;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .blue a{
            color: white;
        }
    </style>
</head>
<body>
    <?php include '../common/header.php'?>
    <main>
        <?php include '../common/left.php'?>
        <div class="right">
            <h1>Details Product Images</h1>

            <h2><a href="#">Dasboard</a>/Details Product Images</h2>
            <div><button class="blue"><a href='./AddproductImages.php?id=<?php echo $id ?>'>Thêm ảnh</a></button></div>
            <br>
            <div class="bang">
                <table class="table table-bordered" >
                <h3>Product Images: <?php echo $row_up['name'] ?></h3>
                    <thead>
                        <th width = 100px>STT</th>
                        <th>Images</th>
                        <th width = 100px>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "select * from product_images join products on product_images.product_id = products.id where product_images.product_id = $id";
                            $query = $conn->query($sql);
                            $i = 0;
                            while($row = $query->fetch_row()) {
                                $i++;
                                echo "
                                <tr>
                                <td width = 100px>".$i."</td>
                                <td><img width=90px src='../../img/".$row[1]."'></td>
                                <td width = 100px> <button><a href='./DeleteImage.php?id=".$row[0]."'onclick='return XacNhanXoa()'>Xóa</a></button></td>
                                </tr>
                            ";
                            }
                        ?>
                    </tbody>
                </table>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>