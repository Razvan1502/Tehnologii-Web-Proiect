<?php
session_start();

// Verific daca userul este conectat si este si admin
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $isAdminLoggedIn = true;
} else {
    $isAdminLoggedIn = false;
}

if ($isAdminLoggedIn) {

    require '../db_conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $sql = "UPDATE products SET quantity = $quantity WHERE product_id = $product_id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = 'Quantity updated successfully.';
        } else {
            $_SESSION['error_message'] = 'Error updating quantity: ' . mysqli_error($conn);
        }
        header('Location: admin.php');
    }

    mysqli_close($conn);
    
} else {
    header('Location: ../login_system/login.php');
    exit;
}
