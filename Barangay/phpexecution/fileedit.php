<?php
require_once('db_connection.php');

date_default_timezone_set('Asia/Manila');
$current_timestamp = date('Y-m-d H:i:s');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $file_id = $_POST['file_id'];
    $status = 'Pending';
    $date_denied = null;
    $deny_reason = '';

    // Prepare the update query to update only reason and timestamp
    $query = "UPDATE user_activty 
              SET status = ?, timestamp = ?, date_denied = ?, deny_reason = ?
              WHERE id = ? AND file_id = ?";
    
    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ssssii', $status, $current_timestamp,  $date_denied, $deny_reason, $id, $file_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            // Close the database connection
            $conn->close();
            
            // Show alert message
            echo "<script>
                       alert('Request Update successful');
                       window.location.href = '/Barangay/dashboard.php';
                  </script>";
            exit; // Ensure no further code execution after redirection
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>