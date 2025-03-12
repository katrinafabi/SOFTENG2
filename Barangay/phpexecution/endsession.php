<?php

session_start();

$_SESSION = array();

session_destroy();

header("Location: https://barangay-433-zone-44.000webhostapp.com/Barangay/login.php");

exit();

?>