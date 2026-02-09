<?php
$apiKey = 'AIzaSyDNTLwaRFWuYBlBR-BN-c6AKwOs-3_H_7A';
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$data = json_decode($response, true);
if (isset($data['models'])) {
    foreach ($data['models'] as $model) {
        $n = str_replace('models/', '', $model['name']);
        if (strpos($n, 'gemini') !== false) {
            echo $n . "\n";
        }
    }
}
?>