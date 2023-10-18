<?php
require_once('/home/wmt/Daksh/php-task/database/db_connection.php');
require_once('/home/wmt/Daksh/php-task/alertMessages/messages.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $plainPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    if ($plainPassword === $confirmPassword) {
        $passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);
    } else {

        session_start();
        // CustomSessionHandler::set('success_message', 'Registration successful!');
        $_SESSION['password_match'] = true;
                header('Location: /views/user/user_registration.php');
                exit();
    }
    


    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $emailid = $_POST['emailid'];
    $mobileno = $_POST['mobileno'];
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];

    // Check for duplicate username, email, and mobile number
    $duplicateCheckQuery = "SELECT username, emailid, mobileno FROM user WHERE username = ? OR emailid = ? OR mobileno = ?";
    $duplicateCheckStmt = mysqli_prepare($connection, $duplicateCheckQuery);
    mysqli_stmt_bind_param($duplicateCheckStmt, "sss", $username, $emailid, $mobileno);
    mysqli_stmt_execute($duplicateCheckStmt);
    mysqli_stmt_store_result($duplicateCheckStmt);

    if (mysqli_stmt_num_rows($duplicateCheckStmt) > 0) {
        session_start();
        $_SESSION['duplicate_msg'] = true;
                header('Location: /views/user/user_registration.php');
                exit();
    } else {
        // No duplicate entry found, proceed with registration
        $uploadDir = '/home/wmt/Daksh/php-task/uploads/';
        $uniqueFileName = uniqid() . '_' . $_FILES['profile_picture']['name'];
        $targetFilePath = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            // File uploaded successfully, now insert the record into the database
            $sql = "INSERT INTO user (username, password, firstname, lastname, emailid, mobileno, address_line_1, address_line_2, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "sssssssss", $username, $passwordHash, $firstname, $lastname, $emailid, $mobileno, $address_line_1, $address_line_2, $uniqueFileName);

            if (mysqli_stmt_execute($stmt)) {
                session_start();
                $_SESSION['registration_success'] = true;
                header('Location: index.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "File upload failed.";
        }
    }

    mysqli_stmt_close($duplicateCheckStmt);
    mysqli_close($connection);
}
?>
