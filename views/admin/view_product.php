<?php 
require_once('/home/wmt/Daksh/php-task/database/db_connection.php');

function getProductsFromDatabase($connection) {
    $query = "SELECT * FROM product";

    $result = $connection->query($query);
    $products = array();

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}

// Function to get category name by ID
function getCategoryNameById($connection, $category_id) {
    $query = "SELECT category_name FROM category WHERE id = ?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $category_name);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);

    return $category_name;
}

$products = getProductsFromDatabase($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 min-h-screen flex flex-col">
    
<?php
require_once('./header.php');
?>

<!-- Product List Table -->
<div class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow-2xl">
    <h1 class="text-2xl font-semibold mb-6">Product List</h1>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Product Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Basic Price
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Discounted Price
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Small Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Detail Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
            </tr>
        </thead>
        
        <tbody class="bg-white divide-y divide-gray-200">
            <?php
            foreach ($products as $product) {
                echo '<tr>
                        <td class="px-6 py-4 whitespace-nowrap">' . $product['product_name'] . '</td>
                        <td class="px-6 py-4 whitespace-nowrap">' . getCategoryNameById($connection, $product['category_id']) . '</td>
                        <td class="px-6 py-4 whitespace-nowrap">' . $product['basic_price'] . '</td>
                        <td class="px-6 py-4 whitespace-nowrap">' . $product['discounted_price'] . '</td>
                        <td class="px-6 py-4 whitespace-nowrap">' . $product['small_description'] . '</td>
                        <td class="px-6 py-4 whitespace-nowrap">' . $product['detail_description'] . '</td>
                        <td>
                        

                        <button class="bg-blue-500 hover-bg-blue-700 text-white font-bold py-1 px-2 mr-4 rounded">
                        <a href="/views/admin/edit_product.php?product_id=' . $product['id'] . '">Edit</a>
                    </button>
                     
<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="confirmDelete(' . $product['id'] . ')">Delete</button>
  
  </td>

                    </tr>';
            }
            ?>
        </tbody>
        

    </table>
</div>
<!-- End of Product List Table -->

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>

<script>
    function confirmDelete(productID) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "/controller/delete_product.php?product_id=" + productID;
        }
    }
</script>
