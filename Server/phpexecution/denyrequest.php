<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $file_id = $_POST['file_id'];
    $deny_reason = $_POST['denyReason'];
    $title = $_POST['title'];
    date_default_timezone_set('Asia/Manila');
    $current_timestamp = date('Y-m-d H:i:s');
    $status = 'Denied';

    // Update the status in the database
    $stmt = $conn->prepare("UPDATE user_activty SET status = ?, date_denied = ?, deny_reason = ? WHERE id = ? AND file_id = ?");
    $stmt->bind_param('sssii', $status, $current_timestamp, $deny_reason, $id, $file_id);

    if ($stmt->execute()) {
        $activity_message = "Your request for '$title', has been Denied.";
        $forwho = "user"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_timestamp);
        $activity_stmt->execute();
        $activity_stmt->close();
        
        echo "<script>
                setTimeout(function() {
                    alert('Request Denied');
                    window.location.href = '/Server/server-dashboard-denied.php';
                }, 1000);
              </script>";
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>