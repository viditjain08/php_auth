<?php
$connect_error = 'Sorry, we\' re experiencing connection problems. ';
$servername = "localhost";
$username = "********";
$password = "********";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
