<?php

session_start();

$dsn = "mysql:host=127.0.0.1;dbname=testing";
$username = "root";
$password = "";

try {

    $pdo = new PDO($dsn, $username, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT * FROM admin WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();


    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        $hashpassword = $admin['password'];

        if (password_verify($password, $hashpassword)) {
            $_SESSION['email'] = $email;
            header('Location: /views/admin/dashboard.php');
            exit();

        }

        // if email is correct and password is wrong so this else give us the error
        else {
            $_SESSION['login_error'] = 'Invalid email or password';
            header('Location: ../adminlogin.php');
            exit();
        }


    } else {

        $_SESSION['login_error'] = 'Invalid email or password';
        header('Location: ../adminlogin.php');
        exit();
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>