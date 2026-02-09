<?php
header('Content-Type: text/plain');
$apiKey = 'AIzaSyDNTLwaRFWuYBlBR-BN-c6AKwOs-3_H_7A';
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
echo $response;
?>