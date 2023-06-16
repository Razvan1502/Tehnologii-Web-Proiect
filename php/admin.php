<?php
session_start(); 


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $isAdminLoggedIn = true;
} else {
    $isAdminLoggedIn = false;
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

if (isset($_SESSION['admin_in']) && $_SESSION['admin_in'] === true) {
    $admin = true;
} else {
    $admin = false;
}


$servername='localhost';
$username='root';
$password='';
$dbname = "tw";


$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
    die('Could not Connect MySql Server:' .mysql_error());
}   


$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);


$products = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <title>Tea House Iasi</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<section class="header">
    <nav>
        <a href="index.php"><img src="images/logo.png" alt="Tea House Iasi Logo"></a>
        <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hideMenu()"></i>
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
                <li class="fa fa-shopping-cart"><a href="cart.php">CART</a></li>
            </ul>
        </div>
        <i id="menu" class="fa fa-bars" onclick="showMenu()"></i>
    </nav>

    <div class="text-box">
        <h1>Admin Panel</h1>
    </div>
</section>

<?php if ($isAdminLoggedIn) { ?>
    <section class="admin-panel">
        <h1>
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="success-message" style="text-align: center;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php } ?>
        <?php if (isset($_SESSION['error_message'])) { ?>
            <div class="error-message" style="text-align: center;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php } ?>
        </h1>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td>
                        <form action="update_quantity.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
<?php } ?>

<?php if ($isAdminLoggedIn) { ?>
        <section class="admin-panel">
            <h1>
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="success-message" style="text-align: center;"><?php echo $_SESSION['message'];
                                                                                    unset($_SESSION['message']); ?></div>
                <?php } ?>
                <?php if (isset($_SESSION['error_message'])) { ?>
                    <div class="error-message" style="text-align: center;"><?php echo $_SESSION['error_message'];
                                                                                unset($_SESSION['error_message']); ?></div>
                <?php } ?>
            </h1>
            <form method="POST" action="export_json.php">
                <label for="selected_date">Select a date:</label>
                <input type="date" id="selected_date" name="selected_date">
                <button type="submit" name="export">Export to JSON</button>
            </form>
            <br></br>
            <form method="POST" action="export_xml.php">
                <label for="selected_date">Select a date:</label>
                <input type="date" id="selected_date" name="selected_date">
                <button type="submit" name="export_xml">Export to XML</button>
        </form>
    </section>
<?php } else { ?>
    <section style="text-align: center; border-top="10px"; class="admin-panel">
        <h1>Access Denied</h1>
        <p>You need to be logged in as an admin to access this page.</p>
    </section>
    <?php } ?>

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
        <i class="fa fa-facebook"></i>
        <i class="fa fa-twitter"></i>
        <i class="fa fa-instagram"></i>
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
