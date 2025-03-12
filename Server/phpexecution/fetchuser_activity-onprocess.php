<?php
include 'db_connection.php';

// Fetch data from the user_activity table
$query = "SELECT * FROM `user_activty` WHERE status ='In Process' ORDER BY timestamp DESC;";
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
        if ($row["status"] == "In Process") {
            // Display form with Accept button
            $formAction = $row["file_code"] == "First Time Job Seeker" 
                ? 'https://barangay-433-zone-44.000webhostapp.com/Server/editfile1.php' 
                : 'https://barangay-433-zone-44.000webhostapp.com/Server/editfile.php';
            echo "<td>
                    <form action='$formAction' method='post'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                        <input type='hidden' name='timestamp' value='" . htmlspecialchars($row["timestamp"]) . "'>
                        <input type='hidden' name='name' value='" . htmlspecialchars($row["name"]) . "'>
                        <input type='hidden' name='file_code' value='" . htmlspecialchars($row["file_code"]) . "'>
                        <input type='hidden' name='reason' value='" . htmlspecialchars($row["reason"]) . "'>
                        <input type='hidden' name='age' value='" . htmlspecialchars($row["age"]) . "'>
                        <input type='hidden' name='address' value='" . htmlspecialchars($row["address"]) . "'>
                        <input type='hidden' name='birthdate' value='" . htmlspecialchars($row["birthdate"]) . "'>
                        <input type='hidden' name='status' value='" . htmlspecialchars($row["status"]) . "'>
                        <input type='hidden' name='suffix' value='" . htmlspecialchars($row["suffix"]) . "'>
                        <input type='hidden' name='file_id' value='" . htmlspecialchars($row["file_id"]) . "'>
                        <input type='hidden' name='email' value='" . htmlspecialchars($row["email"]) . "'>
                        <button type='submit' name='check'>CHECK</button>
                    </form>
                  </td>";
        } else {
            echo "<td></td>"; // No button for other statuses
        }
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No in process requests found</td></tr>";
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