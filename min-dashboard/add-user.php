<?php
// include('includes/auth.php');
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST['username'];
    $status = 'pending'; // Manually set status because it's not submitted from disabled select
    $role = $_POST['role'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO auth (username, password, role, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $role, $status);

    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        echo "<p class='text-red-500 p-4 text-center'>Error: Could not add user.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New User</title>
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
  <div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Add New User</h2>
    <form method="POST" action="add-user.php">
  <div class="grid grid-cols-1 gap-4">
    <input type="text" name="username" placeholder="Full Name (minimum 6 letter)" minlength="6" required class="p-2 rounded bg-gray-700">
    
    <select name="status" required class="p-2 rounded bg-gray-700" disabled>
      <option value="pending">Pending</option>
    </select>

    <select name="role" required class="p-2 rounded bg-gray-700">
      <option value="">Select Role</option>
      <option value="teacher">Teacher</option>
      <option value="student">Student</option>
    </select>

    <input type="password" name="password" placeholder="Password (minimum 4 character)" minlength="4" required class="p-2 rounded bg-gray-700">
  </div>
  
  <button type="submit" name="submit" class="mt-6 bg-blue-600 hover:bg-blue-700 w-full py-2 rounded">Add User</button>
</form>

  </div>
</body>
</html>

