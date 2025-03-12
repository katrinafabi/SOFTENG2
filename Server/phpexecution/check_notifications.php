<?php
include 'db_connection.php'; // Include the database connection file

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Assuming you want to fetch notifications for 'admin'
    $forwho = 'admin'; // Static value for 'forwho'

    // Query to fetch notifications for 'admin'
    $fetch_query = "SELECT * FROM activity_log WHERE forwho = ? ORDER BY timestamp DESC";
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param("s", $forwho);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = [];

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Output fetched data as JSON
    header('Content-Type: application/json');
    echo json_encode($notifications);
    exit();
}
?>
