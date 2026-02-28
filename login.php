<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
  <title>Login Page</title>
  <style>
    /* Reset & Body Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f4f5;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Login Box */
    .login-box {
      width: 400px;
      padding: 40px;
      background: #ffffff;
      border: 2px solid #000000;
      box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
      border-radius: 15px;
      color: #09090b;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #000000;
    }

    /* Input Box */
    .input-box {
      position: relative;
      margin-bottom: 25px;
    }

    .input-box input {
      width: 100%;
      padding: 10px 50px 10px 15px;
      /* Extra right padding for icons */
      background: #ffffff;
      border: 2px solid #e4e4e7;
      border-radius: 8px;
      color: #09090b;
      font-size: 16px;
      transition: 0.3s;
    }

    .input-box label {
      position: absolute;
      top: -21px;
      left: 15px;
      font-size: 14px;
      color: #71717a;
      pointer-events: none;
      transition: 0.3s;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
      top: -20px;
      font-size: 12px;
      color: #000000;
    }

    .input-box input:focus {
      border-color: #000000;
      box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
    }

    .icon {
      position: absolute;
      top: 10px;
      right: 15px;
      color: #09090b;
      font-size: 20px;
    }

    .toggle-password {
      cursor: pointer;
      right: 40px;
      transition: color 0.3s ease;
    }

    .toggle-password:hover {
      color: #000000;
    }

    /* Error Message */
    .error-message {
      color: #dc2626;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    /* Remember Me Checkbox */
    .remember-me {
      display: flex;
      align-items: center;
      gap: 7px;
      margin-bottom: 20px;
      color: #09090b;
    }

    /* Role Selection */
    .role-selection {
      margin: 20px 0;
    }

    .role-title {
      color: #09090b;
      margin-bottom: 10px;
    }

    .role-options {
      display: flex;
      justify-content: center;
      gap: 30px;
    }

    .radio-option {
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .radio-highlight {
      display: inline-block;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background-color: #e4e4e7;
      border: 1px solid #000000;
      margin-right: 5px;
      vertical-align: middle;
    }

    .radio-option input[type="radio"] {
      display: none;
    }

    .radio-option input[type="radio"]:checked~span.radio-highlight {
      background-color: #000000;
    }

    /* Submit Button */
    .login-box button {
      width: 100%;
      padding: 10px;
      border: 2px solid #000000;
      border-radius: 5px;
      background: #000000;
      color: #ffffff;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
      transition: all 0.3s ease;
      margin-top: 20px;
    }

    .login-box button:hover {
      background: #ffffff;
      color: #000000;
      transform: translate(2px, 2px);
      box-shadow: 0px 0px 0px rgba(0, 0, 0, 1);
    }

    /* Register Link */
    .register-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .register-link a {
      color: #000000;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <form action="logindb.php" method="post">
      <h2>Login</h2>

      <!-- Username -->
      <div class="input-box">
        <input type="text" id="username" name="username" required minlength="6" autocomplete="username">
        <label for="username">Username</label>
        <span class="icon">
          <ion-icon name="person-circle-outline"></ion-icon>
        </span>
        <div class="error-message" id="usernameError">Username must be at least 6 characters.</div>
      </div>

      <!-- Password -->
      <div class="input-box">
        <input type="password" id="password" name="password" required minlength="4" autocomplete="current-password">
        <label for="password">Password</label>
        <!-- <span class="icon"><ion-icon name="lock-open-outline"></ion-icon></span> -->
        <span class="icon toggle-password" style="color: #09090b; right: 15px; font-size: 20px; position: absolute;
      top: 10px;">
          <ion-icon name="eye-outline"></ion-icon>
        </span>
        <div class="error-message" id="passwordError">Password must be at least 4 characters.</div>
      </div>

      <!-- Remember Me -->
      <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
      </div>

      <!-- Role Selection -->
      <div class="role-selection">
        <p class="role-title">I am a:</p>
        <div class="role-options">
          <label class="radio-option">
            <input type="radio" name="role" value="student" checked>
            <span class="radio-highlight"></span>
            <span>Student</span>
          </label>
          <label class="radio-option">
            <input type="radio" name="role" value="teacher">
            <span class="radio-highlight"></span>
            <span>Teacher</span>
          </label>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" id="loginBtn">Login</button>

      <!-- Register Link -->
      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
  </div>

  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- JavaScript Functionality -->
  <script>
    // Validation and error handling
    document.querySelector("form").addEventListener("submit", function (e) {
      const username = document.getElementById("username");
      const password = document.getElementById("password");
      let valid = true;

      // Hide previous errors
      document.getElementById("usernameError").style.display = "none";
      document.getElementById("passwordError").style.display = "none";

      if (username.value.length < 6) {
        document.getElementById("usernameError").style.display = "block";
        valid = false;
      }

      if (password.value.length < 4) {
        document.getElementById("passwordError").style.display = "block";
        valid = false;
      }

      if (!valid) {
        e.preventDefault(); // Stop form submission
      } else {
        const btn = document.getElementById("loginBtn");
        btn.disabled = true;
        btn.textContent = "Logging in...";
      }
    });

    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Change icon based on visibility
      const icon = this.querySelector('ion-icon');
      icon.name = type === 'password' ? 'eye-outline' : 'eye-off-outline';
    });

    //page refresh
    window.addEventListener("pageshow", function (event) {
      if (event.persisted || window.performance.navigation.type === 2) {
        // Force refresh if accessed via back/forward cache
        window.location.reload();
      }
    });
  </script>
</body>

</html>