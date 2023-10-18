<?php

$product_id = $_GET['product_id'];
// print_r($product_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate the new product data
    require_once('/home/wmt/Daksh/php-task/database/db_connection.php');
    
    $product_name = $_POST['productname'];
    $product_category = $_POST['categoryid'];
    $price_basic = $_POST['basicprice'];
    $price_discounted = $_POST['discountedprice'];
    $small_description = $_POST['smalldescription'];
    $description = $_POST['detaildescription'];

    // Update the database with the new product data using prepared statements
    $update_query = "UPDATE product SET 
    product_name = ?,
    category_id = ?,
    basic_price = ?,
    discounted_price = ?,
    small_description = ?,
    detail_description = ?
    WHERE id = ?";

$stmt = mysqli_prepare($connection, $update_query);

// Bind parameters, including the product_id
mysqli_stmt_bind_param($stmt, "ssddssi", $product_name, $product_category, $price_basic, $price_discounted, $small_description, $description, $product_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to view-product.php after updating
        header('Location: ../views/admin/view_product.php');
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($connection);
    }
} 
?>
