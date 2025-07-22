<?php
$host = "localhost";
$dbname = "driver_tracker";  // your DB name
$user = "root";                // your DB user
$pass = "";                    // your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get and sanitize form input
$first = $_POST['first_name'];
$second = $_POST['second_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if username or email already exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);
if ($stmt->rowCount() > 0) {
    echo "Username or Email already exists!";
    exit;
}

// Insert new user
$insert = $pdo->prepare("INSERT INTO users (first_name, second_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
$done = $insert->execute([$first, $second, $username, $email, $hashedPassword]);

if ($done) {
    echo "success";
} else {
    echo "Something went wrong.";
}
?>