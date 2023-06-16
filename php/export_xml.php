<?php
if (isset($_POST['selected_date'])) {
    $selectedDate = $_POST['selected_date'];
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


if (isset($_POST['export_xml'])) {
    $filename = "reservations_" . $selectedDate . ".xml";


    header('Content-disposition: attachment; filename=' . $filename);
    header('Content-type: application/xml');


    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;


    $root = $dom->createElement('reservations');
    $dom->appendChild($root);


    foreach ($reservations as $reservation) {
        $reservationElement = $dom->createElement('reservation');
        $root->appendChild($reservationElement);

        foreach ($reservation as $key => $value) {
            $reservationElement->appendChild($dom->createElement($key, $value));
        }

        $reservationElement->appendChild($dom->createTextNode("\n"));
    }


    echo $dom->saveXML();
    exit();
} else {
    header("Location: admin.php");
    exit();
}
?>
