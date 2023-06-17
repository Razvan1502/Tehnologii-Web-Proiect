<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

if (isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $admin = true;
} else {
    $admin = false;
}

if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
} else {
    $cartItems = array();
}

?>
