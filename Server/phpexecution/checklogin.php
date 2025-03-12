<?php

session_start();

if (isset($_SESSION['server'])) {
    echo '<script>';
    echo 'alert("Account is already logged-in!");';
    echo 'window.location.href = "/Server/server-dashboard.php";';
    echo '</script>';
    exit();
}

?>