<?php
include "cfg/dbconnection.php";
$product_id = $p_id = $p_name = $price = $stock = $flag = "";
$product_found = false;

if (isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'edit') {
    $flag = $_REQUEST['flag'];
    if (isset($_REQUEST['id'])) {
        $p_id = $_REQUEST['id'];
        $sql = "select * from product where product_id='$p_id'";
        $rs = mysqli_query($db, $sql);
        if (mysqli_num_rows($rs) > 0) {
            $product_found = true;
            $row = mysqli_fetch_array($rs);
            $p_name = $row['product_name'];
            $price = $row['price'];
            $stock = $row['stock'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all" />

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Add, Update and Delete Product using Ajax</h2>
        <div id="showMsg"></div>

        <div class="row">
            <div class="col-md-8">
                <h4>Product List</h4>
                <div class="table-responsive" id="products">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <thead>
                                <th>Serial No.</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </thead>
                        </tr>
                        <?php
                        $select = "select * from product order by product_id";
                        $products = mysqli_query($db, $select);
                        $counter = 0;
                        if (mysqli_num_rows($products) > 0) {
                            foreach ($products as $product_row) {
                                $counter++;
                                $product_id = $product_row['product_id'];
                                $product_name = $product_row['product_name'];
                        ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $product_row['product_id']; ?></td>
                                    <td><?php echo $product_row['product_name']; ?></td>
                                    <td><?php echo $product_row['price']; ?></td>
                                    <td><?php echo $product_row['stock']; ?></td>
                                    <td>
                                        <a class="fa fa-edit" title="Edit" href="index.php?id=<?php echo $product_id; ?>&flag=edit">Edit</a>&nbsp;&nbsp;&nbsp;
                                        <a class="fa fa-remove" title="Delete" href="javascript:void(0)" onClick="delProduct('<?php echo $product_id; ?>','<?php echo $product_name; ?>')">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7">No Products found</td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <?php if ($flag == "edit" && $product_found == true) { // Update Product Form 
            ?>
                <div class="col-md-4">
                    <h4>Update Product</h4>
                    <form id="frm">
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $p_id; ?>">
                        <div class="form-group col-md-12">
                            <label>Product Name</label>
                            <input type="text" name="p_name" id="p_name" class="form-control" maxlength="255" value="<?php echo $p_name; ?>">
                            <div class="error" id="productErr"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" min=".01" max="9999.99" step="any" value="<?php echo $price; ?>">
                            <div class="error" id="priceErr"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?php echo $stock; ?>">
                            <div class="error" id="stockErr"></div>
                        </div>
                        <div class="col-md-12 text-right">
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                            <input type="button" class="btn btn-primary" onclick="updateProduct()" value="Save">
                        </div>
                    </form>
                </div>
            <?php } else {  // Add Product Form 
            ?>
                <div class="col-md-4">
                    <h4>Add Product</h4>
                    <form id="frm">
                        <div class="form-group col-md-12">
                            <label>Product Name</label>
                            <input type="text" name="p_name" id="p_name" class="form-control" maxlength="255">
                            <div class="error" id="productErr"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" min=".01" max="9999.99" step="any">
                            <div class="error" id="priceErr"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" min="0">
                            <div class="error" id="stockErr"></div>
                        </div>
                        <div class="col-md-12 text-right">
                            <input type="button" class="btn btn-primary" onclick="addProduct()" value="Add">
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>