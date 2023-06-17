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

    if ($password !== $confirm_password) {  // Daca nu sunt la fel nu se updateaza
        $_SESSION['error_message'] = "The new password and confirm password do not match.";
        header("Location: update-password.php");
        exit();
    }

    // Daca sunt la fel, fac hash pentru cea noua
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE register SET password = ? WHERE Email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        $success_message = "Your password has been updated successfullyS.";
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
