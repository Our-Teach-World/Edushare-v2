<?php
// Base URL - Update this if your domain or folder structure changes
define('BASE_URL', 'http://localhost/drivedo/htdocs/');

// Navigation URLs
define('URL_HOME', BASE_URL . 'index.php');
define('URL_ABOUT', BASE_URL . 'about.php');
define('URL_CONTACT', BASE_URL . 'contact.php');

// Authentication URLs
define('URL_LOGIN', BASE_URL . 'login.php');
define('URL_REGISTER', BASE_URL . 'register.php');
define('URL_LOGOUT', BASE_URL . 'logout.php'); // Assuming logout functionality exists or will exist

// Dashboard URLs
define('URL_STUDENT_DASHBOARD', BASE_URL . 'student_dashboard.php');
define('URL_TEACHER_DASHBOARD', BASE_URL . 'teacher_dashboard.php');

// Admin URLs
define('URL_ADMIN_LOGIN', BASE_URL . 'min-dashboard/login.php');
define('URL_ADMIN_DASHBOARD', BASE_URL . 'min-dashboard/dashboard.php');

// Action/Process URLs (Form Actions)
define('URL_LOGIN_ACTION', BASE_URL . 'logindb.php');
define('URL_REGISTER_ACTION', BASE_URL . 'registerdb.php');

// Status/Helper URLs
define('URL_REGISTRATION_SUCCESS', BASE_URL . 'registration-success.php');
define('URL_USERNAME_EXISTS', BASE_URL . 'username-exists.php');
?>