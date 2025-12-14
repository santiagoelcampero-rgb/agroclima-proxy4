<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/xml");

// ⚠️ USUARIO Y CONTRASEÑA REALES DE WEATHERLINK
$user = "ColoniaUnionefais71";
$pass = "23dejulio2011";

// Endpoint NOAA XML
$url = "https://www.weatherlink.com/v1/NoaaExt.xml?user=$user&pass=$pass";

// Obtener datos
$response = @file_get_contents($url);

if ($response === false) {
    echo "<error>No se pudo conectar a WeatherLink</error>";
    exit;
}

// Devolver XML crudo
echo $response;
