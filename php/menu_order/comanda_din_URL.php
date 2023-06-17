<?php
if (isset($_GET['item'])) {

    $itemName = $_GET['item'];  //luam numele din URL

    $productExists = false;
    $selectedProduct = null; 

    if ($itemName === 'alcool' || $itemName === 'tigari' || $itemName === 'droguri') {
        // Redirectioneaza utilizatorul catre o pagina de eroare si seteaza codul de stare 403 Forbidden
        header("HTTP/1.1 403 Forbidden");
        exit();
    }

    foreach ($products as $product) {
        if ($product['product_name'] === $itemName) {
            $productExists = true;
            $selectedProduct = $product; // Daca exista produsul
            break;
        }
    }

    if ($productExists) {
        // Il adaugam in cos
        $item = array(
            'name' => $selectedProduct['product_name'],
            'price' => $selectedProduct['product_price']
        );
    
        if (isset($_SESSION['cart'])) {
            // Adaugam in cos acel produs
            $_SESSION['cart'][] = $item;
        } else {
            // Cream cosul
            $_SESSION['cart'] = array($item);
        }
        header("Location: cart.php");
        exit();
    } else {
        echo "Product not found.";
    }
}
?>