<?php
include 'db_connection.php';
$user_id = $user['id'];
date_default_timezone_set('Asia/Manila');

// Fetch data from the user_activity table
$query = "SELECT * FROM `user_activty` WHERE id = $user_id AND status ='Completed' ORDER BY timestamp DESC;";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["file_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["timestamp"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["file_code"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["reason"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["date_issued"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No completed request/s found</td></tr>";
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