<?php
session_start();

require '../sessions.php';

//Daca s-a apasat pe submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $request = $_POST['request'];
    $message = $_POST['message'];


    $to = 'brobert24072002@gmail.com';
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\nRequest: $request\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $successMessage = 'Thank you for your message. We will get back to you soon.';
        $_SESSION['success_message'] = $successMessage;
        header('Location: contact.php');
        exit();
    } else {
        $errorMessage = 'Sorry, there was an error sending your message. Please try again later.';
        $_SESSION['error_message'] = $errorMessage;
        header('Location: contact.php');
        exit();
    }
}
?>