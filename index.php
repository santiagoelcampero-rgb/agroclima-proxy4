<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$apiKey    = "fy3x1gcft7msajs1pb0vvfgoosucdh2m";
$apiSecret = "ala6h05kg7oeavpd28nalhrm7m2uqvml";
$stationId = "173982";

$t = time();
$signature = hash("sha256", $apiSecret . $t);

$url = "https://api.weatherlink.com/v2/current/$stationId?api-key=$apiKey&t=$t&api-signature=$signature";

$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(["error" => "No se pudo obtener datos desde WeatherLink"]);
    exit;
}

echo $response;
?>
