<?php
  session_start();
  var_dump($_SESSION['ID']);
  if(isset($_SESSION['ID'])){
      include "./../connectSQL.php";
  }else{
      include "../../../common/authorization.php";
  }
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql = "DELETE FROM `vendors` WHERE id = $id";
    mysqli_query($conn,$sql);
    header("location: ListVendors.php");
?>
