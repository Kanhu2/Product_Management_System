<?php
include "cfg/dbconnection.php";
$product_id = $_POST['product_id'];
$sql = "delete from product where product_id='$product_id'";
$result = mysqli_query($db, $sql);
if ($result)
    $succ_msg = "Product Deleted";
else
    $err_msg = "Error: Could not delete Product";

include('showProduct.php');
?>