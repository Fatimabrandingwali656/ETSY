<?php include 'db.php'; session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $conn->query("INSERT INTO products (name, description, price, image) VALUES ('$name', '$desc', '$price', '$image')");
    echo "Product added!";
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br>
    Description: <input type="text" name="desc" required><br>
    Price: <input type="number" name="price" required><br>
    Image URL: <input type="text" name="image" required><br>
    <button type="submit">Add Product</button>
</form>
