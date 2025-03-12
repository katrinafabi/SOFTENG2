<?php
// Start a session at the very beginning
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    echo '<script>';
    echo 'alert("Session Time-out, Redirecting to login page.");';
    echo 'window.location.href = "https://barangay-433-zone-44.000webhostapp.com/Barangay/login.php";';
    echo '</script>';
    exit();
}

// Retrieve user data from the session
$user = $_SESSION['user'];
?>