<?php
require 'sessions.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="styles/about.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <section class="sub-header">
        <?php require 'navbar.html'; ?>

         <h1>About Us</h1>

    </section>


<section class="about-us">
    <h1 style="text-align:center;">The Biggest Tea House for Students</h1>
    <p>Tea House is a cozy tea shop that has become a popular spot for students since it opened in 2023. Located near a university campus, it provides a comfortable and inviting atmosphere for students to study, relax, and enjoy a delicious cup of tea. The staff at Tea House is known for their warmth and welcoming nature, making the shop a comfortable and inviting space for students. They are always happy to assist with any questions or concerns, and are knowledgeable about the various teas and snacks available.

        To make the experience even more convenient, Tea House offers the option to reserve a table in advance, allowing students to avoid waiting in long lines during peak hours. This is a popular option among busy students who need to grab a quick cup of tea between classes or study sessions.</p>
    <h1 style="text-align:center;">Meet the team</h1>

    <div class="row">
        <div class="about-col">
            <img src="images/avatar.png" alt="avatar">
            <h1  style="text-align:center;"><small>Carp Răzvan-Nicolae</small></h1>
            <p>
                I am a second-year student at the Faculty of Informatics Iasi and I have been attracted to this field 
                since I was little. I like to spend time on the computer, writing code and playing games. I also like 
                to watch football and tennis matches.</p>
        </div>

        <div class="about-col">
            <img src="images/avatar.png" alt="avatar">

            <h1  style="text-align:center;"><small>Gorgos Răzvan-Andrei</small></h1>
            <p>I am a second-year student at the Alexandru Ioan Cuza University in Iasi and I chose to study computer science
                because I have been passionate about this field since high school. I am a social and creative person who likes
                to find innovative solutions to every problem. I am always looking to learn new things, meet new people and
                acquire new skills that will be useful for me in the future.</p>
        </div>
        <div class="about-col">
            <img src="images/avatar.png" alt="avatar">
            <h1  style="text-align:center;"><small>Bărbulescu Robert-Cristian</small></h1>
            <p>I am a second-year student at the Faculty of Informatics in Iasi because I have always been attracted to technology.
             Since I was little, I liked cars and computers and was fascinated by them, something valid even today. 
            My passions are chess, tennis and traveling. I like to discover new people, new cultures, new traditions.</p>
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
<p></p>

<a href="documentatie.html" class="hero-btn">Project Documentation</a>

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