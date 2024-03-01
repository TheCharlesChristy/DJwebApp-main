<?php
header('Content-Type: application/json');
require_once 'includes/db.inc.php'; // Include the database connection

// Get the sorting parameter from the query string and validate it
$sort_by = isset($_GET['sort_by']) && in_array($_GET['sort_by'], ['artist', 'song_name', 'other_columns']) ? $_GET['sort_by'] : 'artist';

// Prepare the SQL statement to prevent SQL injection
// Note: Directly using variables for column names in SQL queries can be risky and is generally not recommended because prepared statements do not support binding column names.
// As a workaround, validate the input against a list of allowed fields as done above.
$sql = "SELECT * FROM songs ORDER BY $sort_by ASC";

if ($result = $conn->query($sql)) {
    $songs = array();
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
    echo json_encode($songs);
} else {
    echo json_encode(array("status" => "error", "message" => "Query failed: " . $conn->error));
}

$conn->close();
?>
