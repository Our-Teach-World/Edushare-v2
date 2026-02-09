<?php
include('includes/db.php');

// Approve user
if (isset($_POST['approve_id'])) {
    $id = intval($_POST['approve_id']);
    $conn->query("UPDATE auth SET status='approved' WHERE id=$id");
    exit;
}

// Delete user
if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $conn->query("DELETE FROM auth WHERE id=$id");
    exit;
}

// Bulk Approve/Delete
if (isset($_POST['bulk_action']) && isset($_POST['user_ids'])) {
    $ids = implode(',', array_map('intval', $_POST['user_ids']));
    if ($_POST['bulk_action'] === 'approve') {
        $conn->query("UPDATE auth SET status='approved' WHERE id IN ($ids)");
    } else {
        $conn->query("DELETE FROM auth WHERE id IN ($ids)");
    }
    exit;
}

// AJAX Search
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $search = $conn->real_escape_string($_GET['q'] ?? '');
    $searchQuery = $search ? "WHERE username LIKE '%$search%' OR role LIKE '%$search%' OR status LIKE '%$search%'" : '';
    $result = $conn->query("SELECT * FROM auth $searchQuery ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='border-b border-gray-700'>";
        echo "<td class='p-2'><input type='checkbox' class='select-user' value='{$row['id']}'></td>";
        echo "<td class='p-2'>{$row['id']}</td>";
        echo "<td class='p-2'>{$row['username']}</td>";
        echo "<td class='p-2'>{$row['role']}</td>";
        echo "<td class='p-2'>{$row['password']}</td>";
        echo "<td class='p-2'>{$row['created_at']}</td>";
        echo "<td class='p-2'>" . ucfirst($row['status']) . "</td>";
        echo "<td class='p-2 space-x-1'>";
        if ($row['status'] === 'pending') {
            echo "<button onclick='approveUser({$row['id']})' class='bg-green-600 px-2 py-1 text-xs rounded'>Approve</button>";
        } else {
            echo "<span class='text-green-400 font-semibold text-sm'>✔ Approved</span>";
        }
        echo "<button onclick='deleteUser({$row['id']})' class='bg-red-600 px-2 py-1 text-xs rounded'>Delete</button>";
        echo '<a href="edit_user.php?id=' . $row['id'] . '" class="bg-blue-600 px-2 py-1 rounded text-xs">Edit</a>';

        echo "</td></tr>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin User Management</title>
    <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex">
    <div class="w-64 bg-gray-800 min-h-screen p-4">
        <h2 class="text-2xl font-bold mb-4">Admin Panel</h2>
        <ul class="space-y-3">
            <li><a href="dashboard.php" class="block hover:text-blue-400">Dashboard</a></li>
            <li><a href="users.php" class="block hover:text-blue-400">User Management</a></li>
            <li><a href="add-user.php" class="block hover:text-blue-400">Add User</a></li>
            <li><a href="export.php" class="block hover:text-blue-400">Export CSV</a></li>
        </ul>
    </div>

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-4">User Management</h1>

        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Search users..."
                class="p-2 rounded bg-gray-800 border border-gray-700 w-80">
        </div>

        <div class="mb-4 space-x-2">
            <button onclick="bulkAction('approve')" class="bg-green-600 px-4 py-2 rounded">Approve Selected</button>
            <button onclick="bulkAction('delete')" class="bg-red-600 px-4 py-2 rounded">Delete Selected</button>

        </div>

        <table class="min-w-full bg-gray-800 rounded-lg">
            <thead>
                <tr class="bg-gray-700 text-left">
                    <th class="p-3"><input type="checkbox" id="selectAll"></th>
                    <th class="p-3">ID</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Password</th>
                    <th class="p-3">Reg Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- AJAX results go here -->
            </tbody>
        </table>
    </div>

    <script>
        const fetchUsers = () => {
            const q = document.getElementById('searchInput').value;
            fetch(`?ajax=1&q=${encodeURIComponent(q)}`)
                .then(res => res.text())
                .then(data => document.getElementById('userTableBody').innerHTML = data);
        };

        const approveUser = (id) => {
            fetch("", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `approve_id=${id}`
            }).then(() => fetchUsers());
        };

        const deleteUser = (id) => {
            if (confirm("Delete this user?")) {
                fetch("", {
                    method: "POST",
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `delete_id=${id}`
                }).then(() => fetchUsers());
            }
        };

        const bulkAction = (type) => {
            const ids = Array.from(document.querySelectorAll(".select-user:checked")).map(cb => cb.value);
            if (ids.length === 0) return alert("Select at least one user.");
            if (type === 'delete' && !confirm("Are you sure to delete selected users?")) return;
            fetch("", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `bulk_action=${type}&user_ids[]=` + ids.join("&user_ids[]=")
            }).then(() => fetchUsers());
        };

        document.getElementById("selectAll").addEventListener("change", function () {
            document.querySelectorAll(".select-user").forEach(cb => cb.checked = this.checked);
        });

        document.getElementById("searchInput").addEventListener("input", fetchUsers);

        window.onload = fetchUsers;
    </script>
</body>

</html>