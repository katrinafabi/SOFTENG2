<?php
require_once('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $timestamp = $_POST['timestamp'];
    $file_id = $_POST['file_id'];

    // Prepare the delete query
    $query = "DELETE FROM user_activty 
              WHERE id = ? AND file_id = ?";
    
    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ii', $id, $timestamp, $file_code);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Close the statement
            $stmt->close();
            // Close the database connection
            $conn->close();
            
            echo "<script>
                    setTimeout(function() {
                        alert('Request deletion successful');
                        window.location.href = '/Barangay/dashboard.php';
                    }, 2000);
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
