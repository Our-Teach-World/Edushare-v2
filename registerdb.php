<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "techhome_by_v0"; // Database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Note: Consider hashing this in the future
    $role = $_POST['role'];

    // First, check if username already exists
    $check = $conn->prepare("SELECT id FROM auth WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Username exists, redirect to error or show message
        header("Location: username-exists.php"); // Make this page to show friendly message
        exit;
    }

    $check->close();

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO auth (username, password, role, status) VALUES (?, ?, ?, ?)");
    $status = 'pending';
    $stmt->bind_param("ssss", $username, $password, $role, $status);

    if ($stmt->execute()) {
        header("Location: registration-success.php");
        exit;
    } else {
        header("Location: 404-error.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>