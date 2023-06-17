<?php
session_start();

// Facem un vector de frecventa pentru a salvav produsul si cantitatea din fiecare
$cartFrequency = array();

foreach ($_SESSION['cart'] as $item) {
    $productName = $item['name'];

    if (isset($cartFrequency[$productName])) {
        // Marim cantitatea
        $cartFrequency[$productName] += 1;
    } else {
        // Adaugam la vectorul de frecventa si punem 1
        $cartFrequency[$productName] = 1;
    }
}

$_SESSION['cart2'] = $cartFrequency;

$cartItems = $_SESSION['cart2'];

$userEmail = $_SESSION['email'];

$url = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tw';

$conn = new mysqli($url, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Could not Connect My Sql: ' . $conn->connect_error);
}

$userName = "";
$selectUserQuery = "SELECT Name FROM register WHERE Email = ?";
$selectUserStmt = $conn->prepare($selectUserQuery);
$selectUserStmt->bind_param("s", $userEmail);
$selectUserStmt->execute();
$result = $selectUserStmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row['Name'];
}

// Verificam daca toate produsele sunt disponibile (au cantitatea disponibila)
foreach ($cartItems as $productName => $quantity) {
    // Verific daca exista in baza de date acel produs
    $selectProductQuery = "SELECT product_id, quantity FROM products WHERE product_name = ?";
    $selectProductStmt = $conn->prepare($selectProductQuery);
    $selectProductStmt->bind_param("s", $productName);
    $selectProductStmt->execute();
    $result = $selectProductStmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];

        if ($availableQuantity < $quantity) {
            // Cantitatea insuficienta
            echo "Insufficient quantity of $productName in stock. Please adjust your order.";
            exit();
        }
    } else {
        // Produsul nu e gasit in BD
        echo "Product $productName not found in stock. Please adjust your order.";
        exit();
    }
}

// Daca e ok totul, introducem acea comanda in BD

date_default_timezone_set('Europe/Bucharest');  // Punem data si ora pe Romania
$orderDate = date('Y-m-d H:i:s'); 

$insertOrderQuery = "INSERT INTO orders (user_name, user_email, total_price, order_date) VALUES (?, ?, ?, ?)";
$orderStmt = $conn->prepare($insertOrderQuery);
$orderStmt->bind_param("ssds", $userName, $userEmail, $_SESSION['total_price'], $orderDate);
$orderStmt->execute();

// Luam numarul comenzii
$orderId = $conn->insert_id;

// Daca produsul nu exista in BD la products (deja), il inseram
$insertProductQuery = "INSERT INTO products (product_name) VALUES (?)";
$productStmt = $conn->prepare($insertProductQuery);
$productStmt->bind_param("s", $productName);

// Inseram produsele din comanda si updatam cantitatile
foreach ($cartItems as $productName => $quantity) {
    // Luam ID-ul produsului din tabela
    $selectProductQuery = "SELECT product_id FROM products WHERE product_name = ?";
    $selectProductStmt = $conn->prepare($selectProductQuery);
    $selectProductStmt->bind_param("s", $productName);
    $selectProductStmt->execute();
    $result = $selectProductStmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productId = $row['product_id'];

        // Inseram in tabela de order_items, cate ceaiuri a luat din fiecare si care sunt acestea
        $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $orderItemStmt = $conn->prepare($insertOrderItemQuery);
        $orderItemStmt->bind_param("iii", $orderId, $productId, $quantity);
        $orderItemStmt->execute();

        // Updatam cantitatea in BD
        $updateQuantityQuery = "UPDATE products SET quantity = quantity - ? WHERE product_id = ?";
        $updateQuantityStmt = $conn->prepare($updateQuantityQuery);
        $updateQuantityStmt->bind_param("ii", $quantity, $productId);
        $updateQuantityStmt->execute();
        $updateQuantityStmt->close();
    }
}

// Resetam cosul dupa ce am plasat comanda
$_SESSION['cart'] = array();

$selectUserStmt->close();
$productStmt->close();
$orderItemStmt->close();
$orderStmt->close();
$selectProductStmt->close();
$conn->close();

echo "Order submitted successfully.";
?>
