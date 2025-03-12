<?php
include 'db_connection.php'; // Include the database connection file

session_start();

// Set the default timezone to Philippines
date_default_timezone_set('Asia/Manila');
$current_timestamp = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = $_SESSION['user'];
    $user_id = $user['id'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $fullname = $_POST['fullname'];
    $suffix = isset($_POST['suffix']) ? $_POST['suffix'] : ''; // Check if suffix is set
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $purpose = $_POST['purpose'];
    $email = $_POST['email'];
    $b_name = $_POST['sb_name'];

    // Function to check if there's an existing incomplete record
    function checkExistingIncompleteRecord($conn, $user_id, $file_code) {
        $check_query = "SELECT status FROM user_activty WHERE id = ? AND file_code = ? AND status != 'Completed'";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("is", $user_id, $file_code);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    // Check for "First Time Job Seeker"
    if ($title === "First Time Job Seeker") {
        if (checkExistingIncompleteRecord($conn, $user_id, "First Time Job Seeker")) {
        echo 'Notice: You have already requested the "First Time Job Seeker". Maximum of one (1) each person is allowed to request this file';
        exit();
        }
    }

    // Check for "Barangay Clearance"
    if ($title === "Barangay Clearance") {
        if (checkExistingIncompleteRecord($conn, $user_id, "Barangay Clearance")) {
            echo 'Notice: You have already requested the "Barangay Clearance" certificate and is still in process, Try again later!';
            exit();
        }
    }
    
    if ($title === "Business Permit") {
        if (checkExistingIncompleteRecord($conn, $user_id, "Business Permit")) {
            echo 'Notice: You have already requested the "Business Permit" certificate and is still in process, Try again later!';
            exit();
        }
    }
    
     if ($title === "Certificate Of Indigency") {
        if (checkExistingIncompleteRecord($conn, $user_id, "Certificate Of Indigency")) {
            echo 'Notice: You have already requested the "Certificate Of Indigency" certificate and is still in process, Try again later!';
            exit();
        }
    }

    // Insert query with the correct timestamp variable
    $insert_query = "INSERT INTO user_activty (id, email, name, suffix, file_code, status, timestamp, reason, address, birthdate, age, b_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

    // Bind parameters
    $stmt->bind_param("isssssssssss", $user_id, $email, $fullname, $suffix, $title, $status, $current_timestamp, $purpose, $address, $dob, $age, $b_name);

    // Execute the statement
    if ($stmt->execute()) {
        $activity_message = "$fullname Requested the Certificate '$title'.";
        $forwho = "admin"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $user_id, $activity_message, $forwho, $current_timestamp);
        $activity_stmt->execute();
        $activity_stmt->close();
        
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