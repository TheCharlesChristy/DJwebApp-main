<?php
header("Content-Type: application/json");

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

$song_id = isset($_POST['song_id']) ? $_POST['song_id'] : '';

if ($song_id !== '') {
  $sql = "DELETE FROM queue WHERE Requestee = ?";
  
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $song_id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(["status" => "success"]);
  } else {
    echo json_encode(["status" => "error", "message" => "Error preparing statement."]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Song ID is missing."]);
}

$conn->close();
?>
