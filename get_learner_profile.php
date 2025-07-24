<?php
header('Content-Type: application/json'); // ✅ Tells JS it's JSON

$learner_id = isset($_GET['learner_id']) ? $_GET['learner_id'] : 1;

$conn = new mysqli("localhost", "root", "", "driver_tracker");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$query = "SELECT name, license_type, progress_status FROM learners WHERE learner_id = $learner_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Learner not found"]);
}
?>