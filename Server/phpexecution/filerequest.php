<?php
include 'db_connection.php'; // Include the database connection file

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = $_SESSION['user'];
    $user_id = $user['id'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $fullname = $_POST['fullname'];
    $suffix = $_POST['suffix'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $purpose = $_POST['purpose'];
    $timestamp = date('Y-m-d H:i:s');

    // Check if the request is for "First Time Job Seeker"
    if ($title === "First Time Job Seeker") {
        // Check if there's already a record for this user with the same title
        $check_query = "SELECT COUNT(*) FROM user_activty WHERE id = ? AND file_code = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("is", $user_id, $title);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            // Record already exists
            echo 'Notice: You can only request for "First Time Job Seeker" certificate once for each user.';
            exit();
        }
    }

    // Insert query
    $insert_query = "INSERT INTO user_activty (id, name, file_code, status, timestamp, reason, address, birthdate, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

    // Bind parameters
    $stmt->bind_param("issssssss", $user_id, $fullname, $title, $status, $timestamp, $purpose, $address, $dob, $age);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Successful';
        exit();
    } else {
        echo 'Error: ' . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
