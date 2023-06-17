<?php
require '../sessions.php';

$host = "localhost";
$username = "root";
$password = "";
$database = "tw";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM shop_products";
$result = $mysqli->query($query);

if ($result) {
    $products = []; //vectorul in care avem produsele din BD
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $result->free();
} else {
    die("Error retrieving products: " . $mysqli->error);
}

$mysqli->close();

require 'comanda_din_URL.php';   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">

        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="../styles/meniu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <section class="sub-header">
        <?php require 'navbar_menu_order.html'; ?>

        <h1>Menu</h1>

    </section>




<section class="produse">
    <h1> What can you buy from us?</h1> 
    <p>Looking for a delicious and refreshing way to indulge your senses? Look no further than our Tea House menu, featuring a wide selection of premium teas and tasty treats to satisfy your cravings.</p>

<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "tw";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT * FROM shop_products";
    $result = mysqli_query($mysqli, $query);

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    mysqli_close($mysqli);
?>

<div class="row">
    <?php $count = 0; ?>
    <?php foreach ($products as $product) { ?>
        <?php if ($count % 3 === 0) { ?>
            </div><div class="row">
        <?php } ?>
        <div class="produse-col">
            <img src="../images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
            <div class="layer">
                <h3><?php echo $product['product_name']; ?></h3>
                <h4><?php echo $product['product_price']; ?> lei</h4>
                <a href="#" class="cos-btn fa fa-shopping-basket" onclick="addToCart('<?php echo $product['product_name']; ?>', <?php echo $product['product_price']; ?>)"></a>
            </div>
        </div>
        <?php $count++; ?>
    <?php } ?>
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

     function addToCart(name, price) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
                updateCartCount();
            }
        };
        xhr.send("name=" + name + "&price=" + price);
    }

    function updateCartCount() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_cart_count.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var cartCount = document.getElementById("cartCount");
                cartCount.innerText = xhr.responseText; // Punem in partea dreapta a cosului numarul de ceaiuri din cos
            }
        };
        xhr.send();
    }
</script>


</body>     
</html>
