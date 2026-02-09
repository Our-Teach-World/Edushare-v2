<?php
session_start();
include 'db_connect.php';
// Load Composer dependencies (if you have any others, but for now standard curl/json is fine)
// We already included db_connect.php which has DB connection $conn

header('Content-Type: application/json');

/*
 * Configuration
 * Replace 'YOUR_GEMINI_API_KEY' with the actual key or load from config/env
 */
define('GEMINI_API_KEY', 'AIzaSyB51sZmsIZj_7_9UAqGfJbtZRrhB0G4Ku4');
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . GEMINI_API_KEY);

$input = json_decode(file_get_contents('php://input'), true);
$userQuestion = $input['message'] ?? '';
$history = $input['history'] ?? [];
$contextFiles = $input['contextFiles'] ?? [];

if (!$userQuestion) {
    echo json_encode(['error' => 'No question provided']);
    exit;
}

$context = "";
$foundFiles = [];

// 0. Load Context from Previous Turns (Context Persistence)
if (!empty($contextFiles)) {
    // Sanitize filenames to prevent SQL injection (though we use prepared statements below) or path traversal
    // Ideally we fetch by ID, but we stored filenames.
    // Let's protect reasonably.
    foreach ($contextFiles as $file) {
        $stmt = $conn->prepare("SELECT filename, extracted_text FROM uploads WHERE filename = ? LIMIT 1");
        $stmt->bind_param("s", $file);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            $safeText = mb_convert_encoding($row['extracted_text'], 'UTF-8', 'UTF-8');
            $context .= "Source File (Previous Turn): " . $row['filename'] . "\nContent: " . mb_substr($safeText, 0, 1500) . "\n\n";
            $foundFiles[] = $row['filename'];
        }
    }
}

// 1. Search for relevant content in Database (RAG)
// Using FULLTEXT search on extracted_text
$stmt = $conn->prepare("SELECT filename, extracted_text, MATCH(extracted_text) AGAINST(? IN NATURAL LANGUAGE MODE) as score FROM uploads WHERE MATCH(extracted_text) AGAINST(? IN NATURAL LANGUAGE MODE) LIMIT 3");
$stmt->bind_param("ss", $userQuestion, $userQuestion);
$stmt->execute();
$result = $stmt->get_result();

// Context accumulated above
// $foundFiles accumulated above

while ($row = $result->fetch_assoc()) {
    // Avoid duplicating content if already loaded from contextFiles
    if (in_array($row['filename'], $foundFiles))
        continue;

    // Determine content encoding safety
    $safeText = mb_convert_encoding($row['extracted_text'], 'UTF-8', 'UTF-8');
    // Use multi-byte safe substring
    $context .= "Source File: " . $row['filename'] . "\nContent: " . mb_substr($safeText, 0, 1500) . "\n\n";
    $foundFiles[] = $row['filename'];
}

if (empty($context) && empty($history)) {
    // Strict mode: If no context AND no history, tell the user to reference a file
    echo json_encode(['reply' => "I can only answer questions based on the uploaded files. Please ask something related to the course documents."]);
    exit;
}

// 1.5 Generate File Inventory (Teacher -> Files)
$uploadBase = 'uploads/';
$inventory = "Available Course Files Inventory:\n";
if (is_dir($uploadBase)) {
    $teachers = array_diff(scandir($uploadBase), ['.', '..']);
    foreach ($teachers as $teacher) {
        $teacherDir = $uploadBase . $teacher;
        if (is_dir($teacherDir)) {
            $categories = ['documents', 'images', 'audio', 'video', 'others'];
            $filesFound = false;

            // Scan Subfolders
            foreach ($categories as $cat) {
                $subDir = $teacherDir . '/' . $cat;
                if (is_dir($subDir)) {
                    $files = array_diff(scandir($subDir), ['.', '..']);
                    foreach ($files as $file) {
                        $inventory .= "- File: $file | Teacher: $teacher | Path: $teacherDir/$cat/$file\n";
                        $filesFound = true;
                    }
                }
            }

            // Scan Root for Legacy Files (excluding known folders)
            $rootItems = array_diff(scandir($teacherDir), ['.', '..', 'profile.jpg', 'name.txt', 'documents', 'images', 'audio', 'video', 'others']);
            foreach ($rootItems as $file) {
                if (is_file($teacherDir . '/' . $file)) {
                    $inventory .= "- File: $file | Teacher: $teacher | Path: $teacherDir/$file\n";
                }
            }
        }
    }
} else {
    $inventory .= "(No uploads directory found)\n";
}

