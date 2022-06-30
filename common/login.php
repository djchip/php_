<?php
    session_start();
    include 'connectSQL.php';

    $sql = null;
    $user_name = null;
    $password = null;
    $errorMessage=null;

    if (isset($_POST['submit'])) {
        $user_name = $_POST['user-name'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM USERS WHERE user_name='$user_name' AND PASSWORD='$password'";

        $rs = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($rs);

        if (is_array($row)>0) {
            $_SESSION["ID"] = $row["id"];
            $_SESSION["user_name"] = $row["user_name"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["full_name"] = $row["full_name"];
            $_SESSION["phone"] = $row["phone"];

            if (strcasecmp($row["role"], "admin")==0 || strcasecmp($row["role"], "manager")==0) {
                header("Location:../admin/layout/Dashboard/dashboard.php");
            } else {
                header("Location:../index.php");
            }
        } else {
            $errorMessage = "Tên tài khoản hoặc mật khẩu không chính xác";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiet san pham</title>
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

    <link rel="stylesheet" href="../user/css/base.css" />
    <link rel="stylesheet" href="../user/css/header.css" />
    <link rel="stylesheet" href="../user/css/footer.css" />
    <link rel="stylesheet" href="../user/css/login.css" />
</head>
<body>

    <main class="main-content container">
        <div class="bg-wrapper"><img src="../user/img/login-bg.png"></div>

        <div class="form-wrapper">
            <h1>Đăng nhập</h1>
            <form id='loginForm' method='POST'>
                <div class="form-row">
                    <label class="label">Tài khoản</label>
                    <div class="input">
                        <input type="text" name="user-name" id="user-name">
                    </div>
                </div>
                <div class="form-row">
                    <label class="label">Mật khẩu</label>
                    <div class="input">
                        <input type="password" name="password" />
                    </div>
                </div>
                <div class="form-row d-none">
                    <label class="label">Nhớ đăng nhập</label>
                    <div class="input">
                        <input type="text" name="" id="">
                    </div>
                </div>

                <p style="color: red;"><?php if (isset($errorMessage)) {echo $errorMessage;} ?></p>
          
                <div class="form-row btns-group">
                    <button class="btn btn-submit"type="submit" name="submit">ĐĂNG NHẬP</button>
                    <button class="btn"type="button"><a href="register.php">ĐĂNG KÝ</a></button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>