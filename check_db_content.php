<?php
include 'db_connect.php';
// Check the last uploaded file's content
$result = $conn->query("SELECT id, filename, extracted_text FROM uploads ORDER BY id DESC LIMIT 1");
if ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . "\n";
    echo "Filename: " . $row['filename'] . "\n";
    echo "Content Preview (First 500 chars):\n";
    echo mb_substr($row['extracted_text'], 0, 500) . "\n...\n";
} else {
    echo "No uploads found.";
}
?>