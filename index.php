<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle Add to Cart
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')");
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etsy Clone</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f8f8f8; }
        h1 { color: #ff6600; }
        .container { width: 80%; margin: auto; }
        .product { display: inline-block; width: 200px; background: white; padding: 15px; margin: 10px; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); }
        .product img { width: 100%; height: 150px; object-fit: cover; border-radius: 5px; }
        .product h3 { font-size: 18px; margin: 5px 0; }
        .product p { font-size: 16px; color: #555; }
        .add-to-cart { background: #ff6600; color: white; padding: 8px; text-decoration: none; display: block; margin-top: 5px; border-radius: 5px; }
        .add-to-cart:hover { background: #cc5500; }
        .nav { margin-bottom: 20px; }
        .nav a { text-decoration: none; padding: 10px 15px; background: #ff6600; color: white; border-radius: 5px; margin: 5px; }
    </style>
</head>
<body>

    <h1>Welcome to Etsy Clone</h1>
    <div class="nav">
        <a href="cart.php">🛒 View Cart</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <?php
        $result = $conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <img src='{$row['image']}' alt='{$row['name']}'>
                    <h3>{$row['name']}</h3>
                    <p>\${$row['price']}</p>
                    <a href='index.php?add={$row['id']}' class='add-to-cart'>Add to Cart</a>
                  </div>";
        }
        ?>
    </div>

</body>
</html>
