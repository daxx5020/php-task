<?php
session_start();


if (isset($_SESSION['email'])) {

    session_destroy();
    header('Location: adminlogin.php');
} 
    elseif (isset($_SESSION['username'])) {

    session_destroy();
    header('Location: index.php'); 
} 
// else {
//     header('Location: index.php');
// }

exit();
?>