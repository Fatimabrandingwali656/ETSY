<?php
$host = "localhost";
$dbname = "dbhyxkncm8vuae";
$username = "u6rb6bqvkbkar";
$password = "qvtogj3tddb6";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
