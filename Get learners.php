<?php
// Get_sessions.php
header('Content-Type: application/json');

// DB connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driver_tracker';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch session data and join with learner names
$sql = "
    SELECT 
        s.date_time AS date,
        s.date_time AS time,
        s.location,
        l.name AS learner_name,
        s.status
    FROM sessions s
    INNER JOIN learners l ON s.learner_id = l.learner_id
    ORDER BY s.date_time DESC
";

$result = $conn->query($sql);

$sessions = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sessions[] = $row;
    }
    echo json_encode($sessions);
} else {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
}

$conn->close();
?>