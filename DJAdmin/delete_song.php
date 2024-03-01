<?php
header("Content-Type: application/json");
require_once 'includes/db.inc.php'; // Use the centralized DB connection

$song_id = isset($_POST['song_id']) ? $_POST['song_id'] : '';

if ($song_id !== '') {
    $sql = "DELETE FROM queue WHERE Requestee = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $song_id); // Ensure type matches your column type, "i" for integer
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "No rows affected. Song ID may not exist."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error executing statement."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error preparing statement."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Song ID is missing."]);
}

$conn->close();
?>