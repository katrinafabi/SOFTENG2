<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['cmpassword'];

    // Validate password format
    if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/', $password)) {
        echo 'Password must be 8 characters long, contain at least one symbol, one uppercase letter, and one lowercase letter.';
        exit;
    }

    if ($password !== $confirm_password) {
        echo 'New Password and Current Password do not match.';
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    include 'db_connection.php';

    // Verify the token again and update the password
    $sql = "SELECT email FROM password_reset WHERE token = ? AND expires >= ?";
    $stmt = $conn->prepare($sql);

    $current_time = time(); // Store the result of time() in a variable
    $stmt->bind_param("si", $token, $current_time); // Pass the variable by reference

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $sql = "UPDATE user SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);

        // Pass variables by reference to bind_param
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            // Delete the token from the database
            $sql = "DELETE FROM password_reset WHERE token = ?";
            $stmt = $conn->prepare($sql);

            // Pass the token as a variable by reference
            $stmt->bind_param("s", $token);

            $stmt->execute();
            echo 'Successful';
        } else {
            echo 'Failed to reset password, please try again.';
        }
    } else {
        echo 'This reset link has expired or is invalid.';
    }

    $stmt->close();
    $conn->close();
}
?>