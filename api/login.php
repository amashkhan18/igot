<?php
header("Content-Type: application/json");
require_once '../config/database.php'; // Include database connection

// Get the input data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    header("Location: ../forms/login.html");
    exit;
}

$email = $data['email'];
$password = $data['password'];

// Query the database for the user
$query = "SELECT id, password FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../forms/login.html");
    exit;
}

$user = $result->fetch_assoc();

// Verify the password
if ($password !== $user['password']) {
    header("Location: ../forms/login.html");
    exit;
}

// Set a cookie for the logged-in user
setcookie("user_id", $user['id'], time() + (86400 * 7), "/"); // Cookie valid for 7 days

// Redirect to the registration page
header("Location: ../forms/newreg.php");
exit;
?>
