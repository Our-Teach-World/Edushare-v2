<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduShare - Teacher and Student File Sharing Platform</title>
  <link rel="stylesheet" href="styles/index.css">
  <!-- iconv -->
  <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="container navbar-container">
      <!-- <img src="logo/favicon.png" alt="ok" /> -->
      <img src="logo/favicon.png" alt="ok" />

      <nav class="navbar-menu">
        <ul class="flex gap-4">
          <li><a href="index.php" class="tab active">Home</a></li>

          <li><a href="contact.php" class="tab">Contact</a></li>
        </ul>
      </nav>

      <div class="navbar-actions">
        <a href="login.php" class="btn neon-button">Login</a>
        <a href="register.php" class="btn btn-primary">Register</a>
      </div>

      <button class="btn btn-outline btn-icon navbar-menu-mobile" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
      <div class="container">
        <div class="mobile-menu-items">
          <a href="index.php">Home</a>
          <a href="about.php">About</a>
          <a href="contact.php" class="active">Contact</a>
          <div class="separator"></div>
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-bg"></div>
      <div class="container">
        <div class="hero-content">
          <h1 class="hero-title">
            <span class="neon-text">Secure</span> File Sharing for Education
          </h1>
          <p class="hero-description">
            Connect teachers and students with a secure platform designed to make sharing educational resources simple
            and efficient.
          </p>
          <div class="hero-actions">
            <a href="register.php" class="btn btn-primary btn-lg">Get Started</a>
            <a href="about.php" class="btn neon-button btn-lg">Learn More</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features">
      <div class="container">
        <div class="features-header">
          <h2 class="features-title">
            <span class="neon-text" style="color: var(--neon-pink);">Powerful</span> Features
          </h2>
          <p class="features-description">
            Designed specifically for educational environments, our platform offers everything teachers and students
            need.
          </p>
        </div>

        <div class="features-grid">
          <!-- Feature 1 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(0, 255, 255, 0.2);">
              <i class="fas fa-upload" style="color: var(--neon-blue);"></i>
            </div>
            <h3 class="feature-title">Easy File Uploads</h3>
            <p class="feature-description">
              Teachers can quickly upload and organize files of any format, from PDFs to videos.
            </p>
          </div>

          <!-- Feature 2 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(0, 255, 0, 0.2);">
              <i class="fas fa-download" style="color: var(--neon-green);"></i>
            </div>
            <h3 class="feature-title">Simple Access</h3>
            <p class="feature-description">
              Students can easily browse, search, and download shared educational resources.
            </p>
          </div>

          <!-- Feature 3 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(157, 0, 255, 0.2);">
              <i class="fas fa-shield-alt" style="color: var(--neon-purple);"></i>
            </div>
            <h3 class="feature-title">Secure Sharing</h3>
            <p class="feature-description">
              Advanced permissions ensure files are only accessible to authorized users.
            </p>
          </div>

          <!-- Feature 4 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(255, 255, 0, 0.2);">
              <i class="fas fa-book-open" style="color: var(--neon-yellow);"></i>
            </div>
            <h3 class="feature-title">Organized Content</h3>
            <p class="feature-description">
              Categorize files by subject, date, or custom tags for easy navigation.
            </p>
          </div>

          <!-- Feature 5 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(255, 0, 255, 0.2);">
              <i class="fas fa-users" style="color: var(--neon-pink);"></i>
            </div>
            <h3 class="feature-title">User Management</h3>
            <p class="feature-description">
              Administrators can easily approve registrations and manage user access.
            </p>
          </div>

          <!-- Feature 6 -->
          <div class="feature-card">
            <div class="feature-icon" style="background-color: rgba(0, 255, 255, 0.2);">
              <i class="fas fa-arrow-right" style="color: var(--neon-blue);"></i>
            </div>
            <h3 class="feature-title">Seamless Integration</h3>
            <p class="feature-description">
              Works with your existing educational tools and learning management systems.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- AI Chatbot Section -->
    <section class="ai-chatbot-section"
      style="padding: 80px 0; background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.95)); border-top: 1px solid rgba(0, 247, 255, 0.1); border-bottom: 1px solid rgba(0, 247, 255, 0.1);">
      <div class="container">
        <div class="text-center" style="margin-bottom: 3rem; text-align: center;">
          <h2 class="section-title neon-text" style="font-size: 2.5rem; margin-bottom: 1rem;">Meet Your <span
              style="color: var(--neon-blue);">AI Companion</span></h2>
          <p class="section-description" style="max-width: 700px; margin: 0 auto; color: #a0a0a0;">
            Stuck on a problem? Our intelligent AI chatbot is here to help you understand concepts, summarize documents,
            and learn faster.
          </p>
        </div>

        <div class="features-grid">
          <!-- AI Feature 1 -->
          <div class="feature-card"
            style="border: 1px solid rgba(0, 247, 255, 0.3); box-shadow: 0 0 15px rgba(0, 247, 255, 0.1);">
            <div class="feature-icon" style="background-color: rgba(0, 255, 255, 0.1);">
              <i class="fas fa-robot" style="color: var(--neon-blue);"></i>
            </div>
            <h3 class="feature-title">Instant Answers</h3>
            <p class="feature-description">
              Ask questions about your study materials and get accurate, context-aware explanations instantly.
            </p>
          </div>

          <!-- AI Feature 2 -->
          <div class="feature-card"
            style="border: 1px solid rgba(255, 0, 255, 0.3); box-shadow: 0 0 15px rgba(255, 0, 255, 0.1);">
            <div class="feature-icon" style="background-color: rgba(255, 0, 255, 0.1);">
              <i class="fas fa-headphones" style="color: var(--neon-pink);"></i>
            </div>
            <h3 class="feature-title">Audio Responses</h3>
            <p class="feature-description">
              Listen to the AI's explanations on the go with our smart text-to-speech audio feature.
            </p>
          </div>

          <!-- AI Feature 3 -->
          <div class="feature-card"
            style="border: 1px solid rgba(0, 255, 0, 0.3); box-shadow: 0 0 15px rgba(0, 255, 0, 0.1);">
            <div class="feature-icon" style="background-color: rgba(0, 255, 0, 0.1);">
              <i class="fas fa-file-pdf" style="color: var(--neon-green);"></i>
            </div>
            <h3 class="feature-title">Export Notes</h3>
            <p class="feature-description">
              Convert your AI conversations into organized PDF notes for offline revision and sharing.
            </p>
          </div>
        </div>
      </div>
    </section><!-- How It Works Section -->
    <section class="how-it-works">
      <div class="container">
        <h2 class="text-center neon-text" style="margin-bottom: 1rem;">How It Works</h2>
        <div class="features-grid">
          <div class="feature-card">
            <h3 class="feature-title">Step 1: Register</h3>
            <p class="feature-description">Sign up as a teacher or student with basic details.</p>
          </div>
          <div class="feature-card">
            <h3 class="feature-title">Step 2: Login</h3>
            <p class="feature-description">Access your personalized dashboard securely.</p>
          </div>
          <div class="feature-card">
            <h3 class="feature-title">Step 3: Upload or Download</h3>
            <p class="feature-description">Teachers upload, students download the shared resources.</p>
          </div>
          <div class="feature-card">
            <h3 class="feature-title">Step 4: Learn Together</h3>
            <p class="feature-description">Collaborate and grow using powerful sharing tools.</p>
          </div>
        </div>
      </div>
    </section>


    <!-- Newsletter Section -->
    <section class="newsletter">
      <div class="container text-center">
        <h2 class="neon-text">Stay Updated</h2>
        <p class="text-muted-foreground">
          Subscribe to get the latest features and updates from EduShare.
        </p>
        <form class="newsletter-form">
          <input type="email" placeholder="Enter your email" required>
          <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
      <div class="container">
        <div class="cta-container">
          <div class="cta-content">
            <div class="cta-text">
              <h2 class="cta-title">Ready to transform your educational experience?</h2>
              <p class="cta-description">
                Join thousands of teachers and students already using our platform to share knowledge efficiently.
              </p>
            </div>
            <a href="register.php" class="btn btn-primary btn-lg">Get Started Now</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer-container">
      <div class="footer-grid">
        <div class="space-y-4">
          <h3 class="text-lg font-bold" style="color: var(--neon-blue);">EduShare</h3>
          <p class="text-sm text-muted-foreground">
            A comprehensive file-sharing system designed specifically for teachers and students.
          </p>
        </div>
        <div class="space-y-4">
          <h3 class="text-sm font-bold">Platform</h3>
          <ul class="space-y-2 text-sm">
            <li>
              <a href="index.php" class="text-muted-foreground hover:text-foreground">
                Home
              </a>
            </li>
            <li>
              <a href="about.php" class="text-muted-foreground hover:text-foreground">
                About
              </a>
            </li>
            <li>
              <a href="contact.php" class="text-muted-foreground hover:text-foreground">
                Contact
              </a>
            </li>
          </ul>
        </div>
        <div class="space-y-4">
          <h3 class="text-sm font-bold">Resources</h3>
          <ul class="space-y-2 text-sm">
            <li>
              <a href="#" class="text-muted-foreground hover:text-foreground">
                FAQ
              </a>
            </li>
            <li>
              <a href="#" class="text-muted-foreground hover:text-foreground">
                Help Center
              </a>
            </li>
            <li>
              <a href="#" class="text-muted-foreground hover:text-foreground">
                Privacy Policy
              </a>
            </li>
          </ul>
        </div>
        <div class="space-y-4">
          <h3 class="text-sm font-bold">Contact</h3>
          <ul class="space-y-2 text-sm">
            <li class="text-muted-foreground">Email: akmmeghwal12345@gmail.com</li>
            <li class="text-muted-foreground">Phone: +91 8302523400</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p class="text-xs text-muted-foreground">© <span id="currentYear"></span> EduShare. All rights reserved.</p>
        <div class="flex gap-4">
          <a href="#" class="text-xs text-muted-foreground hover:text-foreground">
            Terms of Service
          </a>
          <a href="#" class="text-xs text-muted-foreground hover:text-foreground">
            Privacy Policy
          </a>
          <a href="#" class="text-xs text-muted-foreground hover:text-foreground">
            Cookie Policy
          </a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    // Mobile menu toggle
    const menuToggle = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (event) => {
      if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
        mobileMenu.classList.remove('open');
      }
    });

    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>
</body>

</html>