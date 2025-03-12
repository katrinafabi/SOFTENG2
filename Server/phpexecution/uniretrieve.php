<?php
// Start a session at the very beginning
session_start();

// Check if the user is logged in
if (!isset($_SESSION['server'])) {
    echo '<script>';
    echo 'alert("Session Time-out, Redirecting to login page.");';
    echo 'window.location.href = "/Server/server-login.php";';
    echo '</script>';
    exit();
}

$user = $_SESSION['server'];


?>