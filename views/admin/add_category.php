<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 min-h-screen flex flex-col">

<?php
require_once('./header.php');
?>  

<?php
session_start();

if (isset($_SESSION['category_added']) && $_SESSION['category_added']) {
    echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Category added successfully.</span>
  </div>';
    
    // Reset the session variable
    $_SESSION['category_added'] = false;
}

?>

<div class="flex-grow flex items-center justify-center">
<div class="max-w-md w-full p-6 bg-white rounded-lg shadow-2xl">

    <h1 class="text-2xl font-semibold mb-6">Add a New Category</h1>
    <form method="POST" action="/controller/category_register.php">
        
        <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="CategoryName">Category Name:</label>
        <input type="text" id="CategoryName" name="CategoryName" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="ParentCategoryID">Parent Category:</label>
        <select id="ParentCategoryID" name="ParentCategoryID" class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
        
            <option value="">Select Parent Category (Optional)</option>
            <?php
            // Retrieve category data from the database and populate the dropdown
            $categories = getCategoriesFromDatabase(); // Implement this function
            foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['category_name'];
                if ($category['parent_category_id']) {
                    // echo ' (Parent: ' . $category['parent_category_id'] . ')';
                }
                echo '</option>';
            }
            ?>
        </select>
        </div>
        
        <input class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer" type="submit" value="Submit">
    </form>

    </div>
    </div>
</body>
</html>

<?php 
   
   function getCategoriesFromDatabase() {
    require_once('/home/wmt/Daksh/php-task/database/db_connection.php');

    // Adjust the SQL query to select categories with no parent
    $query = "SELECT id, category_name, parent_category_id FROM category";
    $result = $connection->query($query);

    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    $connection->close();
    return $categories;
}

?>