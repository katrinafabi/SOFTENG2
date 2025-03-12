<?php
include 'db_connection.php';

date_default_timezone_set('Asia/Manila');
$current_timestamp = date('Y-m-d H:i:s');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accept"])) {
    // Get the details of the row to update
    $id = intval($_POST["id"]);
    $file_id = intval($_POST["file_id"]);
    $reason = $conn->real_escape_string($_POST["reason"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $timestamp = $conn->real_escape_string($_POST["timestamp"]);
    $name = $conn->real_escape_string($_POST["name"]);
    $title = $conn->real_escape_string($_POST["file_code"]);

    // Fetch the file_code for the updated row
    $fetch_query = "SELECT file_code FROM user_activty WHERE id = $id";
    $fetch_result = $conn->query($fetch_query);
    $file_code = "";
    if ($fetch_result && $fetch_result->num_rows > 0) {
        $row = $fetch_result->fetch_assoc();
        $file_code = $row["file_code"];
    }

    // Update the status to "Accepted" and set notified to 0 in the database with additional conditions
    $update_query = "UPDATE user_activty SET status = 'In Process', notified = 0 
                     WHERE id = $id AND status = '$status' AND timestamp = '$timestamp' AND reason = '$reason' AND name = '$name'";
    if ($conn->query($update_query) === TRUE) {
        $activity_message = "Your request for '$title', has been Accepted.";
        $forwho = "user"; // Static value for forwho
        $activity_insert_query = "INSERT INTO activity_log (user_id, message, forwho, timestamp) VALUES (?, ?, ?, ?)";
        $activity_stmt = $conn->prepare($activity_insert_query);
        $activity_stmt->bind_param("isss", $id, $activity_message, $forwho, $current_timestamp);
        $activity_stmt->execute();
        $activity_stmt->close();
        
        echo 'Successful';
        // Success message
        echo "<script>alert('File code " . htmlspecialchars($file_code) . " from user ID " . htmlspecialchars($id) . " status updated successfully.');
        window.location.href = '/Server/server-dashboard-onprocess.php';
        </script>";
    } else {
        // Error message
        echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
    }
}

// Fetch data from the user_activity table
$query = "SELECT * FROM `user_activty` WHERE status ='Pending' ORDER BY timestamp DESC;";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["file_code"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["reason"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["timestamp"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        
        // Add button based on status
        if ($row["status"] == "Pending") {
            // Display form with Accept button
            echo "<td>
                    <form method='post' onsubmit='return confirmAccept()'> <!-- Add onsubmit attribute -->
                        <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                        <input type='hidden' name='file_id' value='" . htmlspecialchars($row["file_id"]) . "'>
                        <input type='hidden' name='file_code' value='" . htmlspecialchars($row["file_code"]) . "'>
                        <input type='hidden' name='reason' value='" . htmlspecialchars($row["reason"]) . "'>
                        <input type='hidden' name='status' value='" . htmlspecialchars($row["status"]) . "'>
                        <input type='hidden' name='timestamp' value='" . htmlspecialchars($row["timestamp"]) . "'>
                        <input type='hidden' name='name' value='" . htmlspecialchars($row["name"]) . "'>
                        <button type='submit' name='accept'>ACCEPT</button>
                    </form>
                  </td>";
        } else {
            echo "<td></td>"; // No button for other statuses
        }
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No request/s found</td></tr>";
}

// Close the database connection
$conn->close();
?>

<!-- Add JavaScript code for confirmation -->
<script>
    function confirmAccept() {
        return confirm("Are you sure you want to accept this request?");
    }
</script>