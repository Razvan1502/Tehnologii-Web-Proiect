<?php

if (isset($_POST['selected_date'])) {
    $selectedDate = $_POST['selected_date'];
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

// Le dam export datelor in format .xml
if (isset($_POST['export_xml'])) {
    $filename = "reservations_" . $selectedDate . ".xml";

    //Browserul va descarca un fisier .xml cu numele specificat in variabila $filename.
    header('Content-disposition: attachment; filename=' . $filename);
    header('Content-type: application/xml');

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    $root = $dom->createElement('reservations');
    $dom->appendChild($root);

    // Mergem prin fiecare rezervare si o punem in .xml cu tagul 'reservation'
    foreach ($reservations as $reservation) {
        $reservationElement = $dom->createElement('reservation');
        $root->appendChild($reservationElement);

        foreach ($reservation as $key => $value) {
            $reservationElement->appendChild($dom->createElement($key, $value));
        }

        $reservationElement->appendChild($dom->createTextNode("\n"));       // punem dupa fiecare rezervare o linie noua
    }

    echo $dom->saveXML();
    exit();
}

?>