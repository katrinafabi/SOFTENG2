<?php

include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $confirmPassword = $_POST['cmpassword'];

    // Perform validation, e.g., password match
    if ($pass !== $confirmPassword) {
        echo "Passwords and Confirm Password doesn't match!";
        exit(); // Stop further execution
    }
    
    // Check if username format is 8 characters long
    if (strlen($username) !== 8) {
        echo "Username must be 8 characters long!";
        exit(); // Stop further execution
    }

    // Check if password format is 8 characters long and has required characters
    if (strlen($pass) !== 8 || !preg_match("/[A-Z]/", $pass) || !preg_match("/[a-z]/", $pass) || !preg_match("/[0-9]/", $pass) || !preg_match("/[^a-zA-Z0-9]/", $pass)) {
        echo "Password must be 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one symbol!";
        exit(); // Stop further execution
    }

    // Check if the count of the username is = 2, maximum number of accounts for admin reached
    $stmt = $conn->prepare("SELECT COUNT(*) FROM server WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count >= 2) {
        echo "Maximum number of accounts for admin reached!";
        exit(); // Stop further execution
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM server WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($existing);
    $stmt->fetch();
    $stmt->close();

    if ($existing > 0) {
        echo "Username already exists!";
        exit(); // Stop further execution
    }

    // Hash the password
    $password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO server (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>