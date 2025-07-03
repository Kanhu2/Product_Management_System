<?php
include "cfg/dbconnection.php";
$err_msg = $succ_msg = "";
$product_id = $_POST['product_id'];
$p_name = trim($_POST['p_name']);
$price = $_POST['price'];
$stock = $_POST['stock'];
// check if same product name already exists
$sql = "select * from product where product_name = '$p_name' and product_id <> '$product_id'";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0)
    $err_msg = "Product already exists";

else {
    $sql = "update product set product_name = '$p_name',price = '$price',stock = '$stock' where product_id='$product_id'";
    $result = mysqli_query($db, $sql);
    if ($result)
        $succ_msg = "Product Updated";
    else
        $err_msg = "Error: Could not update Product";
}

include('showProduct.php');
?>
