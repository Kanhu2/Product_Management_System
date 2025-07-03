<?php
include "cfg/dbconnection.php";
$err_msg = $succ_msg = "";
$p_name = trim($_POST['p_name']);
$price = $_POST['price'];
$stock = $_POST['stock'];
// check if same product name already exists
$sql = "select * from product where product_name = '$p_name'";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0)
    $err_msg = "Product already exists";

else {
    $sql = "insert into product (product_name,price,stock) values('$p_name', '$price', '$stock')";
    $result = mysqli_query($db, $sql);
    if ($result)
        $succ_msg = "Product Added";
    else
        $err_msg = "Error: Could not add Product";
}

include('showProduct.php');
?>
