<?php
//include('includes/auth.php');
include('includes/db.php');

// Fetch stats
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM auth")->fetch_assoc()['total'];
$approvedUsers = $conn->query("SELECT COUNT(*) AS total FROM auth WHERE status = 'approved'")->fetch_assoc()['total'];
$pendingUsers = $conn->query("SELECT COUNT(*) AS total FROM auth WHERE status = 'pending'")->fetch_assoc()['total'];
// $totalCourses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white flex">
  <!-- Sidebar -->
  <div class="w-64 bg-gray-800 min-h-screen p-6">
    <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
    <ul class="space-y-4">
      <li><a href="dashboard.php" class="block hover:text-blue-400">Dashboard</a></li>
      <li><a href="users.php" class="block hover:text-blue-400">User Management</a></li>
      <li><a href="add-user.php" class="block hover:text-blue-400">Add User</a></li>
      <li><a href="export.php" class="block hover:text-blue-400">Export CSV</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard Overview</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="p-4 bg-gray-800 rounded-xl shadow-lg">
        <p class="text-sm text-gray-400">Total Users</p>
        <p class="text-2xl font-bold"><?php echo $totalUsers; ?></p>
      </div>
      <div class="p-4 bg-gray-800 rounded-xl shadow-lg">
        <p class="text-sm text-gray-400">Approved Users</p>
        <p class="text-2xl font-bold"><?php echo $approvedUsers; ?></p>
      </div>
      <div class="p-4 bg-gray-800 rounded-xl shadow-lg">
        <p class="text-sm text-gray-400">Pending Approvals</p>
        <p class="text-2xl font-bold"><?php echo $pendingUsers; ?></p>
      </div>
      
    </div>

    <!-- Charts -->
    <div class="grid md:grid-cols-2 gap-8">
      <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
        <h2 class="text-lg font-semibold mb-4">User Status Chart</h2>
        <canvas id="userChart" height="200"></canvas>
      </div>
    </div>
  </div>

  <script>
    const userChart = new Chart(document.getElementById('userChart'), {
      type: 'bar',
      data: {
        labels: ['Approved', 'Pending'],
        datasets: [{
          label: 'Users',
          data: [<?php echo $approvedUsers; ?>, <?php echo $pendingUsers; ?>],
          backgroundColor: ['#4ade80', '#f97316']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        }
      }
    });

  </script>
</body>
</html>
