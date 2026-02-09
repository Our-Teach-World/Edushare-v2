<?php
session_start();
$host = "localhost";  // Database host, usually localhost
$user = "root";  // Make sure you are using the correct MySQL username
$pass = "";      // Password for MySQL, empty for root in XAMPP
$db = "techhome_by_v0";  // Database name, adjust if different

// Database connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Validate inputs
    if (empty($username) || empty($password) || empty($role)) {
        die("All fields are required!");
    }

    // Check user credentials with role and approval status (no password hashing)
    $stmt = $conn->prepare("SELECT username, password, role, status FROM auth WHERE username = ? AND role = ?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $stmt->store_result();

    // If user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbUsername, $dbPassword, $dbRole, $dbApproved);
        $stmt->fetch();

        // Check if the password matches the plain text password
        if ($password === $dbPassword) {
            // Check if the user is approved
            if ($dbApproved == 'approved') {
                // Store session variables
                $_SESSION['username'] = $dbUsername;
                $_SESSION['role'] = $dbRole;

                // Redirect based on role
                if ($dbRole === 'teacher') {
                    header('Location: teacher_dashboard.php');
                    exit();
                } elseif ($dbRole === 'student') {
                    header('Location: student_dashboard.php');
                    exit();
                } else {
                    header("Location: error-folder/unthori.php");
                }
            } else {
                header("Location: error-folder/not-approve.php");
            }
        } else {
            header("Location: error-folder/invalid-password.php");
        }
    } else {
        header("Location: error-folder/role-user.php");
    }

    $stmt->close();
}
$conn->close();
?>
