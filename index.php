<?php 
	session_start();
	include 'common/connectSQL.php';

	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location:./");
	}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
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

		<link rel="stylesheet" href="user/css/base.css" />
		<link rel="stylesheet" href="user/css/header.css" />
		<link rel="stylesheet" href="user/css/footer.css" />
		<link rel="stylesheet" href="user/css/index.css" />
	</head>
	<body>
		
		<!-- header -->
		<header class="header">
			<div class="top">
				<div class="container">
					<ul>
						<li><a href="">Liên hệ</a></li>
						<li><a href="">Giới thiệu</a></li>
						<li class="<?php echo !isset($_SESSION["ID"]) ? 'on' : 'off' ?>"><a href="user/layout/register.php">Đăng ký</a></li>
						<li class="<?php echo !isset($_SESSION["ID"]) ? 'on' : 'off' ?>"><a href="common/login.php">Đăng nhập</a></li>

						<li class="<?php echo isset($_SESSION["ID"]) ? 'on' : 'off' ?>">
							<a href="/acc-app/user/layout/account.php" style="color: white;margin-top: 7px;">Tài Khoản <i class="fa-solid fa-user"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="middle">
				<div class="container">
					<a href="" class="logo"><img src="" alt="" /><i class="fa-solid fa-square-caret-right"></i>ACC smart phone</a>
					<form class="search" method="GET" action="user/layout/product-list.php">
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
                                echo '<a href="/acc-app/user/layout/cart.php" ><i class="fa-solid fa-cart-shopping"></i>
								<span class="amount badge badge-primary"> '. $tongsl.'</span>
							</a>';
                            }else{
                                echo '<a href="/acc-app/user/layout/cart_empty.php" ><i class="fa-solid fa-cart-shopping"></i>
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
						$sql = "SELECT * FROM categories where active = 1 ORDER BY id desc";

						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
								echo "<li><a href='user/layout/product-list.php?category=" . $row["slug"] . "'>" . $row["name"] . "</a></li>";
							}
						?>
					</ul>
				</div>
			</div>
		</header>


		<main class="main-content container">
			<!-- Slider -->
			<section class="main-slider-container pt-3">
				<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
					<div class="carousel-indicators">
						<button
							type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
							aria-current="true"
							aria-label="Slide 1"
						></button>
						<button
							type="button"
							data-bs-target="#carouselExampleDark"
							data-bs-slide-to="1"
							aria-label="Slide 2"
						></button>
						<button
							type="button"
							data-bs-target="#carouselExampleDark"
							data-bs-slide-to="2"
							aria-label="Slide 3"
						></button>
						<button
							type="button"
							data-bs-target="#carouselExampleDark"
							data-bs-slide-to="3"
							aria-label="Slide 4"
						></button>
					</div>
					<div class="carousel-inner">
						<div class="carousel-item active" data-bs-interval="10000">
							<img
								src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/03/22/1200x382.png"
								class="d-block w-100"
								alt="..."
							/>
						</div>
						<div class="carousel-item" data-bs-interval="2000">
							<img
								src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/04/02/web111.png"
								class="d-block w-100"
								alt="..."
							/>
						</div>
						<div class="carousel-item" data-bs-interval="2000">
							<img
								src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/04/04/thucu-s22-web_637846863057152913.png"
								class="d-block w-100"
								alt="..."
							/>
						</div>
						<div class="carousel-item">
							<img
								src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/03/30/iphone-11-banner-01.jpg"
								class="d-block w-100"
								alt="..."
							/>
						</div>
					</div>
					<button
						class="carousel-control-prev"
						type="button"
						data-bs-target="#carouselExampleDark"
						data-bs-slide="prev"
					>
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button
						class="carousel-control-next"
						type="button"
						data-bs-target="#carouselExampleDark"
						data-bs-slide="next"
					>
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</section>

			<!-- decorate images -->
			<section class="decorate-image-container pt-4">
				<div class="item">
					<a href="#" target="_blank">
						<img
							src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/02/18/chuyen-trang-samsung2.png"
							title="Chuyên Trang Samsung"
							alt="Chuyên Trang Samsung"
						/>
					</a>
				</div>
				<div class="item">
					<a href="#" target="_blank">
						<img
							src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/03/28/zxc.jpg"
							title="OPPO Reno7"
							alt="OPPO Reno7"
						/>
					</a>
				</div>
				<div class="item">
					<a href="#" target="_blank">
						<img
							src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/04/04/111111.png"
							title="GALAXY A 2022"
							alt="GALAXY A 2022"
						/>
					</a>
				</div>
				<div class="item">
					<a href="#" target="_blank">
						<img
							src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/03/15/1200x628-01-1.jpg"
							title="Sản phẩm mới Apple"
							alt="Sản phẩm mới Apple"
						/>
					</a>
				</div>
			</section>

			<!-- big ads -->
			<section class="big-image my-4">
				<a href="#"
					><img
						src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/04/01/galaxy-s22-series-banner-web-05.jpg"
						style="width: 100%"
				/></a>
			</section>

			<!-- main product display (APPLE) -->
			<section class="main-product-container mt-4">
				<div class="sub-header mb-3">Apple</div>
				<div class="products row">
					<?php
						$sql = "SELECT p.name, p.price, p.thumb, p.short_desc, p.slug FROM products p join categories c on p.category_id=c.id WHERE c.name='apple' LIMIT 10";

						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							echo "
							<div class='item col col-sm-3'>
								<div class='parent-wrapper'>
								<a href='user/layout/product-detail.php?slug=" . $row['slug'] . "' class='wrapper'>
									<div class='img-wrapper'>
										<img
											src='./admin/img/" . $row["thumb"]
											. "'alt='" . $row["short_desc"] . 
										"'/>" .
									"</div>
									<div class='info'>
										<div class='name'>" . 
											 $row["name"]
										. "</div>
										<span class='price'>".  $row["price"] ." ₫</span>
									</div>
									<div class='note'>
										<span class='badge badge-primary'>KM</span>
										<span>Sẵn hàng, giảm thêm tới 1.500.000đ ...</span>
									</div>
								</a>
								</div>
							</div>
							";
						}
					?>
				</div>
			</section>

			<!-- main product display (HOT) -->
			<section class="main-product-container mt-4">
				<div class="sub-header mb-3">Sản phẩm nổi bật</div>
				<div class="products row">
					<?php
						$sql = "SELECT p.name, p.price, p.thumb, p.short_desc, p.slug FROM products p WHERE hot=true LIMIT 10";

						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							echo "
							<div class='item col col-sm-3'>
								<div class='parent-wrapper'>
								<a href='user/layout/product-detail.php?slug=" . $row['slug'] . "' class='wrapper'>
									<div class='img-wrapper'>
										<img
											src='./admin/img/" . $row["thumb"]
											. "'alt='" . $row["short_desc"] . 
										"'/>" .
									"</div>
									<div class='info'>
										<div class='name'>" . 
											 $row["name"]
										. "</div>
										<span class='price'>".  $row["price"] ." ₫</span>
									</div>
									<div class='note'>
										<span class='badge badge-primary'>KM</span>
										<span>Sẵn hàng, giảm thêm tới 1.500.000đ ...</span>
									</div>
								</a>
								</div>
							</div>
							";
						}
					?>
				</div>
			</section>

			<!-- main product display (BAN CHAY) -->
			<section class="main-product-container mt-4">
				<div class="sub-header mb-3">Sản phẩm bán chạy</div>
				<div class="products row">
					<?php
						$sql = "SELECT name, price, thumb, short_desc, slug FROM products ORDER BY quantity_sold DESC LIMIT 10";

						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							echo "
							<div class='item col col-sm-3'>
								<div class='parent-wrapper'>
								<a href='user/layout/product-detail.php?slug=" . $row['slug'] . "' class='wrapper'>
									<div class='img-wrapper'>
										<img
											src='./admin/img/" . $row["thumb"]
											. "'alt='" . $row["short_desc"] . 
										"'/>" .
									"</div>
									<div class='info'>
										<div class='name'>" . 
											 $row["name"]
										. "</div>
										<span class='price'>".  $row["price"] ." ₫</span>
									</div>
									<div class='note'>
										<span class='badge badge-primary'>KM</span>
										<span>Sẵn hàng, giảm thêm tới 1.500.000đ ...</span>
									</div>
								</a>
								</div>
							</div>
							";
						}
					?>
				</div>
			</section>

			<!-- big ads -->
			<section class="big-image">
				<a href="#"
					><img
						src="https://cdn.hoanghamobile.com/i/home/Uploads/2022/03/28/reno6-6z-01.jpg"
						style="width: 100%"
				/></a>
			</section>

			<!-- reviews -->
			<section class="review-container my-3">
				<div class="sub-header mb-4">khach hang cua acc</div>
				<div class="reviews row mx-auto my-auto justify-content-center">
					<div id="review-carousel" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<div class="item col-6">
									<div class="img-container">
										<img
											src="https://hoanghamobile.com/Uploads/2021/11/26/canh-soai-ca.jpg;width=220;height=220;mod=crop"
											alt=""
										/>
									</div>
									<div class="info">
										<div class="title">Diễn viên Doãn Quốc Đam</div>
										<div class="role">Diễn viên truyền hình</div>
										<div class="text">
											Mình biết tới Hoàng Hà nhờ 1 vài anh em trong nghề giới thiệu, từ đó là tốn
											kha khá "máu" đầu tư cho đồ công nghệ mới.
										</div>
									</div>
								</div>
							</div>

							<div class="carousel-item">
								<div class="item col-6">
									<div class="img-container">
										<img
											src="https://hoanghamobile.com/Uploads/2021/11/26/canh-soai-ca.jpg;width=220;height=220;mod=crop"
											alt=""
										/>
									</div>
									<div class="info">
										<div class="title">Diễn viên Doãn Quốc Đam</div>
										<div class="role">Diễn viên truyền hình</div>
										<div class="text">
											Mình biết tới Hoàng Hà nhờ 1 vài anh em trong nghề giới thiệu, từ đó là tốn
											kha khá "máu" đầu tư cho đồ công nghệ mới.
										</div>
									</div>
								</div>
							</div>
							<div class="carousel-item">
								<div class="item col-6">
									<div class="img-container">
										<img
											src="https://hoanghamobile.com/Uploads/2021/11/26/canh-soai-ca.jpg;width=220;height=220;mod=crop"
											alt=""
										/>
									</div>
									<div class="info">
										<div class="title">Diễn viên Doãn Quốc Đam</div>
										<div class="role">Diễn viên truyền hình</div>
										<div class="text">
											Mình biết tới Hoàng Hà nhờ 1 vài anh em trong nghề giới thiệu, từ đó là tốn
											kha khá "máu" đầu tư cho đồ công nghệ mới.
										</div>
									</div>
								</div>
							</div>
						</div>
						<a
							class="carousel-control-prev bg-transparent w-aut"
							href="#review-carousel"
							role="button"
							data-bs-slide="prev"
						>
							<i class="fa-solid fa-caret-left"></i>
						</a>
						<a
							class="carousel-control-next bg-transparent w-aut"
							href="#review-carousel"
							role="button"
							data-bs-slide="next"
						>
							<i class="fa-solid fa-caret-right"></i>
						</a>
					</div>
				</div>
			</section>

			<script>
				let items = document.querySelectorAll(".carousel#review-carousel .carousel-item");

				items.forEach((el) => {
					const minPerSlide = 2;
					let next = el.nextElementSibling;
					for (var i = 1; i < minPerSlide; i++) {
						if (!next) {
							// wrap carousel by using first child
							next = items[0];
						}
						let cloneChild = next.cloneNode(true);
						el.appendChild(cloneChild.children[0]);
						next = next.nextElementSibling;
					}
				});
			</script>

			<section class="corevalue">
				<div class="item">
					<i class="fa-solid fa-circle-check"></i>
					<div class="text">
						<div class="top">sản phẩm</div>
						<div class="bottom">chính hãng</div>
					</div>
				</div>
				<div class="item">
					<i class="fa-solid fa-circle-check"></i>
					<div class="text">
						<div class="top">sản phẩm</div>
						<div class="bottom">chính hãng</div>
					</div>
				</div>
				<div class="item">
					<i class="fa-solid fa-circle-check"></i>
					<div class="text">
						<div class="top">sản phẩm</div>
						<div class="bottom">chính hãng</div>
					</div>
				</div>
				<div class="item">
					<i class="fa-solid fa-circle-check"></i>
					<div class="text">
						<div class="top">sản phẩm</div>
						<div class="bottom">chính hãng</div>
					</div>
				</div>
			</section>
		</main>

		<?php include 'user/layout/common/footer.php'?>
	</body>
</html>
