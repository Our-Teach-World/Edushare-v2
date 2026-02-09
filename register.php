<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - EduShare</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css " />
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
  <style>
    .error-message {
      color: #ff4d4d;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }
    .input-wrapper {
      position: relative;
    }

    .icon {
      position: absolute;
      right: 7px;
      top: 19.5%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #00ffff;
      font-size: 20px;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 64.7%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #00ffff;
      font-size: 15px;
    }
    .btn:disabled {
      opacity: 0.7;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<header class="navbar">
  <div class="container navbar-container">
    <img src="logo/favicon.png" alt="Logo" />
  </div>
</header>

<!-- Main Content -->
<main>
  <div class="container py-12 flex items-center justify-center min-h-[calc(100vh-16rem)]">
    <div class="card w-full max-w-md" id="registrationCard">
      <div class="card-header">
        <h2 class="card-title">Create an Account</h2>
        <p class="card-description">Register to access educational resources</p>
      </div>
      <div class="card-content">
        <form id="registrationForm" action="registerdb.php" method="POST" class="space-y-4">
          
          <!-- Step 1: Basic Info -->
          <div id="step1" class="space-y-4 input-wrapper">
            <!-- Username -->
            <div class="space-y-2">
              <label for="username" class="label">Username</label>
              <input
                id="username"
                name="username"
                placeholder="Enter Username"
                required
                minlength="6"
                class="input"
              />
              <span class="icon">
                  <ion-icon name="person-circle-outline"></ion-icon>
              </span> 
              <div class="error-message" id="usernameError">Username must be at least 6 characters.</div>
            </div>

            <!-- Password -->
            <div class="space-y-2 input-wrapper">
              <label for="password" class="label">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                required
                minlength="4"
                class="input"
              />
              <span class="toggle-password" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
              </span>
              <div class="error-message" id="passwordError">Password must be at least 4 characters.</div>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2 input-wrapper">
              <label for="confirmpassword" class="label">Confirm Password</label>
              <input
                id="confirmpassword"
                name="confirmpassword"
                type="password"
                required
                class="input"
              />
              <div class="error-message" id="confirmError">Passwords do not match.</div>
            </div>
          </div>

          <!-- Step 2: Role & Terms -->
          <div id="step2" class="space-y-4" style="display: none;">
            <!-- Role -->
            <div class="space-y-2">
              <label for="role" class="label">I am a</label>
              <select id="role" name="role" class="input" required>
                <option value="" disabled selected>Select your role</option>
                <option style="color: black;" value="teacher">Teacher</option>
                <option style="color: black;" value="student">Student</option>
              </select>
            </div>

            <!-- Terms -->
            <div class="space-y-2 pt-4">
              <div class="flex items-center space-x-2">
                <input type="checkbox" id="agreeTerms" class="checkbox" required />
                <label for="agreeTerms" class="text-sm font-medium">
                  I agree to the Terms of Service and Privacy Policy
                </label>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="mt-6 flex justify-between">
            <button type="button" id="backButton" class="btn btn-outline" style="display: none;" onclick="goBack()">Back</button>
            <button type="button" id="nextButton" class="btn btn-primary ml-auto" onclick="validateAndNext()">Next</button>
            <button type="submit" id="registerButton" class="btn btn-primary ml-auto" style="display: none;" id="submitBtn">Register</button>
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="card-footer flex flex-col items-center">
        <p class="text-sm text-muted-foreground">
          Already have an account?
          <a href="login.php" class="text-blue-400 hover:underline">Sign in</a>
        </p>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <p class="text-xs text-center text-muted-foreground">© <span id="currentYear"></span> EduShare. All rights reserved.</p>
  </div>
</footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
  document.getElementById('currentYear').textContent = new Date().getFullYear();

  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const nextButton = document.getElementById('nextButton');
  const backButton = document.getElementById('backButton');
  const registerButton = document.getElementById('registerButton');

  // Toggle Password Visibility
  function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = event.target;
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }

  // Validate Step 1 before going to Step 2
  function validateAndNext() {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmpassword');

    let valid = true;

    // Reset errors
    document.getElementById("usernameError").style.display = "none";
    document.getElementById("passwordError").style.display = "none";
    document.getElementById("confirmError").style.display = "none";

    if (username.value.length < 6) {
      document.getElementById("usernameError").style.display = "block";
      valid = false;
    }

    if (password.value.length < 4) {
      document.getElementById("passwordError").style.display = "block";
      valid = false;
    }

    if (password.value !== confirmPassword.value) {
      document.getElementById("confirmError").style.display = "block";
      valid = false;
    }

    if (!valid) return;

    step1.style.display = 'none';
    step2.style.display = 'block';
    nextButton.style.display = 'none';
    backButton.style.display = 'inline-block';
    registerButton.style.display = 'inline-block';
  }

  // Go back to Step 1
  function goBack() {
    step1.style.display = 'block';
    step2.style.display = 'none';
    nextButton.style.display = 'inline-block';
    backButton.style.display = 'none';
    registerButton.style.display = 'none';
  }

  // Submit Form
  document.getElementById('registrationForm').addEventListener('submit', function(e) {
    const role = document.getElementById('role').value;
    const agreeTerms = document.getElementById('agreeTerms').checked;

    if (!role || !agreeTerms) {
      e.preventDefault();
      alert('Please select a role and agree to the terms.');
    } else {
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.textContent = 'Registering...';
    }
  });

  //page refresh 
    window.addEventListener("pageshow", function(event) {
        if (event.persisted || window.performance.navigation.type === 2) {
            // Force refresh if accessed via back/forward cache
            window.location.reload();
        }
    });
</script>

</body>
</html>