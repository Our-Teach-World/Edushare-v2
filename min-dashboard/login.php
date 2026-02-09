<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
  <form method="POST" class="bg-gray-800 p-8 rounded-lg w-full max-w-sm shadow-lg" action="logindb.php">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>

    <label class="block mb-2">Username</label>
    <input type="text" name="username" required class="w-full p-2 rounded bg-gray-700 mb-4">

    <label class="block mb-2">Password</label>
    <input type="password" name="password" required class="w-full p-2 rounded bg-gray-700 mb-6">

    <button type="submit" name="login" class="bg-blue-600 w-full py-2 rounded hover:bg-blue-700">Login</button>

    <p class="text-sm text-right mt-4"><a href="#" class="text-blue-400">Forgot Password?</a></p>
  </form>
</body>
</html>
