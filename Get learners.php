<?php
// get_learners.php
header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driving_school';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT learner_id, name FROM learners");
$learners = [];

while ($row = $result->fetch_assoc()) {
    $learners[] = $row;
}

echo json_encode($learners);

$conn->close();
?>