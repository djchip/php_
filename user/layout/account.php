<?php 
    session_start();
    include "./../../common/connectSQL.php";
    //var_dump($_SESSION['ID']);
    $sql= "SELECT * FROM orders join users on orders.user_id = users.id WHERE orders.user_id = ".$_SESSION['ID'] ;
    $qr = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_array($qr);
    //var_dump($qr);
    session_start(); 
	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location:../../index.php");
	}
    if(isset($_GET['status']) && $_GET['status'] == 1){
        $sql_u = "UPDATE `orders` SET `status`= 2 WHERE id =". $_GET['id'];
        $qr_u = mysqli_query($conn, $sql_u);
        

        // update số lương sản phẩm
        $sql_p = "SELECT * FROM order_products join products on products.id = order_products.product_id where order_id =". $_GET['id'];
        $qr_p = mysqli_query($conn,$sql_p);
        var_dump($qr_p);
        var_dump($_GET['id']);
        //var_dump($qr_p);
        // $row_p = mysqli_fetch_array($qr_p);
        // $products = $_POST['product'];
        // $products = array_values($products);
        while($row_p = mysqli_fetch_row($qr_p)){
            //var_dump($row_p[3]);
            $sql_update = "UPDATE `products` join order_products on products.id = order_products.product_id 
            join orders on orders.id = order_products.order_id 
            SET products.quantity = products.quantity - order_products.quantity, 
                products.quantity_sold = products.quantity_sold+order_products.quantity
            WHERE orders.id = ".$_GET['id'] ." AND products.id = $row_p[3]";
            $qr_update = mysqli_query($conn, $sql_update);
            //var_dump($sql_update);
            //var_dump($qr_update);
            header("Location:./account.php");
        }
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
            <h6 style="padding-left: 30px;">Xin Chào! <?php echo $rows['full_name'] ?></h6>
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
        <h3 style="color: orangered">Đơn hàng của tôi</h3>
        <div class="tabs">
            <div class="tab-item active">
                Chờ xác nhận
            </div>
            <div class="tab-item">
                Chờ giao hàng
            </div>
            <!-- <div class="tab-item">
                Chờ thanh toán
            </div> -->
            <div class="tab-item">
                Lịch sử đơn hàng
            </div>
            <div class="line"></div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active">
            
            <table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Code</th> 
								<th scope="col">Created Date</th>
								<th scope="col">FullName</th>
								<th scope="col">Number Phone</th>
								<th scope="col">Email</th>
								<th scope="col">Address</th>
								 <th scope="col">Tổng giá trị đơn hàng</th> 
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
                            
							<?php
                            
                            $i = 0;
                             while($row = mysqli_fetch_row($qr)){ 
                             $i++ ;
                             if( $row[7] == 0 ){ ?>
                             <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row[0] ?></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[13] ?></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo  $row[5] ?></td>
                                <td><?php echo $row[2] ?></td>
                                <td><?php echo  $row[6] ?></td>
                                
                                <td><a href="./order-detail.php?id=<?php echo $row[0] ?>" ><button class="blue"><i class="fas fa-edit"></i> Detail</button></a>
                                    <a href='./delOrder.php?id=<?php echo $row[0] ?> '><button onclick='return XacNhanXoa()' class="red">Hủy</button></a></td>
                             </tr>
                           <?php }} 
                           mysqli_data_seek($qr, 0);?>

						</tbody>
					</table>
            </div>
            <div class="tab-pane">
            <table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Code</th> 
								<th scope="col">Created Date</th>
								<th scope="col">FullName</th>
								<th scope="col">Number Phone</th>
								<th scope="col">Email</th>
								<th scope="col">Address</th>
								 <th scope="col">Tổng giá trị đơn hàng</th> 
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
                            
							<?php
                            
                            $i = 0;
                             while($row = mysqli_fetch_row($qr)){ 
                             $i++ ;
                             if( $row[7] == 1 ){ ?>
                             <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row[0] ?></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[13] ?></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo  $row[5] ?></td>
                                <td><?php echo $row[2] ?></td>
                                <td><?php echo  $row[6] ?></td>
                                
                                <td>
                                    <a href="./order-detail.php?id=<?php echo $row[0] ?>" class="blue"><i class="fas fa-edit"></i> Detail</a>
                                    <a href="./account.php?status=1&id=<?php echo $row[0] ?>"><button class="green">Đã xác nhận</button></a>
                                </td>
                             </tr>
                           <?php }}
                           mysqli_data_seek($qr, 0); ?>

						</tbody>
					</table>
            </div>
            <div class="tab-pane">
            <table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Code</th> 
								<th scope="col">Created Date</th>
								<th scope="col">FullName</th>
								<th scope="col">Number Phone</th>
								<th scope="col">Email</th>
								<th scope="col">Address</th>
								 <th scope="col">Tổng giá trị đơn hàng</th> 
								<th scope="col" >Action</th>
							</tr>
						</thead>
						<tbody>
                            
							<?php
                            
                            $i = 0;
                             while($row = mysqli_fetch_row($qr)){ 
                             $i++ ;
                             if( $row[7] == 2 ){ ?>
                             <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row[0] ?></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[13] ?></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo  $row[5] ?></td>
                                <td><?php echo $row[2] ?></td>
                                <td><?php echo  $row[6] ?></td>
                                
                                <td>
                                    <a href="./order-detail.php?id=<?php echo $row[0] ?>" ><button class="blue"><i class="fas fa-edit"></i> Detail</button></a>
                                </td>
                             </tr>
                           <?php }} 
                           mysqli_data_seek($qr, 0);?>

						</tbody>
					</table>
            </div>
            <!-- <div class="tab-pane">
                <h2>Vue.js</h2>
        <p>Vue (pronounced /vjuː/, like view) is a progressive framework for building user interfaces.
            Unlike other monolithic frameworks, 
            Vue is designed from the ground up to be incrementally adoptable. </p>
            </div> -->
        </div>
    </main>
</div>
<?php include  "./common/footer.php" ?>
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
<script src="./../../bai9_jquery/bai9_jquery/js/jquery.min.js"></script>
<script>
    var $ = document.querySelector.bind(document);
    var $$ = document.querySelectorAll.bind(document);
    const tabs = $$('.tab-item');
    const panes = $$('.tab-pane');

    const tabActive = $('.tab-item.active');
    const line = $('.tabs .line');

    line.style.left = tabActive.offsetLeft + "px";
    line.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab,index) => {
        const pane = panes[index];

        tab.onclick = function() {
            $('.tab-item.active').classList.remove('active');
            $('.tab-pane.active').classList.remove('active');

            line.style.left = this.offsetLeft + "px";
            line.style.width = this.offsetWidth + "px";


            this.classList.add('active');
            pane.classList.add('active');
        }
    })

</script>
</html>