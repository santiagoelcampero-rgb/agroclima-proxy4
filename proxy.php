<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Cargar variables del .env si existe
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
    if (class_exists('Dotenv\Dotenv')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
}

$deviceId = $_GET['device_id'] ?? $_ENV['DEVICE_ID'] ?? null;

if (!$deviceId) {
    echo json_encode(["error" => "Missing device_id"]);
    exit;
}

$apiKey = $_ENV['API_KEY'] ?? null;
$apiSecret = $_ENV['API_SECRET'] ?? null;

if (!$apiKey || !$apiSecret) {
    echo json_encode(["error" => "Missing API credentials"]);
    exit;
}

$timestamp = time();
$signature = hash_hmac('sha256', $timestamp . $deviceId, $apiSecret);

$url = "https://api.ecowitt.net/api/v3/device/real_time?application_key=$apiKey&api_sign=$signature&t=$timestamp&device_id=$deviceId&units=temp|c,wind|m/s,rain|mm,pressure|hpa";

$response = file_get_contents($url);

echo $response;
