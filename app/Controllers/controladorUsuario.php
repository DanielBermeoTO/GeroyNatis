<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../Models/Usuario.php";

use App\Models\Usuario;

$usuario = new Usuario();
$usuarios = $usuario->obtenerUsuarios();
$usuariosi = $usuario->obtenerUsuariosi();




$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";



if ($elegirAcciones == 'Crear Usuario') {
    $usuario->añadirUsuario(
        $_POST['documento'],
        $_POST['tipoDocumento'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['direccion'],
        $_POST['localidad'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['estado'],
        $_POST['idrol'],
        $_POST['contrasena']
    );
}elseif ($elegirAcciones == 'Borrar Usuario') {
    $usuario->borrarUsuario($_POST['documento'], null, null, null, null, null,null,null, '4');
}elseif ($elegirAcciones == 'Activar Usuario') {
    $usuario->activaUsuario($_POST['documento'], null, null, null, null, null,null,null, '3');
}elseif ($elegirAcciones == 'Actualizar Usuario') {
    $documento = $_POST['documento'] ?? null;

    if ($documento) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $localidad = $_POST['localidad'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $estado = $_POST['estado'];
        $rol = $_POST['idrol'];

        $usuario->actualizarUsuario( $documento, $nombre, $apellido, $direccion, $localidad,$telefono,$correo,$estado, $rol );
        header("Location: ../Controllers/controladorUsuario.php?success=1");
        exit();
    }

    
}

include "../../app/Views/Admin/Usuario.php";
