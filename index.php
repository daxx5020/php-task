<?php
session_start();

if (isset($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
} else {
    $loginError = ""; 
}

if (isset($_SESSION['username'])) {
    header('Location: /views/user/user_dashboard.php');
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



<body class="bg-gray-200 min-h-screen flex items-center justify-center">

<div class="max-w-md w-full p-6 bg-white rounded-lg shadow-2xl">

    <h1 class="text-2xl font-semibold mb-6">User Login</h1>

    <?php if (!empty($loginError)): ?>
        <p class="text-red-600 mb-4"><?php echo $loginError; ?></p>
    <?php endif; ?>

    <form method="post" action="/controller/user_authenticate.php">

        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
            <input type="text" id="username" name="username" required
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

    <div>
    <a href="/views/user/user_registration.php" class="inline-block text-blue-500 cursor-pointer hover:text-blue-700">Register Here</a>
</div>

</div>

</body>
</html>
