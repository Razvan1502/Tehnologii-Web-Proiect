<?php
require 'sessions.php';
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">

        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="styles/help.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <section class="sub-header">
      <?php require 'navbar.html'; ?>

      <h1>Help</h1>

    </section>

<section class="campus">
    <h1> How can you use this site ?</h1> 

    <h1> To navigate on each page on the right we have a menu <br>that contains several options: </h1>
        <ul> 
            <li> <h2>Home -> This button takes you to the homepage of the site.</h2> </li>
            <li> <h2>Menu -> This button takes you to the list of our products that are available for sale. </h2></li>
            <li> <h2>Reservation -> This button takes you to the map of the tables that are available to book. </h2></li>
            <li> <h2>Contact -> This button takes you to the contact page where you can send a message to us. </h2></li>
            <li> <h2>About -> This button takes you to the about page where you can learn more about us. In the footer of the about page you also have a button that takes you to the Project Documentation </h2></li>
            <li> <h2>Help -> This button takes you to the help page where you see the functions of the site. </h2></li>
            <li> <h2>Login -> This button takes you to the login page where you can login into your account(if you have one), register as a new customer, or reset your password(if you forgot it). </h2></li>
            <li> <h2>Cart -> This button takes you to the cart page where you see what items you have added to your basket. </h2></li>
        </ul>
    <h1> After you register as a customer, you can login (or reset your password <br> in case you forgot it) into your account and start ordering / booking.</h1>
    <h1> Enter the site, register, login, add items to cart, buy them. </h1>
    <h1> Be happy ! :) </h1>
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
