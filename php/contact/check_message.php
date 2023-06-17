<?php
//mesaj de reusita
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    echo '<p class="success-message" style="text-align: center;"><strong>' . $successMessage . '</strong></p>';
    unset($_SESSION['success_message']);
}

// mesaj de eroare
if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    echo "<p class='error-message'>$errorMessage</p>";
    unset($_SESSION['error_message']);
}
?>