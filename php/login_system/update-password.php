<?php
require '../sessions.php';
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Update Password</title>
    <link rel="stylesheet" href="../styles/log.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="sub-header">
        <?php require 'navbar_login.html'; ?>

        <h1>Update Password</h1>
    </section>
    <div class="wrapper">
        <form action="process-update-password.php" method="POST">
            <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
                    header("Location: ../index.php");
                    
                if (isset($_SESSION['error_message'])) {
                    $errorMessage = $_SESSION['error_message'];
                    echo "<p class='error-message' style='text-align: center;'><strong>$errorMessage</strong></p>";
                    unset($_SESSION['error_message']);
                }
            ?>
            <input type="text" name="email" value="<?php if(isset($_SESSION['reset_email']))echo $_SESSION['reset_email']; ?>">
            <input type="password" placeholder="Enter new password" name="password" required>
            <input type="password" placeholder="Confirm new password" name="confirm_password" required>
            <button type="submit" name="submit" >Update Password</button>
        </form>
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

        <p>To stay up to date with the latest information, follow us on:</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-instagram"></i>
        </div>
    </section>

    <script>
        var navLinks = document.getElementById("navLinks");
        function showMenu() {
            navLinks.style.right = "0";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>
</body>
</html>
