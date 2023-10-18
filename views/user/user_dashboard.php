<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>    
        <?php
            session_start();
            if (!isset($_SESSION['username'])) {
                header('Location: /index.php');
                exit();
            }
            ?>
</h2>

 <a href="/logout.php"> <button>Logout</button> </a>

</body>
</html>

