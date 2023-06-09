<?php
require '../sessions.php';
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Tea House Iasi</title>
        <link rel="stylesheet" href="../styles/cart.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section class="sub-header">
            <?php require 'navbar_menu_order.html'; ?>
    
            <h1>Shopping Cart</h1>
        </section>
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
       

        <?php

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        $totalPrice = 0;
        $itemQuantities = array();
        $desiredProducts = array();

        foreach ($_SESSION['cart'] as $item) {
            $name = $item['name'];
            $price = $item['price'];

            if (isset($item['quantity'])) { //verifica dacă produsul are o cantitate specificata
                $quantity = $item['quantity'];
            } else {
                $quantity = 1;
            }

            if (!isset($desiredProducts[$name])) { //Se verifica dacă produsul a fost adaugat anterior în array
                $desiredProducts[$name] = 0;
            }

            $desiredProducts[$name] += $quantity;
            $subtotal = $price * $quantity;
            $totalPrice += $subtotal;
        }
        } else {
        $desiredProducts = array();
        $totalPrice = 0;
        }
        echo('<br>');

        ?>




</table>
<div class="cart-info">
<table>
    <?php foreach ($desiredProducts as $name => $quantity) {
        if ($quantity > 0) {
            // Gasim produsele in vectorul $_SESSION['cart']
            $product = null;
            foreach ($_SESSION['cart'] as $cartProduct) {
                if ($cartProduct['name'] === $name) {
                    $product = $cartProduct;
                    break;
                }
            }

            if ($product) {
                $price = floatval($product['price']);
                $subtotal = $price * $quantity;
    ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="../images/<?php echo strtolower(str_replace(' ', '', $name)); ?>.png" alt="<?php echo $name; ?>">
                            <div>
                                <p><?php echo $name; ?></p>
                                <small>Price: <?php echo $price; ?> lei</small>
                                <br>
                                <a href="" class="remove-btn" onclick="removeProduct('<?php echo $name; ?>')">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td><input type="text" name="quantity" value="<?php echo $quantity; ?>" readonly></td>
                    <td id="<?php echo strtolower(str_replace(' ', '', $name)); ?>-subtotal"><?php echo $subtotal; ?> lei</td>
                </tr>
    <?php
            }
        }
    }
    ?>
</table>
</div>

<div class="total-price">
<table>
    <tr>
        <td>Subtotal</td>
        <td><?php echo $totalPrice; ?> lei</td>
    </tr>
    <tr>
        <td>Tax</td>
        <td><?php echo $totalPrice * 0.1; ?> lei</td>
    </tr>
    <?php $_SESSION['total_price'] = $totalPrice + $totalPrice * 0.1;; ?>
    <tr>
        <td>Total</td>
        <td><?php echo $totalPrice + $totalPrice * 0.1; ?> lei</td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="order-form">
            <button class="order-button" onclick="submitOrder()">Order</button>
            </div>
        </td>
    </tr>
</table>
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
    
    function submitOrder() {
        // Verificam daca userul este logat
        <?php if ($isLoggedIn) { ?>
            // Verificam daca cosul este gol
            <?php if (!empty($cartItems)) { ?>
                // functia AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'submit_order.php', true); //Se deschide o conexiune către fișierul "submit_order.php" de pe server folosind metoda HTTP POST.
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Se setează antetul "Content-Type" pentru a specifica că datele trimise sunt de tip "application/x-www-form-urlencoded"
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) { //se verifică dacă readyState este 4 (cerere finalizată) și status este 200 (răspunsul a fost de succes).
                        alert(xhr.responseText);

                        window.location.href = 'cart.php';  // redirectam daca s-a efectuat comanda
                    }
                };
                xhr.send();
            <?php } else { ?>
                alert('Your cart is empty. Please add items to your cart before submitting the order.');
            <?php } ?>
        <?php } else { ?>
            alert('Please log in to submit the order.');
        <?php } ?>
    }



    function removeProduct(productName) {
        // functia AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'remove_product.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
            // stergem acel rand din tabela si de pe ecran
            var productRow = document.getElementById(productName + '-row');
            productRow.parentNode.removeChild(productRow);
            }
        };

        xhr.send('product=' + encodeURIComponent(productName));
    }

    // Buton care verifica cand se apasa pe butonul order
    var orderButton = document.getElementById('submitOrderBtn');
    orderButton.addEventListener('click', function() {
        submitOrder();
    });
</script>

</script>
</body>
</html>
