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
            $product_name = $product_row['product_name']; ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $product_row['product_id']; ?></td>
                <td><?php echo $product_row['product_name']; ?></td>
                <td><?php echo $product_row['price']; ?></td>
                <td><?php echo $product_row['stock']; ?></td>
                <td>
                    <a class="fa fa-edit" title="Edit" href="index.php?id=<?php echo $product_id; ?>&flag=edit"></a>
                    <a class="fa fa-remove" title="Delete" href="javascript:void(0)" onClick="delProduct('<?php echo $product_id; ?>','<?php echo $product_name; ?>')"></a>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="7">No Products found</td>
        </tr>
    <?php } ?>
</table>
<script>
    // to display success or error message
    <?php if (!empty($succ_msg)) { ?>
        $('#showMsg').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button><?= $succ_msg; ?></div>");
        clearValues();
    <?php }
    if (!empty($err_msg)) { ?>
        $('#showMsg').html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button><?= $err_msg; ?></span");
    <?php } ?>
    $("#frm").data("changed", false);
</script>