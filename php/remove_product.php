<?php
session_start();

if (isset($_POST['product'])) {
    $productName = $_POST['product'];

    // Remove the product from the session cart
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['name'] === $productName) {
                unset($_SESSION['cart'][$index]);
                break;
            }
        }   
    }
}
?>