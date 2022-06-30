<?php
    session_start();

    define('HOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', 'bachien2k1');
    define('DATABASE', 'smartphone2');

    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (mysqli_connect_error()) {
        die('Error connecting to db: '. mysqli_connect_error());
    }
    
    
    // nếu chưa đăng nhập thì redirect sang trang login để đăng nhập
    $requiredLoginUrls = array("/admin");
    $currentUrl = $_SERVER['REQUEST_URI'];

    for ($i=0; $i<count($requiredLoginUrls); $i++) {
        if (strpos($currentUrl, $requiredLoginUrls[$i])) {
            if (!isset($_SESSION['ID'])) {
                header('Location:/acc-app/common/login.php');
                break;
            }
        }
    }

    $userId = -1;
    if (!empty($_SESSION['ID'])) {
        $userId = $_SESSION['ID'];
    }

    $sql = "SELECT * FROM users WHERE id=$userId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (is_array($row)==true) {
        if ( strcasecmp($row["role"], "admin")!=0 && strcasecmp($row["role"], "manager")!=0 ) {
            header('Location:/acc-app/common/login.php');
        } 
    }
?>