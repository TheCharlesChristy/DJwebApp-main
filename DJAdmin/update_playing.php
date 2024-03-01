<?php
// update_playing.php
require_once 'includes/db.inc.php'; // Use the centralized DB connection

$requestee = $_GET['requestee'];
$playing = $_GET['playing'];

// Assuming the values for $requestee and $playing are integers based on the bind_param type "ii"
// Validate or sanitize input as necessary, especially if they're coming directly from user input

// Prepare and execute the SQL update statement
$sql = "UPDATE queue SET Playing=? WHERE Requestee=?";
$stmt = $conn->prepare($sql);

// Bind parameters and execute
$stmt->bind_param("is", $playing, $requestee); // Ensure these types match your database schema. Adjust "is" as needed.
if (!$stmt->execute()) {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
