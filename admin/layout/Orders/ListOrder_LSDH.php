<?php
    include '../../../common/authorization.php';    
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
    <style>
        
    </style>
</head>
<body>
    <?php  include '../common/header.php'?>
    
    <main>
    <?php  include '../common/left.php'?>
        <div class="right">
            
            <h1>Danh sách đơn hàng</h1>
            <table class="table">
            <thead>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên người đặt hàng</th>
                <th>Địa chỉ</th>
                <th>SDT</th>
                <th>email</th>
                <th>Tổng giá trị đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Action</th>
            </thead>
        <?php
            $sql = "SELECT * FROM orders join users on orders.user_id = users.id WHERE status = 2";
            $result = mysqli_query($conn, $sql);

            $i = 0;
            while ($row = $result->fetch_row()) {
                $i++;
                //if($row[7] == 2){
                echo    "<tr>" .
                    "<td>" . $i . "</td>" . 
                    "<td>" . $row[0] . "</td>" . 
                    "<td>" . $row[15] . "</td>" . 
                    "<td>" . $row[2] . "</td>" .
                    "<td>" . $row[3] . "</td>" .
                    "<td>" . $row[5] . "</td>" .
                    "<td>" . $row[6] . "</td>" .
                    "<td>" . $row[8] . "</td>" .
                    
                    "<td>"
                        . "<a href='DetailOrder.php?id=" . $row[0] . "'><button>Chi tiết</button></a>"
                       
                        . 
                    "</td>"
                    .
                "</tr>";
            //}
        }
        ?>
    </table>
        </div>
        
        
    </main>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>