<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'driver_tracker';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$location = $_POST['location'] ?? '';
$learner_name = $_POST['learner_name'] ?? '';
$status = $_POST['status'] ?? 'Scheduled';
$instructor_id = 1; // hardcoded for now

if ($date && $time && $location && $learner_name) {
    $dateTime = $date . ' ' . $time;

    // ✅ Step: Find learner_id from learner name
    $stmt = $conn->prepare("SELECT learner_id FROM learners WHERE name = ?");
    $stmt->bind_param('s', $learner_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $learner_id = $row['learner_id'];

        // ✅ Now insert session using learner_id
        $stmt_insert = $conn->prepare("INSERT INTO sessions (learner_id, instructor_id, date_time, location, status) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param('iisss', $learner_id, $instructor_id, $dateTime, $location, $status);

        if ($stmt_insert->execute()) {
            echo "✅ Session added successfully.";
        } else {
            echo "❌ Error adding session.";
        }

        $stmt_insert->close();
    } else {
        echo "⚠ Learner not found in the database.";
    }

    $stmt->close();
} else {
    echo "⚠ Please fill all required fields.";
}

$conn->close();
?>