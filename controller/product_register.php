<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    require_once('/home/wmt/Daksh/php-task/database/db_connection.php');

    // Retrieve data from the form
    $productName = $_POST["productname"];
    $categoryId = (int)$_POST["categoryid"]; // Cast to integer
    $basicPrice = $_POST["basicprice"];
    $discountedPrice = $_POST["discountedprice"];
    $smallDescription = $_POST["smalldescription"];
    $detailDescription = $_POST["detaildescription"];

    // Image upload handling
    $imageDirectory = '/home/wmt/Daksh/php-task/uploads/'; // Specify the directory where you want to store uploaded images

    // Insert product data into the product table
    $sql = "INSERT INTO product (product_name, category_id, basic_price, discounted_price, small_description, detail_description)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sisdss", $productName, $categoryId, $basicPrice, $discountedPrice, $smallDescription, $detailDescription);

    if ($stmt->execute()) {
        $productID = $stmt->insert_id;

        // Loop through all uploaded image files
        foreach ($_FILES['productimage']['tmp_name'] as $key => $imageTmpName) {
            $imageName = uniqid() . '_' . $_FILES['productimage']['name'][$key];

            if (move_uploaded_file($imageTmpName, $imageDirectory . $imageName)) {
                // Insert image data into the image table for each image
                $imageSql = "INSERT INTO image (product_id, image_path)
                             VALUES (?, ?)";
                $imageStmt = $connection->prepare($imageSql);
                $imageStmt->bind_param("is", $productID, $imageName);
                $imageStmt->execute();
                $imageStmt->close();
            } else {
                // Error occurred during image upload
                $_SESSION['product_added'] = false;
            }
        }

        $_SESSION['product_added'] = true;
    } else {
        // Error occurred, set an error message
        $_SESSION['product_added'] = false;
    }


    $stmt->close();


    $connection->close();

    header("Location: ../views/admin/view_product.php");
    exit();
}


?>


