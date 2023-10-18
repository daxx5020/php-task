<?php
// Include your database connection code
require('/home/wmt/Daksh/php-task/database/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_id'])) {
    $productID = $_GET['product_id'];

    // Perform the deletion of the product from the database
    $sql = "DELETE FROM product WHERE id = $productID";

    if ($connection->query($sql) === TRUE) {
        // Deletion successful
        header("Location: /views/admin/view_product.php"); // Redirect back to the product list page
        exit();
    } else {
        // Error occurred, handle it as needed
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

?>
