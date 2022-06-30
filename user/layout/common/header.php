<?php 
	session_start(); 
	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location:../../index.php");
	}
	include '../../common/connectSQL.php';
?>

<header class="header">
	<div class="top">
		<div class="container">
			<ul>
				<li><a href="">Liên hệ</a></li>
				<li><a href="">Giới thiệu</a></li>
				<li class="<?php echo !isset($_SESSION["ID"]) ? 'on' : 'off' ?>"><a href="register.php">Đăng ký</a></li>
				<li class="<?php echo !isset($_SESSION["ID"]) ? 'on' : 'off' ?>"><a href="../../common/login.php">Đăng nhập</a></li>

				<li class="<?php echo isset($_SESSION["ID"]) ? 'on' : 'off' ?>" >
				<a href="/user/layout/account.php" style="color: white;margin-top: 7px;">Tài Khoản <i class="fa-solid fa-user"></i></a>
				</li>
			
			</ul>
		</div>
	</div>
	<div class="middle">
		<div class="container">
			<a href="../../index.php" class="logo"><img src="" alt="" /><i class="fa-solid fa-square-caret-right"></i>ACC smart phone</a>
			<form class="search" method="GET" action="../layout/product-list.php">
				<input type="text" name="keyword" placeholder="Hôm nay bạn cần tìm gì?" />
				<button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>
			<?php 
				$tongsl = 0;
				for($i = 0; $i < sizeof($_SESSION['giohang']);$i++){
					$tongsl += $_SESSION['giohang'][$i][3];
				}
				//var_dump($_SESSION['giohang'][$i][3]);
			?>
			<div class="header-cart">
			<?php 
				if(isset($_SESSION['ID']))
				{ 
					echo '<a href="./cart.php" ><i class="fa-solid fa-cart-shopping"></i>
					<span class="amount badge badge-primary"> '. $tongsl.'</span>
				</a>';
				}else{
					echo '<a href="./cart_empty.php" ><i class="fa-solid fa-cart-shopping"></i>
					<span class="amount badge badge-primary">0</span></a>';
				}
				
			?>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="container">
			<ul>
				<?php
					$sql = "SELECT * FROM categories where active = 1  ORDER BY id DESC";

					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<li><a href='product-list.php?category=" . $row["slug"] . "'>" . $row["name"] . "</a></li>";
					}
				?>
			</ul>
		</div>
	</div>
</header>
