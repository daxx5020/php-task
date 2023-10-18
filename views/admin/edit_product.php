<?php 
require_once('/home/wmt/Daksh/php-task/database/db_connection.php');
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($connection, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
    // Handle the case where the product with the given ID is not found
    echo "Product not found.";
    exit;
    }
   }
   
   else {
    // Handle cases where the product ID is not provided.
    echo "Product ID not provided.";
    exit;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 min-h-screen flex flex-col">

<?php
require_once('./header.php');
?>  

<?php 
session_start();
if (isset($_SESSION['product_added']) && $_SESSION['product_added']) {
    echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">Product added successfully.</span>
  </div>';
    
    // Reset the session variable
    $_SESSION['product_added'] = false;
}

?>
<div class="my-10 flex-grow flex items-center justify-center">
<div class="max-w-md w-full p-6 bg-white rounded-lg shadow-2xl">

    <h1 class="text-2xl font-semibold mb-6">Add a New Product</h1>
    
        
    <form method="POST" action="/controller/update_product.php?product_id=<?php echo $product['id']; ?>" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="productname">Product Name:</label>
                    <input type="text" id="productname" name="productname" required value="<?php echo $product['product_name']; ?>"
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="categoryid">Category:</label>
    <select id="categoryid" name="categoryid" class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
    <option value="">Select a Category</option>
    <?php
    // Fetch categories from the database and populate the dropdown
    require_once('/home/wmt/Daksh/php-task/database/db_connection.php');
    $query = "SELECT id, category_name, parent_category_id FROM category";
    $result = $connection->query($query);

    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    foreach ($categories as $category) {
        $categoryId = $category['id'];
        $categoryName = $category['category_name'];
        
        // Check if the current option's value matches the product's category ID
        $selected = ($categoryId == $product['category_id']) ? 'selected' : '';
        
        echo '<option value="' . $categoryId . '" ' . $selected . '>' . $categoryName . '</option>';
    }
    ?>
</select>
</div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="basicprice">Basic Price:</label>
                    <input type="number" id="basicprice" name="basicprice" required min="0" value="<?php echo $product['basic_price']; ?>"
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="discountedprice">Discounted Price:</label>
                    <input type="number" id="discountedprice" name="discountedprice" required min="0" value="<?php echo $product['discounted_price']; ?>"
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="smalldescription">Small Description:</label>
                    <textarea id="smalldescription" name="smalldescription" required 
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300"
                        rows="4"><?php echo $product['small_description']; ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="detaildescription">Detail Description:</label>
                    <textarea id="detaildescription" name="detaildescription" required
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300"
                        rows="8"><?php echo $product['detail_description']; ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="productimage">Product Image:</label>
                    <input type="file" id="productimage" name="productimage[]" multiple
                        class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300" >
                </div>

                <input type="submit" value="Register"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer">
            </form>

    </div>
    </div>
</body>
</html>

<script>
    // JavaScript to set the default value of the dropdown
    document.getElementById("categoryid").value = <?php echo $product['detail_description']; ?>;
</script>
