<?php
// Include your database connection file
require_once('db_connection.php');

// Query to fetch data
$sql = "SELECT file_code, COUNT(*) as count, MONTH(timestamp) as month FROM user_activty GROUP BY file_code, month";
$result = $conn->query($sql);

$data = [];
$fileCodeTotals = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        // Calculate the totals for each file_code
        if (!isset($fileCodeTotals[$row['file_code']])) {
            $fileCodeTotals[$row['file_code']] = 0;
        }
        $fileCodeTotals[$row['file_code']] += $row['count'];
    }
}

echo json_encode(['data' => $data, 'totals' => $fileCodeTotals]);
?>
