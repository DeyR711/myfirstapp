<?php
function crearRol($request) {
    $sql = "INSERT INTO `roles`(`id`, `nombre_roles`) 
    VALUES (null,'{$request['nombre_roles']}')";  

    $conexion = conectar();

    try {
        $conexion->query($sql);
        if ($conexion->affected_rows > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (Exception $e) {
        error_log("Error al crear rol: " . $e->getMessage());
        return false; 
    }
}

function listarRol() {
    $sql = "SELECT * FROM roles";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $roles = $resultado -> fetch_all(MYSQLI_ASSOC);
    return $roles;
}

function obtenerRol($id) {
    $sql = "SELECT * FROM roles WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $rol = $resultado->fetch_assoc();
    return $rol;
}

function actualizarRol($request) {
    $sql = "UPDATE roles SET nombre_roles = '{$request['nombre_roles']}' WHERE id = {$request['id']}";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}

function eliminarRol($id) {
    $sql = "DELETE FROM roles WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}
?>