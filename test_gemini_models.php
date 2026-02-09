<?php
define('GEMINI_API_KEY', 'AIzaSyAMfg7U-H4FVvYrff7ayDpV9d8JMwORVI8');
$url = 'https://generativelanguage.googleapis.com/v1beta/models?key=' . GEMINI_API_KEY;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL check for XAMPP

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl Error: ' . curl_error($ch);
} else {
    $data = json_decode($response, true);
    if (isset($data['models'])) {
        echo "Available Models:\n";
        foreach ($data['models'] as $model) {
            echo $model['name'] . "\n";
        }
    } else {
        echo "Response Error:\n";
        print_r($data);
    }
}
curl_close($ch);
?>