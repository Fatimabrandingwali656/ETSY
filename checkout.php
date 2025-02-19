<?php include 'db.php'; session_start();

$conn->query("DELETE FROM cart WHERE user_id = '{$_SESSION['user_id']}'");
echo "Thank you for your purchase!";
?>
