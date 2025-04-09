<?php
require __DIR__ ."/../vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\key;

$key = "clave secreta";
function  generarJWTToken($usuario)
{
    global $key;
    $payload = [
        "id" => $usuario["id"],
        "email" => $usuario["email"],
        "iat" => time(),
        "exp" => time() + 60 * 60
    ];
    $token = JWT::encode($payload, $key,'HS256');
    return $token;
}
function obtenerToken() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        return null;
    }
    $token = str_replace('Bearer ', '', $headers['Authorization']);
    return $token;
}

function validateToken($token) {
    global $key;
    try {
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        return false;
    }
}
