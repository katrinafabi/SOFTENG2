<?php
include 'db_connection.php';
$user_id = $user['id'];
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accept"])) {
    // Get the details of the row to update
    $id = intval($_POST["id"]);
    $reason = $conn->real_escape_string($_POST["reason"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $timestamp = $conn->real_escape_string($_POST["timestamp"]);
    $name = $conn->real_escape_string($_POST["name"]);
    $file_id = $conn->real_escape_string($_POST["file_id"]);
    $status = $conn->real_escape_string($_POST["status"]);

    // Fetch the file_code for the updated row
    $fetch_query = "SELECT file_code FROM user_activty WHERE id = $id";
    $fetch_result = $conn->query($fetch_query);
    $file_code = "";
    if ($fetch_result && $fetch_result->num_rows > 0) {
        $row = $fetch_result->fetch_assoc();
        $file_code = $row["file_code"];
    }

    // Update the status to "Accepted" and set notified to 0 in the database with additional conditions
    $delete_query = "DELETE FROM `user_activty` WHERE id = $id AND file_id = $file_id";
                 
    // Perform the delete query
    if ($conn->query($delete_query) === TRUE) {
        // Success message
        echo "<script>alert('File code " . htmlspecialchars($file_code) . " from user ID " . htmlspecialchars($id) . " has been successfully deleted.');
              window.location.href = '/Barangay/dashboard.php';
              </script>";
    } else {
        // Error message
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Fetch data from the user_activity table
$query = "SELECT * FROM `user_activty` WHERE id = $user_id AND status = 'Pending' ORDER BY timestamp DESC;";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["timestamp"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["file_code"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["reason"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        
        // Add button based on status
        if ($row["status"] == "Pending") {
            // Display form with Accept button
            echo "<td>
                    <form method='post' onsubmit='return confirmAccept()'> <!-- Add onsubmit attribute -->
                        <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                        <input type='hidden' name='reason' value='" . htmlspecialchars($row["reason"]) . "'>
                        <input type='hidden' name='status' value='" . htmlspecialchars($row["status"]) . "'>
                        <input type='hidden' name='timestamp' value='" . htmlspecialchars($row["timestamp"]) . "'>
                        <input type='hidden' name='name' value='" . htmlspecialchars($row["name"]) . "'>
                        <input type='hidden' name='file_id' value='" . htmlspecialchars($row["file_id"]) . "'>
                        <button type='submit' name='accept'>CANCEL</button>
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
        return confirm("Are you sure you want to cancel this request?");
    }
</script>