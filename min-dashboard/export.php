<?php
//include('includes/auth.php');
include('includes/db.php');

// CSV Export
if (isset($_POST['export_csv'])) {
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="users.csv"');

  $output = fopen("php://output", "w");
  fputcsv($output, ['Id', 'Name', 'Role', 'Password', 'Reg Date', 'status']);

  $result = $conn->query("SELECT * FROM auth");
  while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
      $row['id'],
      $row['username'],
      $row['role'],
      $row['password'],

      // "\t" . $row['mobile'], // Force text
      // "\t" . date('d-m-Y', strtotime($row['dob'])), // Force text format for date
      // $row['address'],
      // $row['education_qualification'],
      // $row['upi_id'],
      "\t" . date('d-m-Y h:i A', strtotime($row['created_at'])), // Force text format for datetime
      $row['status']
    ]);


  }
  fclose($output);
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Export Data</title>
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex">
  <!-- Sidebar -->
  <div class="w-64 bg-gray-800 min-h-screen p-6">
    <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
    <ul class="space-y-4">
      <li><a href="dashboard.php" class="block hover:text-blue-400">Dashboard</a></li>
      <li><a href="users.php" class="block hover:text-blue-400">User Management</a></li>
      <li><a href="add-user.php" class="block hover:text-blue-400">Add User</a></li>
      <li><a href="export.php" class="block hover:text-blue-400 font-bold text-blue-500">Export CSV</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    <h1 class="text-3xl font-bold mb-6">Export Users</h1>
    <form method="POST" class="space-x-4">
      <button name="export_csv" class="bg-blue-600 px-6 py-3 rounded hover:bg-blue-700">Export as CSV</button>
    </form>
  </div>
</body>

</html>