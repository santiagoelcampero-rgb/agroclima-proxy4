<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$url = "https://www.weatherlink.com/bulletin/data/5da36e35-7ff9-4ed6-9cd6-87d41a6ef9ab";

$headers = [
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
    "Accept: application/json, text/plain, */*",
    "Referer: https://www.weatherlink.com/",
];

$context = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => implode("\r\n", $headers),
    ]
]);

$response = @file_get_contents($url, false, $context);

if ($response === false) {
    echo json_encode(["error" => "No se pudo conectar a WeatherLink"]);
    exit;
}

// 🔍 DEBUG TEMPORAL (IMPORTANTE)
if (stripos($response, "<!doctype html>") !== false) {
    echo json_encode([
        "error" => "WeatherLink devolvió HTML (no JSON)",
        "preview" => substr($response, 0, 300)
    ]);
    exit;
}

$data = json_decode($response, true);
if ($data === null) {
    echo json_encode(["error" => "JSON inválido"]);
    exit;
}

echo json_encode($data);
