<?php
// update_playing.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nick-burret-dj-web-app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$requestee = $_GET['requestee'];
$playing = $_GET['playing'];

// Prepare and execute the SQL update statement
$sql = "UPDATE queue SET Playing=? WHERE Requestee=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $playing, $requestee);
$stmt->execute();

$stmt->close();
$conn->close();
?>
