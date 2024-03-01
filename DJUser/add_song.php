<?php
session_start();
include_once 'includes/db.inc.php';
if (isset($_GET['user'])) {
    global $useremail;
    $useremail =  $_GET['user'];
}  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $song_id = $_POST['song_id'];
    $useremail = $_POST['useremail'];
    $sql = "INSERT INTO queue (SongID, Requestee) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("is", $song_id, $useremail);
        $stmt->execute();
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error preparing statement."]);
    }
    $conn->close();
    echo json_encode(["status" => "success"]);
    exit();
}
?>

<!-- Redirect back to the main page -->
<script>
    document.addEventListener("keydown", (key)=>{
        window.location.replace("index.php")
    })
</script>
