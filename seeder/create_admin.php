<?php
require_once('./database/db_connection.php');


$adminEmail = 'admin';
$adminPassword = '123';

$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

$sqlInsertAdmin = "INSERT INTO admin (email, password) VALUES ('$adminEmail', '$hashedPassword')";

// Execute the query to create the table
if (mysqli_query($connection, $sqlInsertAdmin)) {
    echo "Data inserted successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($connection) . "<br>";
}

// Close the database connection
mysqli_close($connection);
?>
