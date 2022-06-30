<?php
    include './../../common/connectSQL.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE id=$id"; 
        $qr = mysqli_query($conn, $sql);
        var_dump($qr);
        header("location:./account.php") ; 
    }
?>