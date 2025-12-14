<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$url = "https://www.weatherlink.com/bulletin/data/5da36e35-7ff9-4ed6-9cd6-87d41a6ef9ab";

$context = stream_context_create([
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0\r\n"
    ]
]);

$response = @file_get_contents($url, false, $context);

if ($response === false) {
    echo json_encode(["error" => "No se pudo obtener el bulletin"]);
    exit;
}

// Validar que sea JSON
$data = json_decode($response, true);
if ($data === null) {
    echo json_encode(["error" => "Respuesta inválida desde WeatherLink"]);
    exit;
}

echo json_encode($data);
