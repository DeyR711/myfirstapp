<?php
require_once '../config/conexion.php';
require_once '../app/usuarios.php';
require_once '../app/auth.php';
require_once '../app/roles.php';
require_once '../app/permisos.php';
header('Content-Type: application/json');

$request = json_decode(file_get_contents("php://input"), true);

if (
    $_SERVER['REQUEST_URI'] == '/registrar/usuario'
    and $_SERVER['REQUEST_METHOD'] == 'POST'
) {

    $respuesta = crearUsuario($request);
    if ($respuesta) {
        echo json_encode(['mensaje' => 'Usuario creado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al crear el usuario']);
    }
}
// Rutas protegidas con token

if (
    $_SERVER['REQUEST_URI'] == '/listar/usuarios'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $token = obtenerToken();
    $isValid = validateToken($token);
    if ($isValid != false) {

        $usuarios = listarUsuario();
        echo json_encode($usuarios);
    } else {
        echo json_encode(['error' => 'Token inválido']);
    }
}
if (
    $_SERVER['REQUEST_URI'] == '/login'
    and $_SERVER['REQUEST_METHOD'] == 'POST'
) {

    $usuario = iniciarSesion($request);

    if ($usuario) {
        $token = generarJWTToken($usuario);
        echo json_encode([
            'usuario' => $usuario,
            'token' => $token
        ]);
    } else {
        echo json_encode([
            'error' => 'Usuario o contraseña incorrectos'
        ]);
    }
}
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

if (
    $_SERVER['REQUEST_URI'] == '/listar/roles'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $roles = listarRol();
    echo json_encode($roles);
}

if (
    $_SERVER['REQUEST_URI'] == '/crear/permiso'
    and $_SERVER['REQUEST_METHOD'] == 'POST'
) {
    $respuesta = crearPermiso($request);
    if ($respuesta) {
        echo json_encode(['mensaje' => 'Permiso creado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al crear el permiso']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/listar/permisos'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $permisos = listarPermiso();
    echo json_encode($permisos);
}

if (
    $_SERVER['REQUEST_URI'] == '/obtener/usuario'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $usuarios = obtenerUsuario($request['id']);
    echo json_encode($usuarios);
}

if (
    $_SERVER['REQUEST_URI'] == '/actualizar/usuario'
    and $_SERVER['REQUEST_METHOD'] == 'PUT'
) {
    $usuarios = actualizarUsuario($request);
    if ($usuarios) {
        echo json_encode(['mensaje' => 'Usuario actualizado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al actualizar el usuario']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/eliminar/usuario'
    and $_SERVER['REQUEST_METHOD'] == 'DELETE'
) {
    $usuarios = eliminarUsuario($request['id']);
    if ($usuarios) {
        echo json_encode(['mensaje' => 'Usuario eliminado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al eliminar el usuario']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/obtener/rol'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $rol = obtenerRol($request['id']);
    echo json_encode($rol);
}

if (
    $_SERVER['REQUEST_URI'] == '/actualizar/rol'
    and $_SERVER['REQUEST_METHOD'] == 'PUT'
) {
    $rol = actualizarRol($request);
    if ($rol) {
        echo json_encode(['mensaje' => 'Rol actualizado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al actualizar el rol']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/eliminar/rol'
    and $_SERVER['REQUEST_METHOD'] == 'DELETE'
) {
    $rol = eliminarRol($request['id']);
    if ($rol) {
        echo json_encode(['mensaje' => 'Rol eliminado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al eliminar el rol']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/obtener/permiso'
    and $_SERVER['REQUEST_METHOD'] == 'GET'
) {
    $permiso = obtenerPermiso($request['id']);
    echo json_encode($permiso);
}

if (
    $_SERVER['REQUEST_URI'] == '/actualizar/permiso'
    and $_SERVER['REQUEST_METHOD'] == 'PUT'
) {
    $permiso = actualizarPermiso($request);
    if ($permiso) {
        echo json_encode(['mensaje' => 'Permiso actualizado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al actualizar el permiso']);
    }
}

if (
    $_SERVER['REQUEST_URI'] == '/eliminar/permiso'
    and $_SERVER['REQUEST_METHOD'] == 'DELETE'
) {
    $permiso = eliminarPermiso($request['id']);
    if ($permiso) {
        echo json_encode(['mensaje' => 'Permiso eliminado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al eliminar el permiso']);
    }
}
