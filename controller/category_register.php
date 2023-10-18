<?php
// Include your database connection file
require_once('/home/wmt/Daksh/php-task/database/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $CategoryName = $_POST['CategoryName'];
    $ParentCategoryID = $_POST['ParentCategoryID'];

    if (empty($ParentCategoryID)) {
        $ParentCategoryID = null;
    }

    $sql = "INSERT INTO category (category_name, parent_category_id) VALUES (?, ?)";


    $stmt = mysqli_prepare($connection, $sql);


    mysqli_stmt_bind_param($stmt, "ss", $CategoryName, $ParentCategoryID);


    if (mysqli_stmt_execute($stmt)) {

        session_start();
        $_SESSION['category_added'] = true;
                header('Location: /views/admin/add_category.php');
                exit();
    } else {

        echo "Error: " . mysqli_error($connection);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>
