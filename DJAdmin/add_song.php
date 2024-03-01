<?php
session_start();
if (isset($_GET['user'])) {
    global $useremail;
    $useremail =  $_GET['user'];
}  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get form data
    $artist = $_POST['song_artist'];
    $song_name = $_POST['song_name'];

    // Insert data into the database
    $sql = "INSERT INTO songs (Artist, SongName)
            VALUES ('$artist', '$song_name')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully press any key to return to the admin page!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- Redirect back to the main page -->
<script>
    document.addEventListener("keydown", (key)=>{
        window.location.replace("index.php")
    })
</script>
