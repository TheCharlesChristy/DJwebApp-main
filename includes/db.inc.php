<?php

// Heroku ClearDB settings or fallback to local database
$dbUrl = getenv("CLEARDB_DATABASE_URL");

if ($dbUrl) {
    // ClearDB connection
    $url = parse_url($dbUrl);
    $dbServername = $url["host"];
    $dbUsername = $url["user"];
    $dbPassword = $url["pass"];
    $dbName = substr($url["path"], 1); // Remove the leading slash
} else {
    // Local database connection
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "nick-burret-dj-web-app";
}

// PDO connection
try {
    $pdo = new PDO("mysql:host=$dbServername;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}

// MySQLi connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("MySQLi connection failed: " . mysqli_connect_error());
}

?>
