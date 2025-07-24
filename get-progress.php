<?php
$learner_id = 1; // default fixed learner_id for demo/testing

$conn = new mysqli("localhost", "root", "", "driver_tracker");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT skill_name, score_percentage, feedback FROM learner_progress WHERE learner_id = $learner_id";
$result = $conn->query($query);

$progress = [];
while ($row = $result->fetch_assoc()) {
    $progress[] = $row;
}

echo json_encode($progress);