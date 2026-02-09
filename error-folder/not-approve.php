<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>login Approval in waiting</title>
  <!-- Link to your main CSS file -->
  <link rel="stylesheet" type="text/css" href="../style.css" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
</head>
<body class="bg-gradient-to-br from-purple-300 to-indigo-600 min-h-screen flex items-center justify-center px-4">
  <!-- Success Card -->
  <div class="card w-full max-w-md mx-auto bg-white/10 backdrop-blur-md rounded-xl shadow-lg p-6 text-center">
    <div class="flex justify-center mb-4">
      <div class="w-16 h-16 rounded-full bg-green-200 flex items-center justify-center">
        <i class="fas fa-check-circle text-green-600 text-3xl"></i>
      </div>
    </div>

    <h2 class="text-2xl font-bold text-white mb-2">Not approve</h2>
    <p class="text-white/90 mb-4">
      Thank you for loging with EduShare.❌ Your account is not approved yet. Please wait for approval.
    </p>

    <a href="../login.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
      Return to Home
    </a>
  </div>
  <script>

       const successCard = document.getElementById('successCard');

    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenuBtn.addEventListener('click', () => {
      if (mobileMenu.style.display === 'none') {
        mobileMenu.style.display = 'block';
        mobileMenuBtn.innerHTML = '<i class="fas fa-times"></i>';
      } else {
        mobileMenu.style.display = 'none';
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
      }
    });

  </script>
</body>
</html>