<?php
require_once "db.php";
session_start();

header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check if fields are empty
if (empty($username) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Please fill in all fields."
    ]);
    exit();
}

// Prepare the query
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
  echo json_encode([
        "success" => true,
        "message" => "Login successful.",
        "redirect" => "learner dashboard.html"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid username or password."
    ]);
}