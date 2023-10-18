<?php

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'testing';

$connection = mysqli_connect($host, $username, $password, $database);


if (!$connection) { 
    die('Connection failed: ' . mysqli_connect_error());
}

?>
