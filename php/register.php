<?php
extract($_POST);

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
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // nici nu mai trebuie ca am verificat in html cu javaScript
    if ($password !== $confirm_password) {
        header("Location: register.php?error=password");
        exit();
    }

    $check_query = "SELECT * FROM register WHERE Email = '$email'";
    $result = $mysqli->query($check_query);

    if ($result->num_rows > 0) {    //verific daca emailul exista deja in baza de date
        $error_message = "This email address is already used!";
        header("Location: signup.php?error_message=" . urlencode($error_message));
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO register (Name, Email, Password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    $stmt->execute();

    if ($stmt->error) {
        header("Location: error.php");
        exit();
    }

    header("Location: login.php");
    exit();
}
?>
