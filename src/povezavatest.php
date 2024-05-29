<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "priznanja";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "POVEZAVA USPEŠNA ✅";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<a href='home.php'>Domov</a>";
?>