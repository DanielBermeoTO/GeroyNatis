<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtener la URL solicitada
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/';

// Eliminar el base_path de la URL si existe
if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

// Eliminar parámetros de consulta
$request_uri = strtok($request_uri, '?');

// Mapeo de rutas
$routes = [
    'app/Controllers/controladorInventario.php' => 'app/Controllers/controladorInventario.php',
    'app/Controllers/UsuarioInventario.php' => 'app/Controllers/UsuarioInventario.php',
    'app/Views/Auth/IniciarSesion.php' => 'app/Views/Auth/IniciarSesion.php',
    // Agrega más rutas según sea necesario
];

// Verificar si la ruta existe en el mapeo
if (isset($routes[$request_uri])) {
    require_once $routes[$request_uri];
} else {
    // Si la ruta no existe, redirigir a la página de inicio de sesión
    header('Location: app/Views/Auth/IniciarSesion.php');
    exit;
} 