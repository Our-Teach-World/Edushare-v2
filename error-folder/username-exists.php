<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Username Error | Account Registration</title>
  <link rel="stylesheet" href="../styles/name-exists.css">
  <link rel="shortcut icon" type="image/png" href="../logo/favicon.png">
</head>
<body>
  <div class="container">
    <canvas id="particleCanvas"></canvas>
    
    <div class="error-card">
      <div class="card-content">
        <h1 class="title">Account Registration</h1>
        
        <div >
          <div class="error-content">
            <svg class="icon" viewBox="0 0 24 24" width="20" height="20">
              <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
              <line x1="12" y1="8" x2="12" y2="12" stroke="currentColor" stroke-width="2"/>
              <line x1="12" y1="16" x2="12" y2="16" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div>
              <p class="error-title">Username already exists</p>
              <p class="error-description">The username is already taken. Please try another username.</p>
            </div>
          </div>
        </div>
        
        <form id="usernameForm">
          <div class="card-footer">
        <button id="tryAgainButton" class="try-again">
          <svg viewBox="0 0 24 24" width="16" height="16">
            <path d="M21.5 2v6h-6M2.5 22v-6h6" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M2 12c0-4.4 3.6-8 8-8 3.3 0 6.2 2 7.4 4.9M22 12c0 4.4-3.6 8-8 8-3.3 0-6.2-2-7.4-4.9" fill="none" stroke="currentColor" stroke-width="2"/>
          </svg>
          <a href="../register.php">Click here to back</a> <pre>  </pre>
        </button>
        <p class="copyright">© 2025 Edu share</p>
      </div>
        </form>
      </div>
      
      
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>