<?php
session_start();

if (isset($_POST['name']) && isset($_POST['price'])) {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];

    $item = array(
        'name' => $productName,
        'price' => $productPrice
    );

    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = $item;
    } else {
        $_SESSION['cart'] = array($item);
    }

    echo "Item added to cart successfully!";
} else {
    echo "Error: Product name or price is missing.";
}

?>