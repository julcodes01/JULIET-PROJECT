<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driver_tracker';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$learner_id = $_POST['learner_id'];
$feedback = $_POST['feedback'];

$skills = [
    $_POST['skill_1'] => $_POST['score_1'],
    $_POST['skill_2'] => $_POST['score_2'],
    $_POST['skill_3'] => $_POST['score_3']
];

foreach ($skills as $skill => $score) {
    if (!empty($skill) && !empty($score)) {
        $stmt = $conn->prepare("INSERT INTO learner_progress (learner_id, skill_name, score_percentage, feedback) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $learner_id, $skill, $score, $feedback);
        $stmt->execute();
    }
}

$conn->close();

echo "Progress and feedback submitted successfully!";
?>