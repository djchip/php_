<?php
    include '../../../common/authorization.php';
    include '../../../common/connectSQL.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM orders WHERE id=$id"; 
        mysqli_query($conn, $sql);  
    }
?>