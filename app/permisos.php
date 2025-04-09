<?php
function crearPermiso($request) {
    $sql = "INSERT INTO `permisos`(`id`, `nombre_permiso`) 
    VALUES (null,'{$request['nombre_permiso']}')";  

    $conexion = conectar();

    try {
        $conexion->query($sql);
        if ($conexion->affected_rows > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (Exception $e) {
        error_log("Error al crear permiso: " . $e->getMessage());
        return false; 
    }
}

function listarPermiso() {
    $sql = "SELECT * FROM permisos";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $permisos = $resultado -> fetch_all(MYSQLI_ASSOC);
    return $permisos;
}

function obtenerPermiso($id) {
    $sql = "SELECT * FROM permisos WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    $permiso = $resultado->fetch_assoc();
    return $permiso;
}

function actualizarPermiso($request) {
    $sql = "UPDATE permisos SET nombre_permiso = '{$request['nombre_permiso']}' WHERE id = {$request['id']}";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}

function eliminarPermiso($id) {
    $sql = "DELETE FROM permisos WHERE id = $id";
    $conexion = conectar();
    $resultado = $conexion->query($sql);
    return $resultado;
}
?>