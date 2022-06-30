<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql_up = "SELECT * FROM product_images WHERE id = $id";
    $qr_up = mysqli_query($conn,$sql_up);
    $row = mysqli_fetch_assoc($qr_up);
    $sql = "DELETE FROM product_images WHERE id = $id";
    $qr = mysqli_query($conn,$sql);
    
    var_dump($qr_up);
    var_dump($qr);
    
    var_dump($row);
    $product_id = $row['product_id'];
    var_dump($product_id);
    header("location: Details.php?id=$product_id");
?>