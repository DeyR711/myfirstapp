<?php

//crear un usuario

function crearUsuario($request) {


try {
    $passwordHash = password_hash($request['password'], PASSWORD_BCRYPT);


    $sql = "INSERT INTO `usuarios`(`id`, `nombre`,
     `apellido`, `email`, `password`, `id_rol`)
    
     VALUES (null,'{$request['nombre']}','{$request['apellido']}',
     '{$request['email']}','{$passwordHash}','{$request['id_rol']}')";  

    $conexion = conectar();
    $conexion->query($sql);


    return true;
} catch (\Throwable $th) {
    return false;
}
}

function listarUsuario() {
   
   $sql = "SELECT * FROM usuarios";
   $conexion = conectar();
   $resultado = $conexion->query($sql);
   $usuarios = $resultado -> fetch_all(MYSQLI_ASSOC);
   return $usuarios;

}

function obtenerUsuario($id) {
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $usuario = $resultado->fetch_assoc();
    return $usuario;
}

function actualizarUsuario($request) {
    $sql = "UPDATE usuarios SET nombre = '{$request['nombre']}', apellido = '{$request['apellido']}', email = '{$request['email']}' WHERE id = {$request['id']}";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}

function eliminarUsuario($id) {
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}
/*index.php
if (
    $_SERVER['REQUEST_URI'] == '/crear/rol'
    and $_SERVER['REQUEST_METHOD'] == 'POST'
) {
    $respuesta = crearRol($request);
    if ($respuesta) {
        echo json_encode(['mensaje' => 'Rol creado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al crear el rol']);
    }
} 
    
    */
