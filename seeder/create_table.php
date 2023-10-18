<?php
require_once('./database/db_connection.php');

// Define the SQL query to create a table
$sqlCreateTable = "
CREATE TABLE Images (
    id INT PRIMARY KEY,
    product_id INT, -- Foreign Key referencing Product
    images TEXT ,
    FOREIGN KEY (product_id) REFERENCES product(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";


if (mysqli_query($connection, $sqlCreateTable)) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($connection) . "<br>";
}

?>
