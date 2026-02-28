<?php
session_start();
require 'vendor/autoload.php'; // Load Composer dependencies
include 'db_connect.php'; // Database connection


$username = $_SESSION['username'];
$uploadDir = "uploads/" . preg_replace('/[^a-zA-Z0-9_]/', '', $username) . "/";
$profileImg = $uploadDir . "profile.jpg";
$nameFile = $uploadDir . "name.txt";

// Create upload directory
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Initialize name file
if (!file_exists($nameFile)) {
    file_put_contents($nameFile, $username);
}
$displayName = file_get_contents($nameFile);

// Handle name update
if (isset($_POST['updateName'])) {
    $newName = htmlspecialchars($_POST['name']);
    file_put_contents($nameFile, $newName);
    $displayName = $newName;
}

// Handle profile image upload
if (isset($_POST['updateImage'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp', 'image/bmp'];
    $detectedType = mime_content_type($_FILES['profileImage']['tmp_name']);

    if (in_array($detectedType, $allowedTypes)) {
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImg);
    }
}

// Handle file upload
if (isset($_FILES['file'])) {
    $allowedExtensions = ['pdf', 'xlsx', 'docx', 'pptx', 'txt', 'png', 'jpg', 'mp3', 'mp4', 'zip', 'jpeg', 'mkv', 'xlsx', 'rar', 'svg'];
    $maxFileSize = 10 * 1024 * 1024; // 10MB

    $fileName = basename($_FILES['file']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileSize = $_FILES['file']['size'];

    if (!in_array($fileExt, $allowedExtensions)) {
        die("Invalid file type");
    }

    if ($fileSize > $maxFileSize) {
        die("File too large (max 10MB)");
    }

    // Determine Category
    $category = 'others';
    $docTypes = ['pdf', 'xlsx', 'docx', 'pptx', 'txt', 'xlsx'];
    $imgTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp'];
    $audioTypes = ['mp3', 'wav', 'ogg'];
    $videoTypes = ['mp4', 'mkv', 'webm', 'avi'];

    if (in_array($fileExt, $docTypes))
        $category = 'documents';
    elseif (in_array($fileExt, $imgTypes))
        $category = 'images';
    elseif (in_array($fileExt, $audioTypes))
        $category = 'audio';
    elseif (in_array($fileExt, $videoTypes))
        $category = 'video';

    $targetDir = $uploadDir . $category . "/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $targetFile = $targetDir . $fileName;

    // Check if file exists to avoid overwrite or handle renaming (optional, but good practice. For now overwriting is fine or simple check)
    // Proceeding with overwrite as per original logic

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {

        // Extract text if PDF
        $extractedText = "";
        if ($fileExt === 'pdf') {
            try {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf = $parser->parseFile($targetFile);
                $extractedText = $pdf->getText();
            } catch (Exception $e) {
                $extractedText = ""; // Fail silently for now
            }
        }

        // Save to Database
        $stmt_user = $conn->prepare("SELECT id FROM auth WHERE username = ?");
        $stmt_user->bind_param("s", $username);
        $stmt_user->execute();
        $res_user = $stmt_user->get_result();
        $user_id = ($res_user && $row = $res_user->fetch_assoc()) ? $row['id'] : 0; // Default to 0 if not found

        $stmt = $conn->prepare("INSERT INTO uploads (user_id, filename, filepath, extracted_text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $fileName, $targetFile, $extractedText);
        $stmt->execute();
        $stmt->close();
    }
}

// Handle file delete
if (isset($_POST['deleteFile'])) {
    // Delete file expects relative path from uploadDir now? 
    // Actually the button will iterate files and we need to pass the category + filename
    // Let's expect 'category/filename' in deleteFile POST
    $fileToDeleteRel = $_POST['deleteFile'];
    $fileToDelete = realpath($uploadDir . $fileToDeleteRel);

    // Security check: ensure it is within uploadDir
    if ($fileToDelete && strpos($fileToDelete, realpath($uploadDir)) === 0 && file_exists($fileToDelete)) {
        unlink($fileToDelete);
        // Clean up from DB too ideally, but original code didn't. Stick to file deletion.
    }
}


// Fetch files by category
$categories = ['documents', 'images', 'audio', 'video', 'others'];
$categorizedFiles = [];

foreach ($categories as $cat) {
    $dir = $uploadDir . $cat . "/";
    if (is_dir($dir)) {
        $items = array_diff(scandir($dir), ['.', '..']);
        foreach ($items as $item) {
            $categorizedFiles[$cat][] = $item;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
    <title>Teacher Dashboard - Secure File Manager</title>
    <style>
        /* Theme Variables */
        :root {
            --bg: #ffffff;
            --fg: #09090b;
            --accent: #000000;
            --accent-dark: #18181b;
            --neon: #000000;
            --neon-hover: #18181b;
            --shadow: rgba(0, 0, 0, 1);
            --border: #e4e4e7;
        }

        [data-theme="dark"] {
            --bg: #ffffff;
            --fg: #09090b;
            --accent: #000000;
            --accent-dark: #18181b;
            --neon: #000000;
            --neon-hover: #18181b;
            --shadow: rgba(0, 0, 0, 1);
            --border: #e4e4e7;
        }

        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg);
            color: var(--fg);
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .theme-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--accent);
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
            box-shadow: 2px 2px 0px var(--neon);
        }

        input:checked+.slider {
            background-color: var(--accent-dark);
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        /* Profile Section */
        .profile-section {
            background: var(--bg);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
            border: 2px solid #000000;
        }

        .profile-pic {
            text-align: center;
            flex: 1 1 300px;
            position: relative;
        }

        .profile-pic img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid var(--neon);
            object-fit: cover;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 2px 2px 0px var(--neon);
        }

        .profile-pic img:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px 0px var(--neon-hover);
        }

        .profile-pic input[type="file"] {
            margin: 10px 0;
            background: var(--bg);
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }

        .profile-info {
            flex: 1 1 300px;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 12px;
            margin: 10px 0;
            border: 2px solid var(--neon);
            border-radius: 8px;
            background: var(--bg);
            color: var(--fg);
            transition: all 0.3s ease;
            outline: none;
        }


        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #000000;
            border-radius: 5px;
            background: #ffffff;
            color: #09090b;
        }

        button {
            background: #ffffff;
            color: #000000;
            border: 2px solid #000000;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 2px 2px 0px var(--neon);
            font-weight: bold;
        }

        button:hover {
            transform: translateY(-2px);
            background: #000000;
            color: #ffffff;
        }

        /* File Management */
        .search-container {
            position: relative;
            margin: 20px 0;
        }

        #fileSearch {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--neon);
            border-radius: 8px;
            background: var(--bg);
            color: var(--fg);
            font-size: 1em;
            transition: all 0.3s ease;
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
        }

        #fileSearch:focus {
            box-shadow: 4px 4px 0px rgba(0, 0, 0, 1);
            border-color: var(--neon);
        }

        .search-stats {
            display: none;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
            color: var(--neon);
            font-weight: bold;
        }



        .clear-btn {
            background: transparent;
            color: var(--neon);
            border: 1px solid var(--neon);
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clear-btn:hover {
            background: var(--neon);
            color: var(--bg);
        }

        .file-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            border-top: 2px solid var(--neon);
        }

        .file-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
            position: relative;
            transition: transform 0.2s ease;
        }

        .file-list li:hover {
            transform: scale(1.02);
            box-shadow: 2px 2px 0px var(--neon);
        }

        .file-list li::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50px;
            width: 10px;
            height: 100%;
            background: linear-gradient(transparent 50%, var(--neon) 50%);
            animation: line-flow 2s linear infinite;
        }

        @keyframes line-flow {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .file-list a {
            color: var(--neon);
            text-decoration: none;
            flex: 1;
            margin-right: 15px;
            position: relative;
            transition: all 0.3s ease;
        }

        .file-list a:hover {
            text-shadow: 1px 1px 0px var(--neon);
        }

        .file-list span {
            color: #71717a;
            margin-right: 15px;
            font-size: 0.9em;
        }

        .inline-form {
            display: inline;
            margin-left: 10px;
        }

        .delete-btn {
            background: #ffffff;
            color: #dc2626;
            border: 2px solid #dc2626;
            box-shadow: 2px 2px 0px #dc2626;
        }

        .delete-btn:hover {
            background: #dc2626;
            color: #ffffff;
            animation: none;
        }

        @keyframes pulse-red {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Logout Button */
        .logout-btn {
            background: #ffffff;
            border: 2px solid #000000;
            padding: 14px 30px;
            border-radius: 8px;
            text-decoration: none;
            color: #000000;
            display: inline-block;
            margin-top: 20px;
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            background: #000000;
            color: #ffffff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
            }

            input[type="text"] {
                width: 100%;
            }
        }

        /* No Results */
        #noResults {
            display: none;
            text-align: center;
            color: var(--neon);
            font-size: 1.2em;
            animation: pulse 2s infinite;
            margin: 20px 0;
        }

        @keyframes pulse {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        /* Upload Overlay */
        .upload-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid #e4e4e7;
            border-top: 5px solid var(--neon);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
            box-shadow: 0 0 0px var(--neon);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .upload-text {
            color: var(--neon);
            font-family: 'Arial', sans-serif;
            font-size: 1.5em;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 0px var(--neon);
            animation: pulse-text 1.5s infinite;
        }

        @keyframes pulse-text {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>

<body>
    <div class="theme-toggle">
        <label class="theme-switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider"></span>
        </label>
    </div>

    <div class="container">
        <div class="profile-section">
            <form action="" id="profileForm" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <div class="profile-pic">
                    <img src="<?= file_exists($profileImg) ? $profileImg : 'logo/try.png' ?>" alt="Profile">
                    <input type="file" name="profileImage" accept="image/*" id="profileImage">
                    <button type="submit" name="updateImage">Update Image</button>
                </div>

                <div class="profile-info">
                    <input type="text" name="name" id="nameInput" value="<?= htmlspecialchars($displayName) ?>"
                        placeholder="Your Name">
                    <button type="submit" name="updateName" id="updateNameBtn">Save Name</button>
                </div>
            </form>
        </div>
        <h2>📂 File Manager</h2>
        <h2>📂 File Manager</h2>
        <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="file" name="file" required>
            <button type="submit" required>Upload File</button>
        </form>

        <div class="search-container">
            <input type="text" id="fileSearch" placeholder="🔍 Search files...">
        </div>

        <?php foreach ($categorizedFiles as $category => $files): ?>
            <?php if (!empty($files)): ?>
                <h3 style="color: var(--neon); margin-top: 20px; text-transform: capitalize;">📂 <?= $category ?></h3>
                <ul class="file-list">
                    <?php foreach ($files as $file): ?>
                        <li data-filename="<?= strtolower($file) ?>">
                            <a href="<?= $uploadDir . $category . '/' . $file ?>" download><?= htmlspecialchars($file) ?></a>
                            <span>(<?= round(filesize($uploadDir . $category . '/' . $file) / 1024, 2) ?> KB)</span>
                            <form action="" method="post" class="inline-form">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <input type="hidden" name="deleteFile" value="<?= $category . '/' . $file ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (empty($categorizedFiles)): ?>
            <p style="text-align: center; color: #888;">No files uploaded yet.</p>
        <?php endif; ?>

        <a href="index.php" class="logout-btn">Logout</a>

        <!-- Upload Loading Overlay -->
        <div id="uploadOverlay" class="upload-overlay">
            <div class="spinner"></div>
            <div class="upload-text">Uploading...</div>
        </div>
    </div>

    <script>
        // Theme Switcher
        document.getElementById('theme-toggle').addEventListener('change', function () {
            const theme = this.checked ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });

        // Search Functionality
        document.getElementById('fileSearch').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const fileList = document.getElementById('fileList').children;

            Array.from(fileList).forEach(item => {
                const filename = item.getAttribute('data-filename');
                item.style.display = filename.includes(searchTerm) ? 'flex' : 'none';
            });
        });

        // Persist theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
        document.getElementById('theme-toggle').checked = savedTheme === 'light';


        document.getElementById('profileForm').addEventListener('submit', function (e) {
            const activeBtn = document.activeElement;
            const fileInput = document.getElementById('profileImage');

            // If "Update Image" was clicked
            if (activeBtn && activeBtn.name === 'updateImage') {
                if (!fileInput.value) {
                    e.preventDefault(); // Stop form from submitting
                    alert("Please choose file for update photo.");
                }
            }
        });

        // Upload Animation Trigger
        document.getElementById('uploadForm').addEventListener('submit', function () {
            const fileInput = this.querySelector('input[type="file"]');
            if (fileInput.files.length > 0) {
                document.getElementById('uploadOverlay').style.display = 'flex';
            }
        });
    </script>
</body>

</html>