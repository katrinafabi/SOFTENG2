<?php

include 'db_connection.php'; // Include the database connection file

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username or email and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username or email exists in the database
    $query = "SELECT * FROM server WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, login successful
            // Redirect to the dashboard or any other page
            $_SESSION['server'] = $user;
            echo'Successful';
            exit();
        } else {
            // Password is incorrect
            echo 'Incorrect password. Please try again.';
        }
    } else {
        // User not found
        echo'User not found. Please check your username or email.';
    }
}

$conn->close();
?>