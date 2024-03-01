<?php
session_start();
require_once 'db.inc.php'; // Include the database connection

if (isset($_GET['user'])) {
    global $useremail;
    $useremail = $_GET['user'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $conn is your MySQLi connection from db.inc.php

    // Get form data and ensure proper escaping to prevent SQL Injection
    $artist = mysqli_real_escape_string($conn, $_POST['song_artist']);
    $song_name = mysqli_real_escape_string($conn, $_POST['song_name']);

    // Insert data into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO songs (Artist, SongName) VALUES (?, ?)");
    $stmt->bind_param("ss", $artist, $song_name);

    if ($stmt->execute()) {
        // Success message or redirection
        echo "Record inserted successfully";
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!-- Redirect back to the main page -->
<script>
    document.addEventListener("keydown", (key)=>{
        window.location.replace("index.php")
    })
</script>
