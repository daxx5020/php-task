    <?php
    session_start();


    require_once('/home/wmt/Daksh/php-task/alertMessages/messages.php');
    
    MessageHandle::displayMessage('duplicate_msg', 'Username, email, or mobile number is already exists.',false);
    MessageHandle::displayMessage('password_match', 'Passwords do not match. Please try again.',false);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">  
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow-lg">
    
        <h1 class="text-2xl font-semibold mb-6">User Registration</h1>
        
        <form action="/controller/user_register.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
    <label for="username" class="block text-gray-700 font-bold mb-2">Username: <span class="text-red-500">*</span> </label>
    <input type="text" id="username" placeholder="jack123" name="username" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
    <div id="usernameAvailability"></div>
    
</div>

            <div class="mb-4">
                <label for="firstname" class="block text-gray-700 font-bold mb-2">First Name: <span class="text-red-500">*</span> </label>
                <input type="text" id="firstname" placeholder="jack" name="firstname" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="lastname" class="block text-gray-700 font-bold mb-2">Last Name: <span class="text-red-500">*</span> </label>
                <input type="text" id="lastname" placeholder="Neo" name="lastname" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="emailid" class="block text-gray-700 font-bold mb-2">Email: <span class="text-red-500">*</span> </label>
                <input type="email" id="emailid" placeholder="jack@gmail.com" name="emailid" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="mobileno" class="block text-gray-700 font-bold mb-2">Mobile Number:</label>
                <input type="tel" id="mobileno" name="mobileno" class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password: <span class="text-red-500">*</span> </label>
                <div class="relative">
        <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" id="togglePasswordVisibility">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4a2 2 0 012-2h12a2 2 0 012 2M4 12h12m-12 8a2 2 0 012-2h12a2 2 0 012 2M4 12a4 4 0 014-4h8a4 4 0 014 4m-4 4a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </span>
    </div>
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 font-bold mb-2">Confirm Password: <span class="text-red-500">*</span> </label>
                
        <input type="password" id="password" name="confirm_password" required class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="address_line_1" class="block text-gray-700 font-bold mb-2">Address Line 1:</label>
                <input type="text" id="address_line_1" name="address_line_1" class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="address_line_2" class="block text-gray-700 font-bold mb-2">Address Line 2:</label>
                <input type="text" id="address_line_2" name="address_line_2" class="w-full px-3 py-2 border rounded shadow-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label for="profile_picture" class="block text-gray-700 font-bold mb-2">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" class="w-full">
            </div>

            <div class="mt-4">
                <input type="submit" value="Register" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 cursor-pointer">
            </div>
        </form>
    </div>
</body>
</html>

<script>
    // JavaScript to toggle password visibility
const passwordInput = document.getElementById("password");
const togglePasswordVisibility = document.getElementById("togglePasswordVisibility");

togglePasswordVisibility.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
});


$(document).ready(function() {
    const usernameInput = $("#username");

    const usernameAvailability = $("#usernameAvailability");


    usernameInput.on("input", function() {
        const username = usernameInput.val();


        if (username !== "") {

            $.ajax({
                url: "/controller/check_username.php",
                type: "POST",
                data: { username: username },
                success: function(response) {
                    // Update the username availability status div with the response
                    usernameAvailability.html(response);
                }
            });
        } else {
            // Clear the username availability status if the input is empty
            usernameAvailability.empty();
        }
    });
});



</script>