// 2. Construct Prompt for Gemini
// Persona: Personalized Tutor
$systemPrompt = "You are a personalized AI Tutor for a student.
Your goal is to help them learn using the provided class files.

*** CURRENT FILE INVENTORY ***
$inventory
******************************

Guidelines:
1. **Explain Clearly**: Use simple language. Translate complex Hindi/English terms if needed.
2. **Solve Problems**: If the student asks a problem, guide them through the solution step-by-step using the file content.
3. **Check Understanding**: After explaining, ask a follow-up question to see if they understood (e.g., 'Do you want a practice question on this?').
4. **Be Proactive**: If the student says 'Test me' or 'Quiz me', generate a question based on the file content.
5. **Strict Context**: Base your knowledge primarily on the uploaded files. If the file doesn't cover it, say so, however, you can now also answer questions about WHICH files are available using the Inventory above.
6. **File Locations**: If asked where a file is or for a source path, cite the 'Path' from the Inventory.

Context from Files (RAG Content):
$context

Conversation History:
" . json_encode($history, JSON_UNESCAPED_UNICODE);

$payload = [
    "contents" => [
        [
            "parts" => [
                ["text" => $systemPrompt . "\n\nStudent Question: " . $userQuestion]
            ]
        ]
    ]
];

$jsonPayload = json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE);

if ($jsonPayload === false) {
    echo json_encode(['reply' => "Error encoding your request: " . json_last_error_msg()]);
    exit;
}

// 3. Call Gemini API
$ch = curl_init(GEMINI_API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL for XAMPP
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo json_encode(['error' => 'Gemini API Connection Error: ' . curl_error($ch)]);
} else {
    $decoded = json_decode($response, true);

    // Check for Quota/Rate Limit Errors (HTTP 429)
    if ($httpCode === 429) {
        echo json_encode(['reply' => "⚠️ Usage Limit Reached. Please wait a minute before asking your next question."]);
    }
    // Check for other API errors in the response body
    elseif (isset($decoded['error'])) {
        $errorMsg = $decoded['error']['message'] ?? 'Unknown API Error';

        // Detailed check for quota in message text if status wasn't 429
        if (stripos($errorMsg, 'Quota exceeded') !== false) {
            echo json_encode(['reply' => "⚠️ Usage Limit Reached. Please wait a short while before trying again."]);
        } else {
            // Log the full error to debug file
            file_put_contents('gemini_debug.log', date('Y-m-d H:i:s') . " - Error: " . $response . "\n", FILE_APPEND);
            echo json_encode(['reply' => "AI Error: " . $errorMsg]);
        }
    }
    // Success Case
    elseif (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
        $aiReply = $decoded['candidates'][0]['content']['parts'][0]['text'];

        // Extract Usage Metadata
        $usage = $decoded['usageMetadata'] ?? null;

        echo json_encode([
            'reply' => $aiReply,
            'sources' => $foundFiles,
            'usage' => $usage
        ]);
    }
    // Fallback for unexpected formats
    else {
        file_put_contents('gemini_debug.log', date('Y-m-d H:i:s') . " - Unexpected Response: " . $response . "\n", FILE_APPEND);
        echo json_encode(['reply' => "The AI sent an unexpected response. Please try again."]);
    }
}

curl_close($ch);
?>