<?php
include 'db_connection.php';

date_default_timezone_set('Asia/Manila');

// Fetch data from the user_activity table
$query = "SELECT * FROM `user_activty` WHERE status ='For Pickup' ORDER BY timestamp DESC;";
$result = $conn->query($query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["reference_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["file_code"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["timestamp"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        
        // Add button based on status
        if ($row["status"] == "For Pickup") {
            // Display form with Accept button
            
            $formAction = '';
            if ($row["file_code"] == "First Time Job Seeker") {
                $formAction = 'phpexecution/for_forms/for_first_time_job_seeker.php';
            } elseif ($row["file_code"] == "Barangay Clearance") {
                $formAction = 'phpexecution/for_forms/for_barangay_clearance.php';
            } elseif ($row["file_code"] == "Business Permit") {
                $formAction = 'phpexecution/for_forms/for_business_permit.php';
            } elseif ($row["file_code"] == "Certificate of Indigency") {
                $formAction = 'phpexecution/for_forms/for_certificate_of_indigency.php';
            }
           echo "<td>
                    <form action='$formAction' method='post' onsubmit='return confirmAccept(this)'> <!-- Add target='_blank' and onsubmit attribute -->
                        <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                        <input type='hidden' name='reason' value='" . htmlspecialchars($row["reason"]) . "'>
                        <input type='hidden' name='status' value='" . htmlspecialchars($row["status"]) . "'>
                        <input type='hidden' name='timestamp' value='" . htmlspecialchars($row["timestamp"]) . "'>
                        <input type='hidden' name='name' value='" . htmlspecialchars($row["name"]) . "'>
                        <input type='hidden' name='file_code' value='" . htmlspecialchars($row["file_code"]) . "'>
                        <input type='hidden' name='address' value='" . htmlspecialchars($row["address"]) . "'>
                        <input type='hidden' name='birthdate' value='" . htmlspecialchars($row["birthdate"]) . "'>
                        <input type='hidden' name='file_id' value='" . htmlspecialchars($row["file_id"]) . "'>
                        <input type='hidden' name='b_name' value='" . htmlspecialchars($row["b_name"]) . "'>
                        <button type='submit' name='accept'>CLAIM</button>
                    </form>
              </td>";
        } else {
            echo "<td></td>"; // No button for other statuses
        }
        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No scheduled request/s found</td></tr>";
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