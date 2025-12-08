<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// CREDENCIALES API v1 (poner tu usuario real y contraseña real)
$user = "ColoniaUnionefais71";
$pass = "23dejulio2011";

$url = "https://api.weatherlink.com/v1/NoaaExt.json?user=$user&pass=$pass";

$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(["error" => "No se pudo obtener datos desde WeatherLink"]);
    exit;
}

$data = json_decode($response, true);

if (!$data) {
    echo json_encode(["error" => "Respuesta inválida desde WeatherLink"]);
    exit;
}

// Conversión de unidades (WeatherLink API v1 trabaja en °F, inHg, mph, etc.)
$temperature_c = ($data["temp_f"] - 32) * 5/9; 
$wind_kmh = $data["wind_speed_mph"] * 1.60934;
$rain_mm = $data["rain_1h_in"] * 25.4; // pulgadas → mm

$result = [
    "temperatura" => round($temperature_c, 1),
    "humedad" => $data["relative_humidity"],
    "viento" => round($wind_kmh, 1),
    "lluvia" => round($rain_mm, 2),
];

echo json_encode($result);
?>
