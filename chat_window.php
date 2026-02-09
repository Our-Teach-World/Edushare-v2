<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Tutor | Learning Assistant</title>
    <link rel="shortcut icon" type="image/png" href="logo/favicon.png">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> <!-- For Markdown Rendering -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF -->

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --ai-bubble: #ffffff;
            --user-bubble: #2563eb;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-main);
        }

        /* Header Navigation */
        .chat-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
            z-index: 10;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary);
        }

        .back-btn {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
        }

        .back-btn:hover {
            background: #f1f5f9;
            color: var(--text-main);
        }

        /* Message Area */
        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 2rem 1rem;
            scroll-behavior: smooth;
        }

        .chat-wrapper {
            max-width: 850px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .message {
            max-width: 85%;
            padding: 14px 20px;
            border-radius: 18px;
            font-size: 15px;
            line-height: 1.6;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-message {
            align-self: flex-end;
            background: var(--user-bubble);
            color: white;
            border-bottom-right-radius: 4px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .ai-message {
            align-self: flex-start;
            background: var(--ai-bubble);
            color: var(--text-main);
            border-bottom-left-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Markdown Styles inside AI Message */
        .ai-message p {
            margin: 0 0 10px 0;
        }

        .ai-message code {
            background: #f1f5f9;
            padding: 2px 5px;
            border-radius: 4px;
            font-family: monospace;
        }

        .ai-message pre {
            background: #1e293b;
            color: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            overflow-x: auto;
        }

        /* Input Area */
        .input-area {
            background: white;
            padding: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .input-wrapper {
            max-width: 850px;
            margin: 0 auto;
            display: flex;
            gap: 12px;
            position: relative;
        }

        #chat-input {
            flex: 1;
            padding: 14px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            outline: none;
            font-size: 15px;
            transition: border-color 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        #chat-input:focus {
            border-color: var(--primary);
        }

        .send-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0 24px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        .send-btn:hover {
            background: var(--primary-hover);
        }

        /* Utility */
        .loading-dots {
            display: inline-block;
            font-weight: bold;
            color: var(--text-muted);
        }

        .sources-tag {
            font-size: 12px;
            margin-top: 8px;
            color: var(--text-muted);
            display: block;
            border-top: 1px solid #eee;
            padding-top: 8px;
        }

        .speak-btn {
            background: #f1f5f9;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .speak-btn:hover {
            background: #e2e8f0;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="chat-header">
        <div class="header-title">
            <span>🤖</span>
            <span>AI Tutor Assistant</span>
        </div>
        <a href="student_dashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>

    <div class="chat-container" id="chat-container">
        <div class="chat-wrapper" id="chat-messages">
            <!-- Initial Message -->
            <div class="message ai-message">
                Hello <strong><?= htmlspecialchars($username) ?></strong>! 👋 I'm your AI Tutor.
                How can I help you with your course materials today?
            </div>
        </div>
    </div>

    <div class="input-area">
        <div class="input-wrapper">
            <input type="text" id="chat-input" placeholder="Ask anything about your courses..."
                onkeypress="handleEnter(event)" autofocus>
            <button class="send-btn" onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        let chatHistory = [];
        let activeContextFiles = [];

        function handleEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            if (!message) return;

            addMessage(message, 'user-message');
            input.value = '';

            chatHistory.push({ role: 'user', text: message });

            // Add thinking placeholder
            const loadingId = addMessage('<span class="loading-dots">Thinking...</span>', 'ai-message');
            scrollToBottom();

            try {
                const response = await fetch('chat_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        message: message,
                        history: chatHistory.slice(-10),
                        contextFiles: activeContextFiles
                    })
                });

                const data = await response.json();
                document.getElementById(loadingId).remove();

                if (data.error) {
                    addMessage('⚠️ Error: ' + data.error, 'ai-message');
                } else {
                    if (data.sources) activeContextFiles = data.sources;

                    const replyId = addMessage(data.reply, 'ai-message', data.sources);
                    chatHistory.push({ role: 'model', text: data.reply });
                }
            } catch (error) {
                document.getElementById(loadingId).remove();
                addMessage('❌ Failed to connect to server.', 'ai-message');
            }
            scrollToBottom();
        }

        function addMessage(text, className, sources = null) {
            const messagesDiv = document.getElementById('chat-messages');
            const msgDiv = document.createElement('div');
            const id = 'msg-' + Date.now();
            msgDiv.id = id;
            msgDiv.className = `message ${className}`;

            // If it's AI message, render Markdown
            if (className.includes('ai-message')) {
                msgDiv.innerHTML = marked.parse(text);

                // Add Speak Button
                const btn = document.createElement('button');
                btn.className = 'speak-btn';
                btn.innerHTML = '🔊 Read';
                btn.onclick = () => speakText(text);
                msgDiv.appendChild(btn);

                // Add PDF Button
                const pdfBtn = document.createElement('button');
                pdfBtn.className = 'speak-btn'; // Reusing style
                pdfBtn.innerHTML = '📄 PDF';
                pdfBtn.style.marginLeft = '5px';
                pdfBtn.onclick = () => downloadPDF(text);
                msgDiv.appendChild(pdfBtn);

                // Add Sources if available
                if (sources && sources.length > 0) {
                    const srcSpan = document.createElement('span');
                    srcSpan.className = 'sources-tag';
                    srcSpan.innerText = '📚 Sources: ' + [...new Set(sources)].join(', ');
                    msgDiv.appendChild(srcSpan);
                }
            } else {
                msgDiv.textContent = text;
            }

            messagesDiv.appendChild(msgDiv);
            scrollToBottom();
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
            doc.save('AI-Tutor-Notes.pdf');
        }

        function scrollToBottom() {
            const container = document.getElementById('chat-container');
            container.scrollTop = container.scrollHeight;
        }

        function speakText(text) {
            if (!('speechSynthesis' in window)) return alert("Speech not supported");

            window.speechSynthesis.cancel();
            const cleanText = text.replace(/[#*`]/g, '');
            const utterance = new SpeechSynthesisUtterance(cleanText);

            // Auto-detect Hindi or English
            utterance.lang = /[\u0900-\u097F]/.test(cleanText) ? 'hi-IN' : 'en-US';
            window.speechSynthesis.speak(utterance);
        }
    </script>
</body>

</html>