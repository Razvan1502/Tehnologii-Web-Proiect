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

    // Generam un numar random de 6 cifre
    $code = rand(100000, 999999);

    // Il punem in baza de date in dreptul acelui utilizator
    $stmt = $mysqli->prepare("UPDATE register SET CODE = ? WHERE Email = ?");
    $stmt->bind_param("is", $code, $email);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        // Daca exista, trimitem mailul cu codul
        $to = $email;
        $subject = "Password Reset Code";
        $message = "Your password reset code is: " . $code;
        $headers = "From: noreply@example.com";

        if (mail($to, $subject, $message, $headers)) {
            $success_message = "An email with the password reset code has been sent to your email address.";
            header("Location: enter-code.php?email=" . urlencode($email) . "&success_message=" . urlencode($success_message));
            exit();
        } else {
            $error_message = "Failed to send the email. Please try again later.";
            header("Location: forgot.php?error_message=" . urlencode($error_message));
            exit();
        }
    } else {
        // Emailul nu exista in baza de date
        $error_message = "Invalid email";
        header("Location: forgot.php?error_message=" . urlencode($error_message));
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
