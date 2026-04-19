<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "project_two_db";

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
