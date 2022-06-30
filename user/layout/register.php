<?php
	include '../../common/connectSQL.php';

	$message = null;
	$usernameErr = $fullnameErr = $passwordErr = $repasswordErr = $emailErr = $phoneErr = $addressErr = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["UserName"])) {
				$usernameErr = "Username không được để trống";
			}else{
				if (!preg_match("/^[A-Za-z0-9_\.]{6,32}$/",input_data($_POST["UserName"]))) {
					$usernameErr = "Username tối thiểu 6 kí tự";
				}
			}
			if (empty($_POST["FullName"])) {
				$fullnameErr = "FullName không được để trống";
			}else{
				if (!preg_match("/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i",input_data($_POST["FullName"]))) {
					$fullnameErr = "Họ tên chỉ bao gồm chữ cái";
				}
			}
			if (empty($_POST["PasswordHash"])) {
				$passwordErr = "Mật khẩu không được để trống";
			}else{
				if (!preg_match("/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/",input_data($_POST["PasswordHash"]))) {
					$passwordErr = "Bắt đầu bằng chữ in hoa, tối thiểu 6 kí tự";
				}
			}

			if (empty($_POST["SecurityStamp"])) {
				$repasswordErr = "Xác nhận lại mật khẩu";
			}else{
				if ($_POST["PasswordHash"] != $_POST["SecurityStamp"]) {
					$repasswordErr = "Xác nhận mật khẩu không đúng";
				}
			}

			if (empty($_POST["Email"])) {
				$emailErr = "Email không được để trống";
			}else{
				if (!preg_match("/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/",input_data($_POST["Email"]))) {
					$emailErr = "Email không đúng định dạng";
				}
			}

			if (empty($_POST["PhoneNumber"])) {
				$emailErr = "Điện thoại không được để trống";
			}else{
				if (!preg_match("/^[0-9]{10}$/",input_data($_POST["PhoneNumber"]))) {
					$emailErr = "SDT gồm 10 kí tự, bao gồm các số";
				}
			}

			if (empty($_POST["Address"])) {
				$addressErr = "Địa chỉ không được để trống";
			}
		}
	if (isset($_POST['submit'])) {
		if($usernameErr == "" && $fullnameErr == "" && $passwordErr == "" && $emailErr == "" && $phoneErr == "" && $addressErr == ""){
			$username = $_POST['UserName'];
			$password = $_POST['PasswordHash'];
			$fullName = $_POST['FullName'];
			$email = $_POST['Email'];
			$phone = $_POST['PhoneNumber'];
			$role = 'user';
			$address = $_POST['Address'];		
			$created_date = $date = gmdate("Y-m-d H:i:s", time()+7*60*60);

			$sql = "INSERT INTO users(user_name, full_name, password, email, phone, role, address, created_date) VALUES('$username', '$fullName', '$password', '$email', '$phone', '$role', '$address', '$created_date')";
			$result = mysqli_query($conn, $sql);
			
			if ($result==1) {
				$message = "Bạn đã tạo tài khoản thành công";
			} else {
				$message = "Đã có lỗi xảy ra, vui lòng thử lại sau";
			}
		}
	}
	
	

	function input_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
    <link rel="stylesheet" href="../css/register.css" />
	<style>
        .error {color: #FF0001;}
    </style>
	</head>
	<body>
		<!-- Header -->
		<?php include 'common/header.php'?>

		<!-- form dang ki -->
		<div class="container">

			<div class="login-form">
				<div class="login-bg">
					<img src="../img/login-bg.png">
				</div>
		
				<div class="form">
		
					<div class="center" style="text-align: center;">
						<h2 class="mb-3">Đăng ký tài khoản</h2>
						<p class="mb-4 error">Chú ý các nội dung có dấu * bạn cần phải nhập</p>
		
					</div>
		
					<div class="hh-form" id="registerForm">
						<form method="post">
							<div class="form-controls">
								<label>Tài khoản:</label>
								<div class="controls">
									<input name="UserName" id="UserName" type="text" placeholder="Tài khoản *" data-required="1" required>
									<br><span class="error"><?php echo $usernameErr; ?></span>
								</div>
								
							</div>
							<div class="form-controls">
								<label>Họ tên:</label>
								<div class="controls">
									<input name="FullName" id="FullName" type="text" placeholder="Họ tên *" data-required="1" required>
									<span class="error"><?php echo $fullnameErr; ?></span>
								</div>
								<span id="fullname_error"></span>
							</div>
		
							<div class="form-controls">
								<label>Mật khẩu:</label>
								<div class="controls">
									<input name="PasswordHash" id="PasswordHash" type="text" placeholder="Mật khẩu *" data-required="1" required>
									<span class="error"><?php echo $passwordErr; ?></span>
								</div>
								<span id="password_error"></span>
							</div>
		
							<div class="form-controls">
								<label>Nhập lại mật khẩu:</label>
								<div class="controls">
									<input name="SecurityStamp" id="SecurityStamp" type="text" placeholder="Nhập lại mật khẩu *" data-required="1" required>
									<span class="error"><?php echo $repasswordErr; ?></span>
								</div>
								<span id="repassword_error"></span>
							</div>
		
							<div class="form-controls">
								<label>Email:</label>
								<div class="controls">
									<input name="Email" id="Email" type="text" placeholder="Email *" data-required="1" required>
									<span class="error"><?php echo $emailErr; ?></span>
								</div>
								<span id="email_error"></span>
							</div>
		
							<div class="form-controls d-none">
								<label>Giới tính:</label>
								<div class="controls">
									<label class="radio-ctn">
										<input name="Sex" type="radio" value="Nam">
										<span class="checkmark"></span>
										<span><strong>Nam</strong></span>
									</label>
		
									<label class="radio-ctn">
										<input name="Sex" type="radio" value="Nữ">
										<span class="checkmark"></span>
										<span><strong>Nữ</strong></span>
									</label>
								</div>
							</div>
		
							<div class="form-controls d-none">
								<label>Ngày tháng năm sinh:</label>
								<div class="controls">
									<input name="UserBirthDate" id="UserBirthDate" type="text" placeholder="Ngày tháng năm sinh" value="">
								</div>
							</div>
		
							<div class="form-controls">
								<label>Điện thoại:</label>
								<div class="controls">
									<input name="PhoneNumber" id="PhoneNumber" type="tel" placeholder="Điện thoại *" data-required="1" required><br>
									<span class="error"><?php echo $phoneErr; ?></span>
								</div>
								<span id="phone_error"></span>
							</div>
		
							<div class="form-controls">
								<label>Địa chỉ:</label>
								<div class="controls">
									<input name="Address" id="Address" type="text" placeholder="Địa chỉ *" data-required="1" required><br>
									<span class="error"><?php echo $addressErr; ?></span>
								</div>
							</div>
		
							<div class="form-controls d-none">
								<label>Tỉnh/Thành phố:</label>
								<div class="controls">
									<select name="SystemCityID" id="SystemCityID" placeholder="Tỉnh/Thành phố">
										<option value="">Chọn tỉnh/thành phố</option>
											
									</select>
								</div>
							</div>
		
							<div class="form-controls d-none">
								<label>Quận/Huyện:</label>
								<div class="controls">
									<select name="SystemDistrictID" id="SystemDistrictID" data-required="1" placeholder="Quận/Huyện *">
										<option value="">Chọn quận/Huyện *</option>
									</select>
								</div>
							</div>
		
							<?php 
								if (!empty($message)) {
									echo "<p class='alert alert-info'>" . $message . "</p>";
									$message=null;
								}
							 ?>
		
							<div class="form-controls mt-4">
								<div class="controls submit-controls">
									<button type="submit" name="submit" >ĐĂNG KÝ TÀI KHOẢN</button>
								</div>
							</div>
		
						</form>
						
					</div>
				</div>
			</div>
			<ion-icon src="/front-end/asset/image/close-circle-outline.svg"></ion-icon>
		</div>

		<!-- Footer -->
		<?php include 'common/footer.php'?>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<!-- <script>
		function getValue(id){
                return document.getElementById(id).value.trim();
        }
		function showError(key, mess){
                document.getElementById(key + '_error').innerHTML = mess;
        }
		function validate(){
			var flag = true;
			
			// 1 tài khoản
			var username = getValue('UserName');
			if (username == '' || username.length < 5 || !/^[a-zA-Z0-9]+$/.test(username)){
				flag = false;
				showError('username', 'Username không được trống, tối thiểu 5 kí tự, không chứa ký tự đặc biệt');
			}

			// họ tên
			var fullname = getValue('FullName');
			if(fullname == '' || !/^[a-zA-Z]+$/.test(fullname)){
				flag = false;
				showError('fullname', 'Họ tên không được trống, chỉ bao gồm chữ cái');
			}
			
			// password
			var password = getValue('PasswordHash');
			var repassword = getValue('SecurityStamp');
			if (password == '' || password.length < 5){
				flag = false;
				showError('password', 'Mật khẩu không được trống, tối thiểu 5 ký tự');
			}

			//repassword
			if (password != repassword){
				flag = false;
				showError('repassword', 'Nhập lại mật khẩu không đúng');
			}
			
			
			// 3. Phone
			var phone = getValue('PhoneNumber');
			if (phone != '' ||  !/^[0-9]{10}$/.test(phone)){
				flag = false;
				showError('phone', 'Số điện thoại không đúng định dạng');
			}
			
			// 4. Email
			var email = getValue('Email');
			var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			if (!mailformat.test(email)){
				flag = false;
				showError('email', 'Email không đúng định dạng');
			}

			var address = getValue('Address');
			if(address == '' || !/^[a-zA-Z0-9]+$/.test(address)){
				flag = false;
				showError('address', 'Địa chỉ không được trống, bao gồm chữ cái và số');
			}
			
			return flag;
		}
	</script> -->
	</body>
</html>
