<?php
session_start();

$url = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tw';

$connection = new mysqli($url, $username, $password, $dbname);
if ($connection->connect_error) {
    die('Could not Connect My Sql: ' . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $table = $_POST['table'];


    $query = "SELECT * FROM reservations WHERE reservation_date = '$date' AND reservation_time = '$time' AND table_number = $table";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error_message'] = "The selected time slot and table are not available. Please choose a different time and table.";
        header("Location: reservation.php");
        exit();
    } else {
        $query = "INSERT INTO reservations (name, email, reservation_date, reservation_time, table_number) VALUES ('$name', '$email', '$date', '$time', $table)";
        $insertResult = mysqli_query($connection, $query);
        
        if ($insertResult) {
            $_SESSION['success_message'] = "Booking successful!";
        } else {
            $errorCode = mysqli_errno($connection);
            $_SESSION['error_message'] = "Error occurred while processing the booking. Error code: $errorCode";
        }
        
        header("Location: reservation.php");
        exit();
    }
}
?>
