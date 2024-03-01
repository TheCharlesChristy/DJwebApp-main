<?php
header('Content-Type: application/json');
include_once 'includes/db.inc.php';
// Replace the following variables with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nick-burret-dj-web-app";

// Get the sorting parameter from the query string
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'artist';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

// Sort the data by the given parameter
$sql = "SELECT * FROM songs ORDER BY $sort_by ASC";
$result = $conn->query($sql);

$songs = array();
while ($row = $result->fetch_assoc()) {
    $songs[] = $row;
}

$conn->close();
?>
