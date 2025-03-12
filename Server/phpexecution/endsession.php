<?php

session_start();

// Unset the specific session variable
unset($_SESSION['server']);

// Optionally, you can destroy the session entirely if you need to
// session_destroy();

header("Location: https://barangay-433-zone-44.000webhostapp.com/Server/server-login.php");

exit();

?>