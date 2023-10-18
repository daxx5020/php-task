<?php
// Include your database connection file
require_once('/home/wmt/Daksh/php-task/database/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    // Query the database to check if the username exists
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if the username exists
    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo '<span class="text-red-500">Username is already taken.</span>';
    } else {
        echo '<span class="text-green-500">Username is available.</span>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
?>
