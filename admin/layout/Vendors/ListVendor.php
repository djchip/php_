<?php 
    session_start();
    var_dump($_SESSION['ID']);
    if(isset($_SESSION['ID'])){
        include "./../connectSQL.php";
    }else{
        include "../../../common/authorization.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/Dasboard.css">
    <link rel="stylesheet" href="./../../css/orderpages.css">
</head>
<body>
    <?php include "./../common/header.php"?>
    <main>
        <?php include "./../common/left.php"?>
        <div class="right">
            <h1>Order Pages</h1>
            <h2><a href="#">Dasboard</a>/List Imprtation</h2>
            <div class="bang">
                <p><i class="fas fa-clipboard-list"></i>All Listings</p>
                <table border="1"  cellspacing="0.4px" >
                    <thead>
                    <tr>
                        <th width=200px>STT</th>
                        <th width=200px>Tên nhà cung cấp</th>
                        <th width=200px>Địa chỉ</th>
                        <th width=200px>Nhân viên giao hàng</th>
                        <th width=200px> Action </th>
        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $sql = "select * from vendors";
                    $query = mysqli_query($conn, $sql);
                    //var_dump($query);
                   $i = 0;
                   
                    while($row = $query->fetch_row()) {
                        //var_dump($row);
                        $i++;
                        echo "
                        <tr>
                            <td width=200px>".$i."</td>
                            <td width=200px>".$row[1]."</td>
                            <td width=200px>".$row[2]."</td>
                            <td width=200px>".$row[3]."</td>
                            <td width=200px><button class='blue'><a href='./EditVendors.php?id=".$row['0'] ."'>Sửa</a></button><button class='red'><a href='./DeleteVendors.php?id=".$row[0] ."'onclick='return XacNhanXoa()'>Xóa</a></button></td>
                            
                        </tr>";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="./../../../bai9_jquery/bai9_jquery/js/jquery.min.js"></script>
<script src="./../../script/Dasboard.js"></script>
</html>