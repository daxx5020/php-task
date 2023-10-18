<?php

session_start();

$dsn = "mysql:host=127.0.0.1;dbname=testing";
$username = "root";
$password = "";

try {

    $pdo = new PDO($dsn, $username, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM user WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();


    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $hashpassword = $user['password'];

        if (password_verify($password, $hashpassword)) {
            $_SESSION['username'] = $username;
            header('Location: /views/user/user_dashboard.php');
            exit();

        }

        // if email is correct and password is wrong so this else give us the error
        else {
            $_SESSION['login_error'] = 'Invalid email or password';
            header('Location: ../index.php');
            exit();
        }


    } else {

        $_SESSION['login_error'] = 'Invalid email or password';
        header('Location: ../index.php');
        exit();
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>

