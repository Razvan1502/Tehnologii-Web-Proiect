<?php
session_start();

if (isset($_POST['name']) && isset($_POST['price'])) {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];

    // Facem un obiect nou
    $item = array(
        'name' => $productName,
        'price' => $productPrice
    );

    // Daca variabila de sesiune 'cart' nu exista, o cream, altfel punem cate un element nou la cartul existent
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = $item;    //adaugare item nou
    } else {
        $_SESSION['cart'] = array($item);   //creare pt item nou
    }

    echo "Item added to cart successfully!";
} else {
    echo "Error: Product name or price is missing.";
}

?>