<?php include '../../../common/authorization.php'; ?>
<?php
   include '../../../common/connectSQL.php';
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = "DELETE FROM `users` WHERE id = $id";
    mysqli_query($conn,$sql);
    header("location: ListUsers.php");
?>