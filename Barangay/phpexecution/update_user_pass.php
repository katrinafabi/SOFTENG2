<?php
require_once("db_connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate current password
    $user_email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password meets the required format criteria
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $new_password)) {
        // New password does not meet the format criteria
        echo "New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } elseif ($new_password === $current_password) {
        // New password is the same as the current password
        echo "New password cannot be the same as the current password.";
    } elseif ($new_password !== $confirm_password) {
        // New password and confirm password do not match
        echo "New password and confirm password do not match!";
    } else {
        // Query to retrieve hashed password from the database based on user email
        $sql = "SELECT password FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify if current password matches the hashed password from the database
        if (!password_verify($current_password, $hashed_password)) {
            // Current password is incorrect
            echo "Current password is incorrect!";
        } else {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in the database
            $update_sql = "UPDATE user SET password = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $hashed_new_password, $user_email);

            // Execute the update statement
            if ($update_stmt->execute()) {
                // Password updated successfully
                echo "Successful";
            } else {
                // Error updating password
                echo "Error updating password: " . $update_stmt->error;
            }
        }
    }
} else {
    // Handle the case where form is not submitted
    echo "Form not submitted!";
}

// Close the database connection
$conn->close();
?>