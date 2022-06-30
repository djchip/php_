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
            .cong{
                padding: 20px 40px;
                text-align: center;
            }
            .hang{
                background-color: orange;
                border-style: none;
                padding: 10px 15px;
            }
            .hang a{
                color: white;
                text-decoration: none;
            }

        </style>

	</head>
	<body>
		<!-- Header -->
		<?php include './common/header.php'?>

		<!-- Gio hang -->
		<div class="container cong">
            <p>Vui lòng đăng nhập để mua hàng</p>
            <button type="button" class="hang"><a href="./../../common/login.php">Đi đến trang đăng nhập</a></button>
        </div>
		<!-- Footer -->
		<?php include './common/footer.php'?>
	</body>
</html>
