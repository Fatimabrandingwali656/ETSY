<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Remove item from cart
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE id = '$cart_id'");
    header("Location: cart.php");
    exit();
}

// Fetch cart items
$result = $conn->query("SELECT cart.id as cart_id, products.* FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = '$user_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f8f8f8; }
        h2 { color: #ff6600; }
        .cart-container { width: 60%; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); }
        .cart-item { display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #ddd; }
        .cart-item img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
        .remove { background: red; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; }
        .remove:hover { background: darkred; }
        .checkout { background: green; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-top: 10px; display: inline-block; }
        .checkout:hover { background: darkgreen; }
    </style>
</head>
<body>

    <h2>Your Shopping Cart</h2>
    <a href="index.php">← Continue Shopping</a>

    <div class="cart-container">
        <?php
        if ($result->num_rows > 0) {
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $total += $row['price'];
                echo "<div class='cart-item'>
                        <img src='{$row['image']}' alt='{$row['name']}'>
                        <p>{$row['name']} - \${$row['price']}</p>
                        <a href='cart.php?remove={$row['cart_id']}' class='remove'>Remove</a>
                      </div>";
            }
            echo "<h3>Total: \${$total}</h3>";
            echo "<a href='checkout.php' class='checkout'>Proceed to Checkout</a>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>

</body>
</html>
