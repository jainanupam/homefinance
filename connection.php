<?php
$servername = "localhost";
$db_user = "test_admin";
$password = "";
$db = "test";

// create connection
$conn = new mysqli($servername, $db_user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

 ?>
