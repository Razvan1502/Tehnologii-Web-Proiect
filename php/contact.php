<?php
require 'sessions.php';
?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="styles/contact.css">
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
            <i class="fa fa-times"  onclick="hideMenu()"></i>
                <ul>
                    <?php if ($admin) { ?>
                        <li><a href="admin.php">ADMIN</a></li>
                    <?php } ?>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="menu.php">MENU</a></li>
                    <li><a href="reservation.php">RESERVATION</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="help.php">HELP</a></li>
                    
                    <?php if ($isLoggedIn) { ?>
                        <li><a href="logout.php">LOGOUT</a></li>
                    <?php } else { ?>
                        <li><a href="login.php">LOGIN</a></li>
                    <?php } ?>

                    <li class="fa fa-shopping-cart"><a href="cart.php"> CART</a></li>
                </ul>
                
           </div>
           <i id="menu" class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

      <h1>Contact Us</h1>

    </section>

    <?php


    if (isset($_SESSION['success_message'])) {
        $successMessage = $_SESSION['success_message'];
        echo '<p class="success-message" style="text-align: center;"><strong>' . $successMessage . '</strong></p>';
        unset($_SESSION['success_message']);
    }


    if (isset($_SESSION['error_message'])) {
        $errorMessage = $_SESSION['error_message'];
        echo "<p class='error-message'>$errorMessage</p>";
        unset($_SESSION['error_message']);
    }
    ?>

<div class="location">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2712.185779777559!2d27.572647215469093!3d47.173799079158385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb6227e846bd%3A0x193e4b6864504e2c!2sFacultatea%20de%20Informatic%C4%83!5e0!3m2!1sro!2sro!4v1680871550272!5m2!1sro!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<section class="contact-us">
    <div class="row">
        <div class="contact-col">
            <div>
                <i class="fa fa-home"></i>
                <div>
                    <h5>Strada General Henri Mathias Berthelot Nr. 16, Iași 700259</h5>
                </div>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <div>
                    <h5>Nr. telefon:</h5>
                    <p>+40 732 382 853</p>
                </div>
            </div>
        </div>
        <div class="contact-col">
            <form method="post" action="contact-php.php">
                <input type="text" name="name" placeholder="Enter Your Name" required>
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <input type="text" name="request" placeholder="Enter Your Request" required>
                <textarea name="message" rows="8" placeholder="Your Message" required></textarea>
                <button type="submit" class="hero-btn red-btn">Send The Message</button>
            </form>
        </div>     
    </div>
</section>


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
