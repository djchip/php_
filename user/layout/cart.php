<?php 
	ob_start();

	session_start();
	if(!isset($_SESSION['giohang'])){
		$SESSION['giohang'] = [];
	}
	// làm rỗng giỏ hàng
	if(isset($_GET['delcart'] ) && $_GET['delcart'] == 1){
		unset($_SESSION['giohang']);
		header("Location:./cart.php");
	}
	// Xóa sản phẩm trong giỏ hàng
	if(isset($_GET['delid'] ) && ($_GET['delid'] >= 0)){
		array_splice($_SESSION['giohang'], $_GET['delid'],1);
		header("Location:./cart.php");
	}
	//Them san pham vao gio hang 
	if(isset($_GET['plus'] ) && ($_GET['plus'] >= 0)){
		//array_splice($_SESSION['giohang'], $_GET['delid'],1);
		$_SESSION['giohang'][$_GET['plus']][3]++;
		header("Location:./cart.php");
	}
	
	// bot
	if(isset($_GET['minus'] ) && ($_GET['minus'] >= 0)){
		//array_splice($_SESSION['giohang'], $_GET['delid'],1);
		$_SESSION['giohang'][$_GET['minus']][3]--;
		header("Location:./cart.php");
	
	if($_SESSION['giohang'][$_GET['minus']][3] == 0){
		array_splice($_SESSION['giohang'], $_GET['minus'],1);
		header("Location:./cart.php");
	}
}
	if(isset($_POST['save']) && $_POST['save']){
		$tensp = $_POST['name'];
		$gia =  $_POST['price'];
		$hinh = $_POST['image'];
		$sl = $_POST['quantity'];
		$id_pro = $_POST['id'];
		//var_dump($id_pro);
		$flag = 0; // ktra san pham co trung hay khong?
		// ktra san pham co trong gio hang hahy Khong
		for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
			if($_SESSION['giohang'][$i][0] == $tensp){
				$flag = 1;
				$soluongnew = $sl + $_SESSION['giohang'][$i][3];
				$_SESSION['giohang'][$i][3] = $soluongnew;
				break;
			}
		}
		if($flag ==0){ // neu khong trung thi them moi

		//them san pham moi
		$sp =[$tensp, $gia, $hinh,$sl,$id_pro];
		$_SESSION['giohang'][] = $sp;
		}
		//var_dump($_SESSION['giohang']);
	} 
	
	function showGioHang(){
		if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))){
			
			$tong = 0;
			for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i ++){
				//var_dump($_SESSION['giohang'][$i][4]);
				$tt = $_SESSION['giohang'][$i][1] * $_SESSION['giohang'][$i][3];
				$tong += $tt;
				echo '
			<tr>
				<td>'.($i+ 1).'</td>
				<td>'.$_SESSION['giohang'][$i][0].'</td>
				<td><img src="../../admin/img/'.$_SESSION['giohang'][$i][2] .'"></td>
				<td style="width:100px" class="sl"><a href="cart.php?minus='.$i.'"><button>-</button></a><input style="width:30px" type="text" value="'.$_SESSION['giohang'][$i][3].'" readonly><a href="cart.php?plus='.$i.'"><button id="disable">+</button></a>
				';
				include './../../common/connectSQL.php';
				$sql_q = "SELECT * FROM products where id =". $_SESSION['giohang'][$i][4];
				$qr_q = mysqli_query($conn,$sql_q);
	
				$row_q = mysqli_fetch_array($qr_q);
				if($_SESSION['giohang'][$i][3] >= $row_q['quantity']){
					echo '<p style="color:red">Hàng đã hết</p>
					<script>
					document.getElementById("disable").disabled = true;
					</script>';
				}
				 echo '
				</td>
				<td><strong>'.currency_format($_SESSION['giohang'][$i][1]).'</strong></td>
				<td>'.currency_format($tt).'</td>
				<td>
					<a href="./cart.php?delid='.$i.'">Xóa</a>
				</td>
			</tr>';
			
			}
			echo '<div class="cart-total">
			<p>Tổng giá trị: <strong class="price">'. currency_format($tong).'</strong> </p>
			<p>Tổng giá trị: <strong class="price">'.' 20.000đ' .'</strong> </p>
			<p>Tổng thanh toán: <strong class="price text-red">'.currency_format($tong +20000).'</strong></p>
			
			</div>
			<a href="cart.php?delcart=1"><button type="button">Xóa giỏ Hàng</button></a>';
			
		}
	}
	if (!function_exists('currency_format')) {
		function currency_format($number, $suffix = 'đ') {
			if (!empty($number)) {
				return number_format($number, 0, ',', '.') . "{$suffix}";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Trang chủ</title>
		<!-- fontawesome - icon -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
			integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
		<!-- bootstrap -->
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
			crossorigin="anonymous"
		/>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
			crossorigin="anonymous"
		></script>

		<!-- style chung -->
		
		<link rel="stylesheet" href="../css/base.css" />
		<link rel="stylesheet" href="../css/header.css" />
		<link rel="stylesheet" href="../css/footer.css" />
		<link rel="stylesheet" href="../css/cart.css" />
		<style>
		.sl input{
			width: 20px;
		}
		</style>
	</head>
	<body>
		<!-- Header -->
		<?php include 'common/header.php'?>
		<?php 
			$sql = "SELECT * FROM orders join order_products on orders.id = order_products.order_id";
		?>
		<!-- Gio hang -->
		<div class="cart container">
			<div class="cart-info">
				<div class="item">
					<?php if(sizeof($_SESSION['giohang']) >0){ ?>
					<table class="table table-striped table-bordered">
						
						<tr>
							<th>STT</th>
							<th>Tên sản phẩm</th>
							<th>Hình ảnh</th>
							<th style="width:100px">Số lượng</th>
							<th>Đơn giá</th>
							<th>Thành tiền</th>
							<th>Action</th>
						</tr>
						<?php showGioHang() ?>
					</table>
					<?php }else{
						echo '<h2 style="text-align; color: red;">Giỏ hàng rỗng ! Vui lòng đặt hàng</h2>';
					} ?>
					
					
					
				</div>
	
			</div>
			
			<?php 
				if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))){
			
					$tong = 0;
					for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i ++){
						//var_dump($_SESSION['giohang'][$i][4]);
						$tt = $_SESSION['giohang'][$i][1] * $_SESSION['giohang'][$i][3];
						$tong += $tt;
					}
				}
				if(isset($_POST['upload'])){
				$name = $_SESSION['ID'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];
				$date = gmdate("Y-m-d H:i:s", time()+7*60*60);
				// chen vao bang don hang
				//var_dump($tong);
				$sql_insert = "INSERT INTO `orders`(`user_id`, `address`, `phone`, `email`,`total_price`, `created_date`) VALUES ($name,'$address','$phone','$email',$tong,'$date')";
				$qr_insert = mysqli_query($conn,$sql_insert);
				//var_dump($qr_insert);
				$row_up = mysqli_fetch_array($qr_insert);
				// lays id don hang
				$sql_idm = "SELECT * FROM orders WHERE created_date = '$date'" ;
				$qr_idm = mysqli_query($conn,$sql_idm);
				//var_dump($conn);
				$row_idm = mysqli_fetch_array($qr_idm);
				//var_dump($row_idm);
				// chen vao bang order_product
				$sql_inserto = "INSERT INTO `order_products`( `order_id`, `quantity`, `product_id`, `total_price`) VALUES ";
				for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
					$order_id = $row_idm['id'];
					$quantity = $_SESSION['giohang'][$i][3];
					$product_id = $_SESSION['giohang'][$i][4];
					
					$total_price = $_SESSION['giohang'][$i][1] * $_SESSION['giohang'][$i][3];
					$sql_inserto .= "($order_id, $quantity, $product_id, $total_price) ,";
				}
				$sql_inserto = substr_replace($sql_inserto ,"", -1);
				//var_dump($sql_inserto);
				$qr_inserto = mysqli_query($conn,$sql_inserto);
				//var_dump($qr_inserto);
				echo '
				<script>
				alert("Đặt hàng Thành công!");
				</script>
				';
				unset($_SESSION['giohang']);
				
				//header("Location:./../../index.php");
				

				
			}
			
			?>
			
			<div class="cart-form">
				<form method="post">
					<h3>Thông tin đặt hàng</h3>
					<p class="text-gray"><i>Bạn cần nhập đầy đủ các trường thông tin có dấu *</i></p>
					<div class="row">
						<div class="col">
							<div class="control">
								<input name="name" type="text" placeholder="Họ và tên *" value="<?php echo $_SESSION['full_name']?>" readonly="true">
							</div>
						</div>
					</div>
	
					<div class="row">
						<div class="col">
							<div class="control">
								<input name="phone" type="text" placeholder="Số điện thoại *" value="<?php echo $_SESSION['phone']?>">
							</div>
						</div>
					</div>
	
	
					<div class="row shInfo">
						<div class="col">
							<div class="control">
								<input name="address" type="text" placeholder="Địa chỉ nhận hàng *" value="<?php echo $_SESSION['address']?>">
							</div>
						</div>
					</div>
	
					<div class="row shInfo">
						<div class="col">
							<div class="control">
								<input name="email" type="email" placeholder="Email" value="<?php echo $_SESSION['email']?>">
							</div>
						</div>
					</div>
	
						<div class="row shInfo">
	
							<div class="control-button">
										<button type="submit" name="upload">XÁC NHẬN VÀ ĐẶT HÀNG</button>
							</div>
						</div>
				</form>
	
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'common/footer.php'?>
	</body>
	<script>
		function alert(){
			// setTimeout(() => alert('Hello'), 3000);
			alert('Please wait');
		}
	</script>
</html>
