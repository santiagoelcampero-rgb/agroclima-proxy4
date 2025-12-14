<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Redirige al proxy real
require __DIR__ . "/raw.php";
