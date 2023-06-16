<?php
session_start();

session_destroy();  //desetam toate variabilele
header('Location: login.php');
exit();
?>
