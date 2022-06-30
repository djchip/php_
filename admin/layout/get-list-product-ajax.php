<?php
    include '../../common/connectSQL.php';

    $sql = "SELECT * FROM products";

    $rs = mysqli_query($conn, $sql);

    $content ="";
    while ($row=mysqli_fetch_assoc($rs)) {
        $content .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
    }
    echo $content;
?>