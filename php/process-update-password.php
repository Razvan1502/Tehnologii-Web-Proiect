<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "tw";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {  //daca cele 2 parole nu sunt la fel
        $_SESSION['error_message'] = "The new password and confirm password do not match.";
        header("Location: update-password.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);  //hash pt noua parola

    $stmt = $mysqli->prepare("UPDATE register SET password = ? WHERE Email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {   //facem update
        $success_message = "Your password has been updated successfully.";
        $_SESSION['success_message'] = $success_message;
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to update the password. Please try again later.";
        header("Location: update-password.php");
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
