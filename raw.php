<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

$apiKey    = "fy3x1gcft7msajs1pb0vvfgoosucdh2m";
$apiSecret = "ala6h05kg7oeavpd28nalhrm7m2uqvml";
$stationId = "169336";

$t = time();
$signature = hash("sha256", $apiSecret . $t);

$url = "https://api.weatherlink.com/v2/current/$stationId?api-key=$apiKey&t=$t&api-signature=$signature";

echo "URL:\n$url\n\n";
echo "Respuesta cruda:\n\n";

echo file_get_contents($url);
