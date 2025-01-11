<?php
$servername = "localhost"; // Replace with your database server (e.g., localhost or an IP)
$username = "admin"; // Replace with your database username
$password = "password"; // Replace with your database password
$dbname = "blog_admin_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$conn->close();
?>
