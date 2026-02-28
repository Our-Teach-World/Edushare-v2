<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EduShare</title>
    <link rel="stylesheet" href="styles/index.css">
    <!-- iconv -->
    <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* About Page Specific Styles - Black and White Theme */
        .about-header {
            padding: 100px 0 60px;
            background: #f4f4f5;
            text-align: center;
            border-bottom: 1px solid #e4e4e7;
        }

        .about-title {
            font-size: 3rem;
            font-weight: 800;
            color: #09090b;
            margin-bottom: 20px;
        }

        .about-subtitle {
            font-size: 1.2rem;
            color: #71717a;
            max-width: 600px;
            margin: 0 auto;
        }

        .about-content-section {
            padding: 80px 0;
            background: #ffffff;
        }

        .about-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        @media (max-width: 768px) {
            .about-content-grid {
                grid-template-columns: 1fr;
            }
        }

        .about-text h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #000000;
            margin-bottom: 20px;
        }

        .about-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #3f3f46;
            margin-bottom: 15px;
        }

        .about-image {
            background: #f4f4f5;
            border: 2px solid #000000;
            box-shadow: 8px 8px 0px rgba(0, 0, 0, 1);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            font-size: 4rem;
            color: #09090b;
        }

        .mission-section {
            padding: 80px 0;
            background: #09090b;
            color: #ffffff;
            text-align: center;
        }

        .mission-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .mission-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .mission-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #e4e4e7;
        }

        .values-section {
            padding: 80px 0;
            background: #ffffff;
        }

        .values-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .values-header h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #000000;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .value-card {
            background: #ffffff;
            border: 2px solid #000000;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 6px 6px 0px rgba(0, 0, 0, 1);
        }

        .value-icon {
            font-size: 2.5rem;
            color: #000000;
            margin-bottom: 20px;
        }

        .value-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #09090b;
            margin-bottom: 15px;
        }

        .value-desc {
            color: #71717a;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="container navbar-container">
            <img src="logo/favicon.png" alt="ok" />

            <nav class="navbar-menu">
                <ul class="flex gap-4">
                    <li><a href="index.php" class="tab">Home</a></li>
                    <li><a href="about.php" class="tab active">About</a></li>
                    <li><a href="contact.php" class="tab">Contact</a></li>
                </ul>
            </nav>

            <div class="navbar-actions">
                <a href="login.php" class="btn">Login</a>
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
                    <a href="about.php" class="active">About</a>
                    <a href="contact.php">Contact</a>
                    <div class="separator"></div>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- About Header -->
        <section class="about-header">
            <div class="container">
                <h1 class="about-title">Empowering Education</h1>
                <p class="about-subtitle">We build tools that connect teachers and students to make learning accessible,
                    collaborative, and efficient for everyone.</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="about-content-section">
            <div class="container">
                <div class="about-content-grid">
                    <div class="about-text">
                        <h2>Our Story</h2>
                        <p>
                            EduShare was born out of a simple idea: that educational resources should be easy to share,
                            manage, and access. We noticed how traditional methods of distributing course materials were
                            often cluttered and confusing for both educators and learners.
                        </p>
                        <p>
                            By combining robust file management features with an intuitive design, we created a platform
                            that lets teachers focus on teaching and students focus on learning. Whether it's lecture
                            slides, reading assignments, or multimedia assets, EduShare keeps everything organized in
                            one secure place.
                        </p>
                    </div>
                    <div class="about-image">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section">
            <div class="container mission-container">
                <h2 class="mission-title">Our Mission</h2>
                <p class="mission-text">
                    To democratize access to quality education by providing a seamless, secure, and intelligent platform
                    for resource sharing between educators and learners globally. We believe technology should eliminate
                    barriers to learning, not create them.
                </p>
            </div>
        </section>

        <!-- Values Section -->
        <section class="values-section">
            <div class="container">
                <div class="values-header">
                    <h2>Core Values</h2>
                </div>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3 class="value-title">Security First</h3>
                        <p class="value-desc">Protecting user data and educational materials is our top priority. We
                            ensure every file shared is safe and restricted to authorized users.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon"><i class="fas fa-bolt"></i></div>
                        <h3 class="value-title">Simplicity</h3>
                        <p class="value-desc">Powerful tools don't have to be complicated. We design our software with a
                            clean, minimal aesthetic that everyone can navigate.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon"><i class="fas fa-users"></i></div>
                        <h3 class="value-title">Collaboration</h3>
                        <p class="value-desc">Education is a collective effort. We build features that foster
                            communication and teamwork between teachers and their students.</p>
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
                    <h3 class="text-lg font-bold" style="color: #000000;">EduShare</h3>
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
                <p class="text-xs text-muted-foreground">© <span id="currentYear"></span> EduShare. All rights reserved.
                </p>
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