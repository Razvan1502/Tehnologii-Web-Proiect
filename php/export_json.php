<?php
session_start(); 


if (isset($_POST['selected_date'])) {
    $selectedDate = $_POST['selected_date'];
} else {
    header("Location: admin.php");
    exit();
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $isAdminLoggedIn = true;
} else {

    header("Location: admin.php");
    exit();
}


$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "tw";


$conn = mysqli_connect($servername, $username, $password, "$dbname");
if (!$conn) {
    die('Could not Connect MySql Server:' . mysql_error());
}


$sql = "SELECT * FROM reservations WHERE reservation_date = '$selectedDate'";
$result = mysqli_query($conn, $sql);


$reservations = array();
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}


mysqli_close($conn);


if (isset($_POST['export'])) {
    $filename = "reservations_" . $selectedDate . ".json";


    header('Content-disposition: attachment; filename=' . $filename);
    header('Content-type: application/json');

    echo json_encode($reservations);
    exit();
} else {
    header("Location: admin.php");
    exit();
}

?>
