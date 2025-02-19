<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        echo "Email already registered. Try logging in.";
    } else {
        $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        echo "Registration successful! <a href='login.php'>Login here</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Etsy Clone</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; text-align: left; margin-top: 50px; }
        input { display: block; width: 100%; padding: 8px; margin-bottom: 10px; }
        button { background: #ff6600; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { background: #cc5500; }
    </style>
</head>
<body>

    <h2>Signup</h2>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>
