<?php
session_start();
require_once "db.php";

// Get form input
$username = $_POST['username'];
$password = $_POST['password'];

// Only allow Admin juliet
if (strtolower($username) !== "juliet") {
    echo "Access denied. Only Admin Zainab can log in.";
    exit;
}

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    if (password_verify($password, $user['password'])) {
        // Set session variable for admin
        $_SESSION['admin_id'] = $user['id']; // assuming 'id' is the column name

        // Return just "success" for JS to match
        echo "success";
    } else {
        echo "Wrong password!";
    }
} else {
    echo "Admin account not found!";
}

$stmt->close();
$conn->close();
?>