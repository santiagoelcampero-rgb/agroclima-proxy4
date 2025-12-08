<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

$apiKey    = "fy3x1gcft7msajs1pb0vvfgoosucdh2m";
$apiSecret = "ala6h05kg7oeavpd28nalhrm7m2uqvml";
$deviceId  = "001D0AE0CD19";

$t = time();
$signature = hash("sha256", $apiSecret . $t);

$url = "https://api.weatherlink.com/v1/NoaaExt.xml?user=$apiKey&pass=$apiSecret";

// Mostrar qué URL se está usando
echo "URL usada:\n$url\n\n";

// Descargar el contenido crudo
$response = @file_get_contents($url);

if ($response === FALSE) {
    echo "ERROR: No se pudo conectar a WeatherLink\n";
    exit;
}

echo "Respuesta completa:\n\n";
echo $response;
