<?php
// get_sessions.php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driving_school';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$learner_id = intval($_GET['learner_id'] ?? 0);
$sessions = [];

if ($learner_id > 0) {
    $stmt = $conn->prepare("SELECT date_time, location, instructor_name, status FROM sessions WHERE learner_id = ?");
    $stmt->bind_param('i', $learner_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $sessions[] = $row;
    }
    $stmt->close();
}

$conn->close();

echo json_encode($sessions);
?>