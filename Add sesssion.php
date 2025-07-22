<?php
// add_session.php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driving_school';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$location = $_POST['location'] ?? '';
$learner_id = $_POST['learner_id'] ?? 0;
$status = $_POST['status'] ?? 'Scheduled';
$instructor_id = 1; // assuming a fixed instructor for simplicity

if ($date && $time && $location) {
    $dateTime = $date . ' ' . $time;

    $stmt = $conn->prepare("INSERT INTO sessions (learner_id, instructor_id, date_time, location, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('iisss', $learner_id, $instructor_id, $dateTime, $location, $status);

    if ($stmt->execute()) {
        echo "Session added successfully.";
    } else {
        echo "Error adding session.";
    }

    $stmt->close();
} else {
    echo "Please fill all required fields.";
}

$conn->close();
?>