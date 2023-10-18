<?php require_once('/home/wmt/Daksh/php-task/database/db_connection.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<?php
require_once('./header.php');
?>

<div class="flex items-center justify-between">
 <div class="mx-10 my-10 w-full max-w-xs bg-white border border-gray-600 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-end px-4 pt-4">
    </div>
    <div class="flex flex-col items-center pb-10">
        <i class="fa fa-user fa-4x"></i>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Users</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400"> <?php
    $query = "SELECT COUNT(*) as count FROM user";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    echo $count;
?>  </span>
     
    </div>
</div>

<div class="mx-10 my-10 w-full max-w-xs bg-white border border-gray-600 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-end px-4 pt-4">
    </div>
    <div class="flex flex-col items-center pb-10">
        <i class="fa fa-user fa-4x"></i>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Products</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400"><?php
    $query = "SELECT COUNT(*) as count FROM product";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    $count = $row['count'];
    echo $count;
?></span>
     
    </div>
</div>

<div class="mx-10 my-10 w-full max-w-xs bg-white border border-gray-600 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-end px-4 pt-4">
       
    </div>
    <div class="flex flex-col items-center pb-10">
        <i class="fa fa-user fa-4x"></i>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Orders</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">10</span>
     
    </div>
</div>

</div>
<?php
            session_start();
            if (!isset($_SESSION['email'])) {
                header('Location: /adminlogin.php');
                exit();
            }

            ?>

</body>
</html>




