<?php
session_start();

if (isset($_POST['selected_date'])) {
    $selectedDate = $_POST['selected_date'];
}

// Verific daca userul este conectat si este si admin
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $isAdminLoggedIn = true;
}

require '../db_conn.php';

// Luam datele rezervarilor de la data ceruta
$sql = "SELECT * FROM reservations WHERE reservation_date = '$selectedDate'";
$result = mysqli_query($conn, $sql);

// Le punem intr-un vector
$reservations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}

mysqli_close($conn);

// Le dam export datelor in format .json
if (isset($_POST['export'])) {
    $filename = "reservations_" . $selectedDate . ".json";

    //Browserul va descarca un fisier .json cu numele specificat in variabila $filename.
    header('Content-disposition: attachment; filename=' . $filename);
    header('Content-type: application/json');

    // Afiseaza datele ca .json
    echo json_encode($reservations);
    exit();
}

?>
