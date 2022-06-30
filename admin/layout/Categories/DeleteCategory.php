<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = "UPDATE categories SET active = 0 WHERE id = $id";
    $sql_u = "UPDATE products SET active = 0 WHERE category_id = $id";
    mysqli_query($conn, $sql_u);
    $s = mysqli_query($conn,$sql);
    header("location: ListCategory.php");
?>