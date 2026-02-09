<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Teacher-Student File Sharing System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container navbar-container">
           <img src="logo/favicon.png" alt="ok" />
            <div class="navbar-menu">
                <a href="index.php" class="btn btn-outline">Home</a>
                
                <a href="contact.php" class="btn btn-outline" style="border-color: var(--neon-blue); color: var(--neon-blue);">Contact</a>
            </div>
            <div class="navbar-actions">
                <a href="login.php" class="btn btn-outline">Login</a>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
            <button class="btn btn-icon navbar-menu-mobile" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="container">
            <div class="mobile-menu-items">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php" class="active">Contact</a>
                <div class="separator"></div>
                <a href="login.ph">Login</a>
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero contact-hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title neon-text">Contact <span style="color: var(--neon-blue);">Us</span></h1>
                <p class="hero-description">Have questions or feedback? We're here to help. Reach out to our team and we'll get back to you as soon as possible.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-form-container">
                    <h2 class="section-title">Send us a <span style="color: var(--neon-blue);">Message</span></h2>
                    <p class="section-description mb-6">
                        Fill out the form below and we'll get back to you as soon as possible.
                    </p>
                    <form id="contactForm" class="contact-form">
                        <div class="form-group">
                            <label for="name" class="label">Full Name</label>
                            <input type="text" id="name" name="name" class="input" placeholder="Your full name" required>
                            <div class="error-message" id="nameError"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="label">Email Address</label>
                            <input type="email" id="email" name="email" class="input" placeholder="Your email address" required>
                            <div class="error-message" id="emailError"></div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="label">Subject</label>
                            <input type="text" id="subject" name="subject" class="input" placeholder="What is this regarding?" required>
                            <div class="error-message" id="subjectError"></div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="label">Message</label>
                            <textarea id="message" name="message" class="textarea" placeholder="Your message" required></textarea>
                            <div class="error-message" id="messageError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-full" id="submitButton">
                            Send Message
                        </button>
                        <div id="formSuccess" class="success-message mt-4" style="display: none;">
                            Your message has been sent successfully! We'll get back to you soon.
                        </div>
                    </form>
                </div>
                <div class="contact-info">
                    <h2 class="section-title">Contact <span style="color: var(--neon-blue);">Information</span></h2>
                    <p class="section-description mb-6">
                        You can also reach us through the following channels.
                    </p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h3 class="contact-title">Address</h3>
                                <p class="contact-value">123 Education Street, Tech City, TC 12345</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h3 class="contact-title">Email</h3>
                                <p class="contact-value">support@edushare.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h3 class="contact-title">Phone</h3>
                                <p class="contact-value">+91 1234567890</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-text">
                                <h3 class="contact-title">Hours</h3>
                                <p class="contact-value">Monday - Friday: 9am - 5pm</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-map neon-border mt-8">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3611.1358137325788!2d75.8556881!3d25.164891599999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396f9af800ea5273%3A0x841f257b86f19d9e!2sGovernment%20polytechnic%20kota!5e0!3m2!1sen!2sin!4v1746876792930!5m2!1sen!2sin"" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title text-center">Frequently Asked <span style="color: var(--neon-blue);">Questions</span></h2>
            <p class="section-description text-center mx-auto" style="max-width: 800px;">
                Find answers to common questions about our platform.
            </p>
            
            <div class="faq-container mt-16">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>How do I register for an account?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            To register for an account, click on the "Register" button in the top navigation bar. Fill out the registration form with your details, including your role (teacher or student). Your registration will be pending until approved by an administrator.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>What file types can be uploaded and shared?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Our platform supports a wide range of file types, including PDFs, Word documents, Excel spreadsheets, PowerPoint presentations, images (JPEG, PNG, GIF), videos (MP4, AVI), and audio files (MP3, WAV).
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>How long does it take for registration approval?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Registration approval typically takes 24-48 hours. Once approved, you will receive an email notification with instructions to complete your registration.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Is there a limit to the file size I can upload?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, the current file size limit is 100MB per file. If you need to share larger files, please contact our support team for assistance.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>How secure is the platform?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            We take security seriously. All files are encrypted during transfer and storage. We use HTTPS for all communications, and our platform undergoes regular security audits to ensure your data remains protected.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>Can I organize files into folders?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Yes, teachers can create folders to organize their files by subject, class, or any other category. This makes it easier for students to find and access the materials they need.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-container">
                <div class="cta-content">
                    <div class="cta-text">
                        <h2 class="cta-title">Ready to transform your educational resource sharing?</h2>
                        <p class="cta-description">Join thousands of educators and students who are already benefiting from our platform.</p>
                    </div>
                    <div class="cta-actions">
                        <a href="register.html" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="#" class="btn btn-outline btn-lg">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3 class="footer-title">EduShare</h3>
                    <p class="footer-description">
                        A comprehensive file-sharing platform designed specifically for teachers and students.
                    </p>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Connect</h3>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; 2026 EduShare. All rights reserved.
                </p>
                <div class="footer-bottom-links">
                    <a href="#">Terms</a>
                    <a href="#">Privacy</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
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

        // FAQ toggle
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            const isOpen = faqItem.classList.contains('open');
            
            // Close all FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('open');
            });
            
            // Open the clicked FAQ if it wasn't already open
            if (!isOpen) {
                faqItem.classList.add('open');
            }
        }

        // Contact form validation
        const contactForm = document.getElementById('contactForm');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const subjectInput = document.getElementById('subject');
        const messageInput = document.getElementById('message');
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const subjectError = document.getElementById('subjectError');
        const messageError = document.getElementById('messageError');
        const formSuccess = document.getElementById('formSuccess');
        const submitButton = document.getElementById('submitButton');

        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Reset error messages
            nameError.textContent = '';
            emailError.textContent = '';
            subjectError.textContent = '';
            messageError.textContent = '';
            
            // Validate name
            if (nameInput.value.trim() === '') {
                nameError.textContent = 'Please enter your name';
                nameInput.focus();
                return;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                emailError.textContent = 'Please enter a valid email address';
                emailInput.focus();
                return;
            }
            
            // Validate subject
            if (subjectInput.value.trim() === '') {
                subjectError.textContent = 'Please enter a subject';
                subjectInput.focus();
                return;
            }
            
            // Validate message
            if (messageInput.value.trim() === '') {
                messageError.textContent = 'Please enter your message';
                messageInput.focus();
                return;
            }
            
            // Simulate form submission
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';
            
            setTimeout(() => {
                // Reset form
                contactForm.reset();
                
                // Show success message
                formSuccess.style.display = 'block';
                
                // Reset button
                submitButton.disabled = false;
                submitButton.textContent = 'Send Message';
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    formSuccess.style.display = 'none';
                }, 5000);
            }, 1500);
        });
    </script>
</body>
</html>
