<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Enter Code - Password Reset</title>
    <link rel="stylesheet" href="styles/log.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="index.php"><img src="images/logo.png" alt="Tea House Iasi Logo"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="menu.php">MENU</a></li>
                    <li><a href="reservation.php">RESERVATION</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="help.php">HELP</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                    <li class="fa fa-shopping-cart"><a href="cart.php"> CART</a></li>
                </ul>
            </div>
            <i id="menu" class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <h1>Enter Code</h1>
    </section>

    <div class="wrapper">
        <?php
        if (isset($_GET['success_message'])) {
            $success_message = $_GET['success_message'];
            echo '<p class="success-message"> <strong>' . $success_message . '</strong></p>';
        }
        ?>

        <form action="reset-password.php" method="POST">
            <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
            <input type="text" placeholder="Enter the code" name="code" required>
            <button type="submit" name="submit-code">Submit</button>
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
