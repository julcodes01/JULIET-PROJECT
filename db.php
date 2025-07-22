<?php
$host = "localhost";
$dbname = "driver_tracker"; // Change to your actual database name
$username = "root"; // Default for XAMPP
$password = ""; // Default is blank for XAMPP

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>