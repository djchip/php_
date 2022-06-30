<?php 
   include "./../../common/connectSQL.php";
   if(isset($_GET['id'])){
       $id = $_GET['id'];
   }
   $sql = "SELECT * FROM order_products join products on products.id = order_products.product_id where order_id = $id";
   $qr = mysqli_query($conn,$sql);

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
    <!-- fontawesome - icon -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
			integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
    <link rel="stylesheet" href="../css/base.css" />
    <link rel="stylesheet" href="./../css/tab.css">
    <link rel="stylesheet" href="../css/base.css" />
	<link rel="stylesheet" href="../css/header.css" />
	<link rel="stylesheet" href="../css/footer.css" />
</head>
<body>
    <?php include  "./common/header.php" ?>
    
    <div class="flex container">
        <div class="left"  >
            <h6 style="padding-left: 30px;">Xin Chào! Trần Ngọc Anh</h6>
            <ul>
                <li class="bole"><a href="#">Quản lý tài khoản </a>
                    <ul>
                        <li><a href="#">Thông tin Cá nhân </a></li>
                        <li><a href="#">Mã giảm giá </a></li>
                    </ul>
                </li>
                <li class="bole"><a href="#">Đơn hàng của tôi </a>
                    <ul>
                        <li><a href="#">Đơn hàng đổi trả </a></li>
                        <li><a href="#">Đơn hàng hủy </a></li>
                    </ul>
                </li>
                <li class="bole">
                <form method="POST" id="logoutForm" >
						<input type="submit" name="logout" value="Đăng xuất" style="background-color: #ff6d00;color:white;padding: 10px 15px;border-style:none;">
					</form>
                </li>
                
            </ul>
        </div>
    <main>
        <h3 style="color: orangered">Chi tiết đơn hàng</h3>
        <table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Tên sản phẩm</th> 
                                <th scope="col">Hình ảnh</th> 
								<th scope="col">Số lượng đặt mua</th>
								<th scope="col">Thành tiền</th> 
								
							</tr>
						</thead>
						<tbody>
                            <?php 
                            $i = 0;
                            while($row = mysqli_fetch_row($qr)){  
                                $i++;
                                ?>
                                <tr>
                                <td scope="col"><?php echo $i ?></td>
								<td scope="col"><?php echo $row[6] ?></td> 
                                <td scope="col"><img src="../../admin/img/<?php echo $row[10] ?>"></td> 
								<td scope="col"><?php echo $row[2] ?></td>
								<td scope="col"><?php echo $row[4] ?></td> 
                            </tr>
                           <?php } ?>
                        </tbody>
        </table>
        
    </main>
</div>
<?php include  "./common/footer.php" ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="./../../bai9_jquery/bai9_jquery/js/jquery.min.js"></script>

</html>