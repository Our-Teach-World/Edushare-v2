<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$uploadDir = "uploads/";
$teachers = array_diff(scandir($uploadDir), ['.', '..']);
$selectedTeacher = isset($_GET['teacher']) ? $_GET['teacher'] : null;

// Fetch files for the selected teacher with pagination
// Fetch files for the selected teacher (Categorized)
$categorizedFiles = [];
$categories = ['documents', 'images', 'audio', 'video', 'others'];
$hasFiles = false;

if ($selectedTeacher && is_dir($uploadDir . $selectedTeacher)) {
    $teacherBase = $uploadDir . $selectedTeacher . "/";

    // Check for legacy files in root
    $rootFiles = array_diff(scandir($teacherBase), ['.', '..', 'profile.jpg', 'documents', 'images', 'audio', 'video', 'others']);
    foreach ($rootFiles as $file) {
        if (is_file($teacherBase . $file)) {
            $categorizedFiles['others'][] = $file;
            $hasFiles = true;
        }
    }

    // Check subfolders
    foreach ($categories as $cat) {
        $dir = $teacherBase . $cat . "/";
        if (is_dir($dir)) {
            $items = array_diff(scandir($dir), ['.', '..']);
            foreach ($items as $item) {
                $categorizedFiles[$cat][] = $item;
                $hasFiles = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Librarywithak</title>
    <link rel="stylesheet" href="styles/student-dashboard.css">
    <link rel="shortcut icon" type="image/png" href="logo/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF -->
</head>

<body>

    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
        <p>Select a teacher to view their uploaded files.</p>

        <h2>📚 Select a Teacher</h2>
        <input type="text" id="searchTeacher" placeholder="Search Teacher...">
        <div class="teacher-list">
            <?php foreach ($teachers as $teacher): ?>
                <?php
                $profilePic = $uploadDir . $teacher . "/profile.jpg";
                if (!file_exists($profilePic)) {
                    $profilePic = "default-profile.jpg"; // Default profile image if not found
                }
                ?>
                <div class="teacher-profile">
                    <img src="<?= htmlspecialchars($profilePic) ?>" class="teacher-pic" alt="Profile">
                    <h3><?= htmlspecialchars($teacher) ?></h3>
                    <a href="?teacher=<?= urlencode($teacher) ?>" class="view-files-btn">View Files</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($selectedTeacher): ?>
            <?php
            $activeFolder = isset($_GET['folder']) ? $_GET['folder'] : null;
            $mapFolderNames = [
                'documents' => 'PDFs & Docs',
                'video' => 'Videos',
                'audio' => 'Audio',
                'images' => 'Images'
            ];
            // Only allow valid folders
            if ($activeFolder && !array_key_exists($activeFolder, $mapFolderNames)) {
                $activeFolder = null;
            }
            ?>

            <?php if (!$activeFolder): ?>
                <!-- Folder View -->
                <h2>📂 Browse Folders</h2>
                <div class="folder-grid">
                    <a href="?teacher=<?= urlencode($selectedTeacher) ?>&folder=documents" class="folder-card">
                        <div class="folder-icon">📄</div>
                        <div class="folder-name">PDFs & Docs</div>
                    </a>
                    <a href="?teacher=<?= urlencode($selectedTeacher) ?>&folder=video" class="folder-card">
                        <div class="folder-icon">🎥</div>
                        <div class="folder-name">Videos</div>
                    </a>
                    <a href="?teacher=<?= urlencode($selectedTeacher) ?>&folder=audio" class="folder-card">
                        <div class="folder-icon">🎵</div>
                        <div class="folder-name">Audio</div>
                    </a>
                    <a href="?teacher=<?= urlencode($selectedTeacher) ?>&folder=images" class="folder-card">
                        <div class="folder-icon">🖼️</div>
                        <div class="folder-name">Images</div>
                    </a>
                </div>

                <!-- Legacy/Uncategorized Files -->
                <?php if (!empty($categorizedFiles['others'])): ?>
                    <h3 style="margin-top: 30px;">Other Files</h3>
                    <ul class="file-list">
                        <?php foreach ($categorizedFiles['others'] as $file): ?>
                            <li>
                                <a href="<?= $uploadDir . $selectedTeacher . '/' . $file ?>" download><?= htmlspecialchars($file) ?></a>
                                <button class="pre-btn"
                                    onclick="previewFile('<?= $uploadDir . $selectedTeacher . '/' . $file ?>')">Preview</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            <?php else: ?>
                <!-- File View -->
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <a href="?teacher=<?= urlencode($selectedTeacher) ?>" class="back-link">⬅ Back to Folders</a>
                    <h2 style="margin: 0;">📂 <?= $mapFolderNames[$activeFolder] ?></h2>
                </div>

                <input type="text" id="searchFiles" placeholder="Search Files...">

                <?php
                $currentFiles = $categorizedFiles[$activeFolder] ?? [];
                ?>

                <?php if (empty($currentFiles)): ?>
                    <p class="empty-msg">No files in this folder.</p>
                <?php else: ?>
                    <ul class="file-list">
                        <?php foreach ($currentFiles as $file): ?>
                            <?php
                            $downloadLink = $uploadDir . $selectedTeacher . '/' . $activeFolder . '/' . $file;
                            ?>
                            <li>
                                <a href="<?= $downloadLink ?>" download><?= htmlspecialchars($file) ?></a>
                                <button class="pre-btn" onclick="previewFile('<?= $downloadLink ?>')">Preview</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            <?php endif; ?>

        <?php endif; ?>

        <style>
            .folder-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }

            .folder-card {
                background: white;
                padding: 20px;
                border-radius: 12px;
                text-align: center;
                text-decoration: none;
                color: #333;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                transition: transform 0.2s, box-shadow 0.2s;
                border: 1px solid #eee;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .folder-card:hover {
                transform: translateY(-5px);
                box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
                border-color: #000000;
            }

            .folder-icon {
                font-size: 3rem;
            }

            .folder-name {
                font-weight: 600;
                font-size: 1.1rem;
            }

            .back-link {
                text-decoration: none;
                background: #eee;
                padding: 8px 15px;
                border-radius: 8px;
                color: #333;
                font-weight: 500;
                transition: background 0.2s;
            }

            .back-link:hover {
                background: #ddd;
            }

            .empty-msg {
                color: #888;
                font-style: italic;
                padding: 20px;
                text-align: center;
                background: rgba(255, 255, 255, 0.5);
                border-radius: 8px;
            }
        </style>

        <a href="login.php" class="logout-btn">Logout</a>
    </div>
    <!-- Modal for Preview -->
    <div id="fileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe id="fileFrame" src="" frameborder="0"></iframe>
        </div>
    </div>


    <!-- Chat Trigger Button -->
    <button id="chat-trigger" onclick="toggleChat()">
        💬
    </button>

    <!-- Chat Sidebar -->
    <div id="chat-widget">
        <div id="sidebar-resizer" class="resizer"></div>
        <div class="chat-header">
            <h3>🤖 AI Tutor</h3>
            <div style="display: flex; gap: 10px; align-items: center;">
                <a href="chat_window.php" target="_blank" title="Open in New Tab"
                    style="text-decoration: none; font-size: 20px; color: white;">↗️</a>
                <button class="toggle-btn" onclick="toggleChat()"
                    style="font-size: 24px; background:none; border:none; color:white; cursor:pointer;">&times;</button>
            </div>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Messages will appear here -->
            <div class="message ai-message">
                Hello! 👋 I'm your AI Tutor. I can help you with your course materials. Ask me anything!
            </div>
        </div>
        <div class="chat-input-area">
            <input type="text" id="chat-input" placeholder="Type a message..." onkeypress="handleEnter(event)">
            <button onclick="sendMessage()">➤</button>
        </div>
    </div>

    <style>
        .container {
            transition: margin-right 0.3s ease-in-out;
            /* Smooth resize */
            width: auto;
            /* Ensure it takes available width */
        }

        /* Sidebar Chat Widget (Right Side - Copilot Style) */
        #chat-widget {
            position: fixed;
            top: 0;
            right: -100%;
            /* Hidden off-screen to the right */
            width: 400px;
            /* Default width */
            min-width: 300px;
            max-width: 800px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            z-index: 9999;
            transition: right 0.3s ease-in-out;
            /* Smooth slide */
            border-left: 1px solid var(--border);
        }

        #chat-widget.sidebar-open {
            right: 0;
        }

        #chat-widget.resizing {
            transition: none;
            /* Disable transition during drag for responsiveness */
        }

        /* Resize Handle */
        .resizer {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            cursor: ew-resize;
            background: transparent;
            z-index: 10000;
        }

        .resizer:hover,
        .resizing .resizer {
            background: rgba(0, 0, 0, 0.1);
            /* Highlight on hover/drag */
        }

        /* Trigger Button (Floating Action Button) */
        #chat-trigger {
            position: fixed;
            bottom: 30px;
            right: 30px;
            /* Right side trigger */
            width: 60px;
            height: 60px;
            background: #ffffff;
            border-radius: 50%;
            border: 2px solid #000000;
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 10000;
            transition: transform 0.2s;
            color: #000000;
            font-size: 30px;
        }

        #chat-trigger:hover {
            transform: scale(1.1);
        }

        .chat-header {
            background: #ffffff;
            color: #000000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000000;
        }

        .chat-messages {
            flex: 1;
            /* Take remaining height */
            overflow-y: auto;
            padding: 20px;
            /* Subtle gradient background to reduce "whiteness" */
            background: linear-gradient(180deg, #f0f4f8 0%, #e6efff 100%);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            padding: 10px 15px;
            border-radius: 18px;
            max-width: 85%;
            font-size: 14px;
            line-height: 1.4;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .user-message {
            align-self: flex-end;
            background: #f4f4f5;
            color: #000000;
            border-bottom-right-radius: 4px;
            border: 1px solid #e4e4e7;
        }

        .ai-message {
            align-self: flex-start;
            background: white;
            color: #333;
            border-bottom-left-radius: 4px;
            border: 1px solid #eee;
        }

        .chat-input-area {
            padding: 15px;
            background: white;
            border-top: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-input-area input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            outline: none;
            transition: border-color 0.3s;
            font-size: 14px;
            background: #ffffff;
            /* Explicit White */
            color: #333333;
            /* Explicit Dark Grey */
        }

        .loading-message {
            font-style: italic;
            color: #888;
            background: #f9f9f9;
            border: 1px dashed #ccc;
        }

        .chat-input-area input:focus {
            border-color: #000000;
        }

        .chat-input-area button {
            background: #ffffff;
            color: #000000;
            border: 2px solid #000000;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 2px 2px 0px rgba(0, 0, 0, 1);
            transition: transform 0.2s;
            font-size: 18px;
            /* For emoji */
        }

        .chat-input-area button:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        function toggleChat() {
            const widget = document.getElementById('chat-widget');
            const container = document.querySelector('.container');
            const trigger = document.getElementById('chat-trigger');
            widget.classList.toggle('sidebar-open');

            if (widget.classList.contains('sidebar-open')) {
                // Get current width of widget and set margin
                const width = widget.offsetWidth;
                container.style.marginRight = width + 'px';
                if (trigger) trigger.style.display = 'none';
            } else {
                container.style.marginRight = '0';
                if (trigger) trigger.style.display = 'flex';
            }
        }

        // Resizable Logic
        document.addEventListener('DOMContentLoaded', () => {
            const widget = document.getElementById('chat-widget');
            const resizer = document.getElementById('sidebar-resizer');
            const container = document.querySelector('.container');
            let isResizing = false;

            if (!resizer) return;

            resizer.addEventListener('mousedown', (e) => {
                isResizing = true;
                widget.classList.add('resizing');
                document.body.style.cursor = 'ew-resize';
                // Prevent text selection during drag
                e.preventDefault();
            });

            document.addEventListener('mousemove', (e) => {
                if (!isResizing) return;
                // Calculate new width: Window Width - Mouse X Position
                // Since it's on the right, width = Total Width - Mouse X
                const newWidth = window.innerWidth - e.clientX;

                // Apply limits (Min 300px, Max 1000px)
                if (newWidth > 300 && newWidth < 1200) {
                    widget.style.width = newWidth + 'px';
                    // Dynamically adjust container margin
                    if (widget.classList.contains('sidebar-open')) {
                        container.style.marginRight = newWidth + 'px';
                    }
                }
            });

            document.addEventListener('mouseup', () => {
                if (isResizing) {
                    isResizing = false;
                    widget.classList.remove('resizing');
                    document.body.style.cursor = 'default';
                }
            });
        });

        function handleEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }

        let activeContextFiles = [];
        let chatHistory = [];

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            if (!message) return;

            // Add user message to UI
            addMessage(message, 'user-message');
            input.value = '';

            // Update history
            chatHistory.push({
                role: 'user', text: message
            });
            // Keep history limited to last 10 turns to avoid huge payloads
            if (chatHistory.length > 10) chatHistory = chatHistory.slice(-10);

            // Show loading state
            const loadingId = addMessage('Thinking...', 'ai-message loading-message');

            try {
                const response = await fetch('chat_api.php', {

                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }

                    ,
                    body: JSON.stringify({
                        message: message,
                        history: chatHistory,
                        contextFiles: activeContextFiles
                    })
                });

                const data = await response.json();

                // Remove loading message
                const loader = document.getElementById(loadingId);
                if (loader) loader.remove();

                if (data.error) {
                    addMessage('Error: ' + data.error, 'ai-message');
                }

                else {
                    if (data.sources) {
                        activeContextFiles = data.sources;
                    }

                    addMessage(data.reply, 'ai-message');

                    // Update history
                    chatHistory.push({
                        role: 'model', text: data.reply
                    });

                    // Show sources if any
                    if (data.sources && data.sources.length > 0) {
                        const uniqueSources = [...new Set(data.sources)]; // Deduplicate
                        activeContextFiles = uniqueSources; // Update context persistence
                        const sourceText = '📚 Sources: ' + uniqueSources.join(', ');
                        const sourceId = addMessage(sourceText, 'ai-message');
                        const sourceElem = document.getElementById(sourceId);
                        sourceElem.style.fontSize = '12px';
                        sourceElem.style.fontStyle = 'italic';
                        sourceElem.style.color = '#555';
                    }
                }
            }

            catch (error) {
                const loader = document.getElementById(loadingId);
                if (loader) loader.remove();
                addMessage('Error connecting to AI.', 'ai-message');
            }
        }

        // TTS Function: Speak the text using Web Speech API
        function speakText(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();

                // Clean text: Remove markdown (*, #, etc) for better speech
                const cleanText = text.replace(/\*/g, '').replace(/#/g, '').replace(/`/g, '');

                const utterance = new SpeechSynthesisUtterance(cleanText);

                // Detect Hindi characters (Devanagari script range)
                const hasHindi = /[\u0900-\u097F]/.test(cleanText);

                // Function to set voice and speak
                const setVoiceAndSpeak = () => {
                    const voices = window.speechSynthesis.getVoices();

                    if (hasHindi) {
                        utterance.lang = 'hi-IN';
                        // Prioritize Google Hindi or Microsoft Hindi voices
                        const hindiVoice = voices.find(v => v.lang.includes('hi') || v.name.includes('Hindi'));
                        if (hindiVoice) {
                            utterance.voice = hindiVoice;
                        }
                    } else {
                        utterance.lang = 'en-US';
                    }
                    window.speechSynthesis.speak(utterance);
                };

                // Voices load asynchronously in some browsers (Chrome)
                if (window.speechSynthesis.getVoices().length === 0) {
                    window.speechSynthesis.onvoiceschanged = setVoiceAndSpeak;
                } else {
                    setVoiceAndSpeak();
                }

            } else {
                alert("Sorry, your browser doesn't support Text-to-Speech.");
            }
        }

        function addMessage(text, className) {
            const messagesDiv = document.getElementById('chat-messages');
            const msgDiv = document.createElement('div');
            const id = 'msg-' + Date.now();
            msgDiv.id = id;

            msgDiv.className = `message ${className}`;

            // If it's an AI message, add a Speak button
            // Skip for loading or usage messages
            if (className.includes('ai-message') && !className.includes('loading-message') && !text.startsWith('📚 Sources:')) {
                // We use a container to hold text and the button
                const contentSpan = document.createElement('span');
                contentSpan.textContent = text;
                msgDiv.appendChild(contentSpan);

                const speakBtn = document.createElement('button');
                speakBtn.innerHTML = '🔊';
                speakBtn.style.marginLeft = '10px';
                speakBtn.style.background = 'none';
                speakBtn.style.border = 'none';
                speakBtn.style.cursor = 'pointer';
                speakBtn.style.fontSize = '16px';
                speakBtn.title = "Read Aloud";
                speakBtn.onclick = () => speakText(text);
                msgDiv.appendChild(speakBtn);

                // Add PDF Button
                const pdfBtn = document.createElement('button');
                pdfBtn.innerHTML = '📄';
                pdfBtn.style.marginLeft = '10px';
                pdfBtn.style.background = 'none';
                pdfBtn.style.border = 'none';
                pdfBtn.style.cursor = 'pointer';
                pdfBtn.style.fontSize = '16px';
                pdfBtn.title = "Download as PDF";
                pdfBtn.onclick = () => downloadPDF(text);
                msgDiv.appendChild(pdfBtn);

            } else {
                msgDiv.textContent = text;
            }

            messagesDiv.appendChild(msgDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            return id;
        }

        function downloadPDF(text) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Clean markdown for PDF
            const cleanText = text.replace(/[#*`]/g, '');

            // Wrap text to fit page
            const pageWidth = doc.internal.pageSize.getWidth();
            const margin = 10;
            const maxLineWidth = pageWidth - (margin * 2);
            const splitText = doc.splitTextToSize(cleanText, maxLineWidth);

            doc.text(splitText, margin, margin + 10);
            doc.save('AI-Tutor-Response.pdf');
        }

        // --- Existing Script Content ---
        function previewFile(fileUrl) {
            window.open(fileUrl, '_blank');
        }

        document.getElementById('searchTeacher')?.addEventListener('input', function () {
            let term = this.value.toLowerCase();

            document.querySelectorAll('.teacher-profile').forEach(profile => {
                profile.style.display = profile.textContent.toLowerCase().includes(term) ? 'block' : 'none';
            });
        });

        document.getElementById('searchFiles')?.addEventListener('input', function () {
            let term = this.value.toLowerCase();

            document.querySelectorAll('.file-list li').forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(term) ? 'flex' : 'none';
            });
        });
    </script>
</body>

</html>