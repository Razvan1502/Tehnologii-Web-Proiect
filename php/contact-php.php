<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
} else {
    $cartItems = array();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $request = $_POST['request'];
    $message = $_POST['message'];


    $to = 'carprazvan02@gmail.com';
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