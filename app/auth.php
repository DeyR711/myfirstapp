<?php
require_once '../config/conexion.php';
require_once '../app/jwt.php';

function iniciarSesion($request) {
    $sql = "SELECT * FROM usuarios WHERE email = '{$request['email']}'";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $usuario = $resultado->fetch_assoc();

    if ($usuario) {
        if (password_verify($request["password"], $usuario["password"])) {
            return $usuario; // Devuelve el usuario si la autenticación es exitosa
        } else {
            return false; // Contraseña incorrecta
        }
    }

    return false; // Usuario no encontrado
}






/*function iniciarSesion($request){
    
    $sql = "SELECT * FROM usuarios WHERE email = '{$request['email']}'";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $usuario = $resultado->fetch_assoc();
    if ($usuario){
        if (password_verify($request["password"], $usuario["password"])){

            $token = generarJWTToken($usuario);
            echo json_encode($token);
        } else {
            echo json_encode(['error' => 'Error al iniciar sesion']);
        }
    }

}
*/




?>