<?php
//include('includes/auth.php');
include('includes/db.php');

$id = intval($_GET['id']);
$auth = $conn->query("SELECT * FROM auth WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("UPDATE auth SET username=?, status=?, password=?, role=?, status=? WHERE id=?");
    $stmt->bind_param("sssssi", $username, $status, $password, $role, $status, $id);

    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User</title>
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-8">
  <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded">
    <h2 class="text-2xl mb-4 font-bold">Edit User</h2>
    <form method="POST">
      <label>Full Name</label>
      <input type="text" name="username" value="<?php echo $auth['username']; ?>" class="w-full p-2 mb-4 bg-gray-700 rounded" required>

      <label>Status</label>
      <input type="status" name="status" value="<?php echo $auth['status']; ?>" class="w-full p-2 mb-4 bg-gray-700 rounded" required>

      <label>Role</label>
      <input type="text" name="role" value="<?php echo $auth['role']; ?>" class="w-full p-2 mb-4 bg-gray-700 rounded" required>

      <label>Password</label>
      <input type="password" name="password" value="<?php echo $auth['password']; ?>" class="w-full p-2 mb-4 bg-gray-700 rounded" required>
      

      
      <button type="submit" class="bg-blue-600 px-4 py-2 rounded">Update</button>
      <a href="dashboard.php" class="ml-4 text-gray-300 hover:underline">Cancel</a>
    </form>
  </div>
</body>
</html>
