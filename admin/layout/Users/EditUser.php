<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';
    $usernameErr = $fullnameErr = $passwordErr = $repasswordErr = $emailErr = $phoneErr = $addressErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["user_name"])) {
            $usernameErr = "Username không được để trống";
        }else{
            if (!preg_match("/^[A-Za-z0-9_\.]{6,32}$/",input_data($_POST["user_name"]))) {
                $usernameErr = "Username tối thiểu 6 kí tự";
            }
        }
        if (empty($_POST["full_name"])) {
            $fullnameErr = "FullName không được để trống";
        }else{
            if (!preg_match("/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i",input_data($_POST["full_name"]))) {
                $fullnameErr = "Họ tên chỉ bao gồm chữ cái";
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Mật khẩu không được để trống";
        }else{
            if (!preg_match("/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/",input_data($_POST["password"]))) {
                $passwordErr = "Bắt đầu bằng chữ in hoa, tối thiểu 6 kí tự";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email không được để trống";
        }else{
            if (!preg_match("/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/",input_data($_POST["email"]))) {
                $emailErr = "Email không đúng định dạng";
            }
        }

        if (empty($_POST["sdt"])) {
            $phoneErr = "Điện thoại không được để trống";
        }else{
            if (!preg_match("/^[0-9]{10}$/",input_data($_POST["sdt"]))) {
                $phoneErr = "SDT gồm 10 kí tự, bao gồm các số";
            }
        }

        if (empty($_POST["address"])) {
            $addressErr = "Địa chỉ không được để trống";
        }
    }
    function input_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql_up = "SELECT * FROM users where id = $id";
    $qr_up = mysqli_query($conn,$sql_up);
    $row_up = mysqli_fetch_assoc($qr_up);
    if(isset($_POST['upload'])){
        if($usernameErr == "" && $fullnameErr == "" && $passwordErr == "" && $emailErr == "" && $phoneErr == "" && $addressErr == ""){
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $sdt = $_POST['sdt'];
            $role = $_POST['role'];
            $user_name = $_POST['user_name'];
            $created_date = $row_up['created_date'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            
            $sql = "UPDATE `users` SET `email`='$email',`password`='$password',`full_name`='$full_name',`phone`='$sdt',`address`='$address',`created_date`='$created_date',`user_name`='$user_name',`role`='$role' WHERE id  = $id";
            $qr = mysqli_query($conn,$sql);
            header("location: ListUsers.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/dashboard.css">
    <link rel="stylesheet" href="./../../css/Addfood.css">
    <style>
        .error {color: #FF0001;}
    </style>
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
    <?php  include '../common/left.php'?>
        <div class="right">
            <h1>Edit User</h1>
            <h2><a href="#">Dasboard</a>/Edit User</h2>
            <div class="content_basic">
                <p>Basic info</p>
                <hr/>
                <form method ="POST" action="">

                    <label>Full Name</label>
                    <span class="error"><?php echo $fullnameErr; ?></span><br>
                    <input type ="text" name="full_name" class="col-6" value="<?php  echo $row_up['full_name']?>"><br><br>
                    <label>User Name </label>
                    <span class="error"><?php echo $usernameErr; ?></span><br>
                    <input type ="text" name="user_name" class="col-6" value="<?php  echo $row_up['user_name']?>"><br><br>
                    <label>Email</label>
                    <span class="error"><?php echo $emailErr; ?></span><br>
                    <input type ="text" name="email" class="col-6" value="<?php  echo $row_up['email']?>"><br><br>
                    <label>Password</label>
                    <span class="error"><?php echo $passwordErr; ?></span><br>
                    <input type ="text" name="password" class="col-6" value="<?php  echo $row_up['password']?>"><br><br>
                    <label>SDT</label>
                    <span class="error"><?php echo $phoneErr; ?></span><br>
                    <input type ="text" name="sdt" class="col-6" value="<?php  echo $row_up['phone']?>"><br><br>
                    <label>Địa chỉ</label>
                    <span class="error"><?php echo $addressErr; ?></span><br>
                    <input type ="text" name="address" class="col-6" value="<?php  echo $row_up['address']?>"><br><br>
                    <label>Vai trò</label><br>
                    <input type ="text" name="role" class="col-6" value="<?php  echo $row_up['role']?>"><br><br>
                    <br><input type="submit" name="upload" value="Lưu" class="end text-right blue" >
                </form>
                
            </div>
        </div>  
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>