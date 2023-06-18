<?php
require '../sessions.php';
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="../styles/log.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <section class="sub-header">
        <?php require 'navbar_login.html'; ?>

        <h1>Login</h1>

    </section>
    
   <div class="wrapper">
    <form action="login_php.php" method="post">
        <?php

        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
            header("Location: ../index.php");

        if (isset($_GET['success_message'])) {
            $success_message = $_GET['success_message'];
            echo '<p class="success-message"><strong>' . $success_message . '</strong></p>';
        }

        if (isset($_SESSION['success_message'])) {
        $success_message = $_SESSION['success_message'];
        echo '<p class="success-message"><strong>' . $success_message . '</strong></p>';
        unset($_SESSION['success_message']);
        }

        if (isset($_GET['error_message'])) {
            $error_message = $_GET['error_message'];
            echo '<p> <strong> Error: ' . $error_message . '</strong></p>';
        }
        ?>
        <input type="text" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <div class="recover">
            <a href="./forgot.php">Forgot password?</a>
        </div>
        <button type="submit" name="save">Login</button>
    </form>
   
    <div class="member">
        Not a member? <a href="./signup.php">Register Now</a> 
    </div>
   </div>


   <section class="footer">
    <h4>Program:</h4>
    <p>Monday: <span style="font-style: italic;">08:30-22:00</span></p>
<p>Tuesday: <span style="font-style: italic;">08:30-22:00</span></p>
<p>Wednesday: <span style="font-style: italic;">08:30-22:00</span></p>
<p>Thursday: <span style="font-style: italic;">08:30-22:00</span></p>
<p>Friday: <span style="font-style: italic;">08:30-22:00</span></p>
<p>Saturday: <span style="font-style: italic;">10:00-22:00</span></p>
<p>Sunday: <span style="font-style: italic;">Closed</span></p>

    <p> To be up to date with the latest information, follow us on</p>
    <div class="icons">
        <i class="fa fa-facebook" ></i>
        <i class="fa fa-twitter" ></i>
        <i class="fa fa-instagram" ></i>
    </div>   
</section>

<script>
     var navLinks = document.getElementById("navLinks");
     function showMenu(){
        navLinks.style.right = "0";
     }
     function hideMenu(){
        navLinks.style.right = "-200px";
     }

</script>
</body>
</html>
