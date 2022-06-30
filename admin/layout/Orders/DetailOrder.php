<?php
    include '../../../common/authorization.php';
    include '../../../common/connectSQL.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = "select * from orders where id=$id";
    $result = mysqli_query($conn, $sql);
    $order_info = mysqli_fetch_assoc($result);
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
        <div class="right">
            <h1>Danh sách đơn hàng</h1>
            <div class="order-info">
                <p class="address">Địa chỉ: <span> <?php echo $order_info["address"] ?> </span></p>

                <p class="phone">Số điện thoại: <span> <?php echo $order_info["phone"] ?> </span></p>

                <p class="fee">Phí ship: <span> <?php echo $order_info["shipping_fee"] ?> </span></p>

                <p class="email">Email: <span> <?php echo $order_info["email"] ?> </span></p>

                <p class="created_date">Ngày tạo: <span> <?php echo $order_info["created_date"] ?> </span></p>

                <?php 
                    if (!empty($order_info["shipped_date"])) {
                        echo "<p class='shipped_date'>Đơn hàng đã giao vào: <span>" .  $order_info["created_date"]  . "</span></p>";
                    } else {
                        echo "<p class='shipped_date'>Đơn hàng đang trong quá trình giao </p>";
                    }  
                ?>

                
                
            </div>
            <table class="table">
            <thead>
                <th>name</th>
                <th>quantity</th>
                <th>price</th>
                <th>total price</th>
            </thead>
        <?php

        if (isset($_GET["id"])) {
        $orderId = $_GET["id"];

        $sql = "SELECT p.name, p.price, o.quantity, o.id FROM order_products o JOIN products p on o.product_id=p.id	WHERE order_id=$orderId";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            echo    "<tr>" .
                "<td>" . $row["name"] . "</td>" . 
                "<td>" . $row["quantity"] . "</td>" .
                "<td>" . $row["price"] . "</td>" .
                "<td>" . $row["price"]*$row["quantity"] . "</td>" .
            "</tr>";
        }
    }
        ?>
    </table>
        </div>
        
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>