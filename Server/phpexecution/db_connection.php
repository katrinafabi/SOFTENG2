<?php
$servername = "localhost";
$username = "id22155133_barangay";
$password = "@Zak09232803611";
$dbname = "id22155133_barangay433zone44";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>