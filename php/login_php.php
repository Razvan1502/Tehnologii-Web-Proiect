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
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT Password FROM register WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();  //avem rezultatul randului

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            
            if ($email === "brobert24072002@gmail.com") {       //aici verificam daca contul are privilegii de administrator
                $_SESSION['admin_in'] = true;
            } else {
                $_SESSION['admin_in'] = false;
            }
            
            header("Location: index.php");
            exit();
        }
    }

    $error_message = "Invalid email or password!";
    header("Location: login.php?error_message=" . urlencode($error_message));
    exit();
}
?>