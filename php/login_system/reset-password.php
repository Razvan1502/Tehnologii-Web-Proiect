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
    $code = $_POST['code'];

    $stmt = $mysqli->prepare("SELECT * FROM register WHERE Email = ? AND CODE = ?");
    $stmt->bind_param("si", $email, $code);
    $stmt->execute();

    $result = $stmt->get_result();

    // Daca codurile sunt la fel
    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        $email = $_POST['email'];
        $_SESSION['reset_email'] = $email;
        header("Location: update-password.php");
        exit();
    } else {    //emailul sau codul sunt gresite
        $error_message = "Invalid code";
        header("Location: enter-code.php?email=" . urlencode($email) . "&error_message=" . urlencode($error_message));
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
