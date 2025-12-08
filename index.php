<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// API KEY
$apiKey    = "fy3x1gcft7msajs1pb0vvfgoosucdh2m";

// API SECRET real
$apiSecret = "ala6h05kg7oeavpd28nalhrm7m2uqvml";

// TU STATION ID
$stationId = "169336";

// Timestamp actual
$t = time();

// Firma correcta usando HMAC-SHA256
$signature = hash_hmac("sha256", $t, $apiSecret);

// URL final
$url = "https://api.weatherlink.com/v2/current/$stationId?api-key=$apiKey&t=$t&api-signature=$signature";

// Llamada API
$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(["error" => "No se pudo obtener datos desde WeatherLink", "url" => $url]);
    exit;
}

echo $response;
?>
