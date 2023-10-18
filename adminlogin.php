<?php
session_start();

if (isset($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
} else {
    $loginError = ""; 
}

if (isset($_SESSION['email'])) {
    header('Location: /views/admin/dashboard.php'); // Redirect to the dashboard page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">

    <h1 class="text-2xl font-semibold mb-6">Admin Login</h1>

    <?php if (!empty($loginError)): ?>
        <p class="text-red-600 mb-4"><?php echo $loginError; ?></p>
    <?php endif; ?>

    <form method="post" action="/controller/admin_authenticate.php">

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="text" id="email" name="email" required
                   class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div class="mb-4">
            <input type="submit" value="Login"
                   class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer">
        </div>

    </form>

</div>

</body>
</html>
