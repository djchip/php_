<?php
    session_start();
    if (isset($_GET['logout'])) {
        unset($_SESSION["ID"]);
        unset($_SESSION["user_name"]);
        unset($_SESSION["role"]);
        unset($_SESSION["first_name"]);
        unset($_SESSION["last_name"]);
        
        header("Location:../dashboard.php");
    }
?>