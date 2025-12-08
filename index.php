<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$apiKey    = "fy3x1gcft7msajs1pb0vvfgoosucdh2m";
$apiSecret = "ala6h05kg7oeavpd28nalhrm7m2uqvml";
$stationId = "173982";

// Timestamp actual
$t = time();

// Cadena para firmar
$cadena = "api-key=" . $apiKey . "&t=" . $t;

// Generar firma correcta HMAC-SHA256
$signature = hash_hmac('sha256', $cadena, $apiSecret);

// URL final
$url = "https://api.weatherlink.com/v2/current/$stationId?api-key=$apiKey&t=$t&api-signature=$signature";

// Llamada a WeatherLink
$response = @file_get_contents($url);

if ($response === FALSE) {
    echo json_encode([
        "error" => "No se pudo obtener datos desde WeatherLink",
        "url" => $url // te ayuda a ver la URL generada en los logs
    ]);
    exit;
}

echo $response;
?>
