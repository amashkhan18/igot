<?php
header("Content-Type: application/json");
require_once '../config/database.php'; // Include database connection

// Get the input data
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header("Location: ../dist/forms/login.html");
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

// Query the database for the user
$query = "SELECT id, password_hash FROM user_login WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../dist/forms/login.html");
    exit;
}

$user = $result->fetch_assoc();

// Verify the password
if ($password !== $user['password_hash']) {
    header("Location: ../dist/forms/login.html");
    exit;
}

// Set a cookie for the logged-in user
setcookie("user_id", $user['id'], time() + (86400 * 7), "/"); // Cookie valid for 7 days

// Redirect to the registration page
header("Location: ../dist/forms/newreg.php");
exit;
?>
