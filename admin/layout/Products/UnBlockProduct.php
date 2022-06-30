<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if(isset($_GET['categoryID'])){
        $categoryId = $_GET['categoryID'];
    }
    //$sql = "DELETE FROM `products` WHERE id = $id";
    $sql = "UPDATE products SET active = 1 WHERE id = $id";
    $sql_u = "UPDATE categories SET active = 1 WHERE id = $categoryId";
    mysqli_query($conn,$sql);
    $s = mysqli_query($conn,$sql_u);
    header("location: ListProduct.php");
?>