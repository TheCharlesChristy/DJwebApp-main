<?php
header('Content-Type: application/json');
require_once 'includes/db.inc.php'; // Include the database connection setup

$sql = "SELECT * FROM queue";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data); // Output the data as JSON

$conn->close();
?>
