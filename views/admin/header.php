<?php
            session_start();
            if (!isset($_SESSION['email'])) {
                header('Location: /adminlogin.php');
                exit();
            }

            ?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="" class="text-white text-2xl font-bold">Logo</a>
            
            <!-- Mobile Menu Button (Hidden on Larger Screens) -->
            <div class="md:hidden">
                <button class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Desktop Menu (Hidden on Smaller Screens) -->
            <div class="hidden md:flex space-x-12">
                <a href="./dashboard.php" class="text-white hover:text-gray-200">Home</a>
                <a href="./add_category.php" class="text-white hover:text-gray-200">Add Category</a>
                <a href="./add_product.php" class="text-white hover:text-gray-200">Add Product</a>
                <a href="./view_product.php" class="text-white hover:text-gray-200">View Product</a>
                
                <a href="/logout.php" class="text-white hover:text-gray-200" onclick="return confirm('Are you sure you want to logout?')">Logout</a>

            </div>
        </div>
    </nav>
