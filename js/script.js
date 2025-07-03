function addProduct() {
    var p_name = $('#p_name').val();
    var price = $('#price').val();
    var stock = $('#stock').val();

    let isValid = true;
    $('#productErr, #priceErr, #stockErr').html("");

    if (p_name === "") {
        $('#productErr').html("Please enter product name");
        isValid = false;
    }
    if (price === "" || price <= 0) {
        $('#priceErr').html("Please enter valid price");
        isValid = false;
    }
    if (stock === "" || stock < 0) {
        $('#stockErr').html("Please enter valid stock");
        isValid = false;
    }

    if (!isValid) return false;

    $.ajax({
        url: 'add_product.php',
        type: 'POST',
        data: {
            p_name: p_name,
            price: price,
            stock: stock
        },
        success: function (response) {
            // alert(response);
            $('#products').html(response);
            $('#p_name, #price, #stock').val(""); // Clear fields if needed
        },
        error: function () {
            alert("Something went wrong.");
        }
    });

    return false; // prevent actual form submit
}


function updateProduct() {
    var product_id = $('#product_id').val();
    var p_name = $('#p_name').val();
    var price = $('#price').val();
    var stock = $('#stock').val();

    if (!validateData(p_name, price, stock))
        return false;
   
        $.ajax({
            url: "update_product.php",
            method: "POST",
            data: { product_id: product_id, p_name: p_name, price: price, stock: stock },
            dataType: "text",
            success: function (response) {
                $("#products").html(response);
                $('#p_name, #price, #stock').val("");
            }
        });

}


function delProduct(product_id, product_name) {
    if (confirm("Are you sure you want to delete product - " + product_name + "?")) {
        $.ajax({
            url: "delete_product.php",
            method: "POST",
            data: { product_id: product_id },
            dataType: "text",
            success: function (response) {
                $("#products").html(response);
            }
        });
    }
}


function validateData(p_name, p_price, p_stock) {
    if (p_name.trim() == "") {
        $("#productErr").text("Product Name must have a value");
        return false;
    }
    
    if (p_price.trim() == "" || p_price <= 0) {
        $("#priceErr").html("Enter a positive value for price");
        $("#price").focus();
        return false;
    }
    if (p_stock.trim() == "" || p_stock <= 0) {
        $("#stockErr").html("Stock should be zero or positive");
        $("#stock").focus();
        return false;
    }
    
    return true;
}
