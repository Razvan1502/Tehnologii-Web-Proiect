<?php
require '../sessions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Tea House Iasi</title>
    <link rel="stylesheet" href="../styles/reservation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="sub-header">
        <?php require 'navbar_reservations.html'; ?>

        <h1>Reservation</h1>

    </section>

    <section>
        <h3>Complete and send this form to book your reservation.</h3>
    </section>

    <section>
        <?php
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            echo '<p class="success-message" style="text-align: center;"><strong>' . $successMessage . '</strong></p>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            $errorMessage = $_SESSION['error_message'];
            echo "<p class='error-message' style='text-align: center;'><strong>$errorMessage</strong></p>";
            unset($_SESSION['error_message']);
        }
        ?>
    </section>

    <div class="reservation">

        <div class="row">
            <div class="contact-col">
                <form method="POST" action="booking.php">
                    <label for="name">Enter Your Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                    <label for="email">Enter Your Email:</label>
                    <input type="email" id="bookingemail" name="email" placeholder="Enter Your Email" required>
                    <label for="date">Enter The Date:</label>
                    <input type="date" id="date" name="date" placeholder="Enter The Date" required onchange="updateTimeOptions()">
                    <label for="time">Enter The Time:</label>
                    <select id="time" name="time" required>
                        <option value="">--Select a date first--</option>
                    </select>
                    <br></br>
                    <label for="table">Select your table number:</label>
                    <select id="table" name="table" required>
                        <option value="">--Select your table number--</option>
                        <script>
                            for (var i = 1; i <= 8; i++) {
                                document.write('<option value="' + i + '">' + i + '</option>');
                            }
                        </script>
                    </select>
                    <p></p>
                    <?php if ($isLoggedIn) { ?>
                        <button type="submit" class="hero-btn red-btn">Reserve</button>
                    <?php } else { ?>
                        <button type="submit" class="hero-btn red-btn" disabled>Login to Reserve</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <section>
        <h3>View the scheme and choose the right table.</h3>
    </section>

    <img src="../images/tables.png" alt="table" class="bordered">

    <section class="footer">
        <h4>Program:</h4>
        <p>Monday: <span style="font-style: italic;">08:30-22:00</span></p>
        <p>Tuesday: <span style="font-style: italic;">08:30-22:00</span></p>
        <p>Wednesday: <span style="font-style: italic;">08:30-22:00</span></p>
        <p>Thursday: <span style="font-style: italic;">08:30-22:00</span></p>
        <p>Friday: <span style="font-style: italic;">08:30-22:00</span></p>
        <p>Saturday: <span style="font-style: italic;">10:00-22:00</span></p>
        <p>Sunday: <span style="font-style: italic;">Closed</span></p>

        <p>To be up to date with the latest information, follow us on</p>
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

        function updateTimeOptions() {
            var dateInput = document.getElementById("date");
            var timeSelect = document.getElementById("time");
            var selectedDate = new Date(dateInput.value);
            var currentDate = new Date()
            var currentHour = currentDate.getHours();

            timeSelect.innerHTML = "";

            if (selectedDate && !isNaN(selectedDate.getTime()) && (selectedDate > currentDate || selectedDate.toDateString() === currentDate.toDateString())) {
                var startHour = selectedDate.toDateString() === currentDate.toDateString() ? currentHour : 8; 
                var endHour = 22;

                if(startHour % 2 == 1)
                    startHour++;

                for (var i = startHour; i <= endHour - 2; i += 2) {
                    var timeOption = document.createElement("option");
                    var formattedTime = formatTime(i) + " - " + formatTime(i + 2);
                    timeOption.value = formattedTime;
                    timeOption.textContent = formattedTime;
                    timeSelect.appendChild(timeOption);
                }
            } else {
                var defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "--Select a valid date--";
                timeSelect.appendChild(defaultOption);
            }
        }





        function formatTime(hour) {
            return (hour < 10 ? "0" + hour : hour) + ":00";
        }
    </script>

</body>
</html>
