<?php
session_start();
include "./../../common/connectSQL.php";
if(isset($_GET['save'])){
    $sub_comment = $_GET['sub_comment'];
    $parent_comment_id = $_GET['parent-comment-id'];
    $date = gmdate("Y-m-d H:i:s", time()+7*60*60);
    $sql_subi = "INSERT INTO `sub_comments`( `comment_id`, `comment`, `created_date`, `user_id`) VALUES ( $parent_comment_id,'$sub_comment','$date',1)";
    $qr_subi = mysqli_query($conn,$sql_subi);

    header('Location:./product-detail.php');
}

if(isset($_GET['submit'])){
    $comment = $_GET['comment'];
    // $userId = $_SESSION["ID"];
    // $productId = $_GET['product-id'];
    $date = gmdate("Y-m-d H:i:s", time()+7*60*60);
    $sql = "INSERT INTO `comments`(`user_id`, `product_id`, `comment`, `created_date`) VALUES (1,1,'$comment','$date')";
    $qr = mysqli_query($conn,$sql);
    header('Location:./product-detail.php');
    }
?>