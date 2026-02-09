<?php
// Script to list available Gemini Models
header('Content-Type: text/plain');

$apiKey = 'AIzaSyDNTLwaRFWuYBlBR-BN-c6AKwOs-3_H_7A'; // Using the key currently in chat_api.php
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPGET, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    $data = json_decode($response, true);
    if (isset($data['models'])) {
        echo "Available Models:\n";
        foreach ($data['models'] as $model) {
            echo " - Name: " . $model['name'] . "\n";
            echo "   Supported Methods: " . implode(", ", $model['supportedGenerationMethods']) . "\n";
            echo "   Description: " . $model['description'] . "\n\n";
        }
    } else {
        echo "Response:\n" . $response;
    }
}

curl_close($ch);
?>