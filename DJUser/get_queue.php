<?php
header('Content-Type: application/json');
include_once 'includes/db.inc.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nick-burret-dj-web-app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM queue";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}


$conn->close();
?>
