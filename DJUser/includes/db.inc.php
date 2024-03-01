<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "nick-burret-dj-web-app";

$pdo = new PDO("mysql:host=$dbServername;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
?>

