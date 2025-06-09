<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir la ruta base del proyecto
define('BASE_PATH', __DIR__);

// Función para cargar archivos de manera segura
function loadFile($path) {
    $fullPath = BASE_PATH . '/' . $path;
    if (file_exists($fullPath)) {
        require_once $fullPath;
    } else {
        // Si el archivo no existe, redirigir a la página de inicio de sesión
        header('Location: app/Views/Auth/IniciarSesion.php');
        exit;
    }
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

// Si es la raíz, redirigir a la página de inicio de sesión
if ($request_uri === '' || $request_uri === '/') {
    header('Location: app/Views/Auth/IniciarSesion.php');
    exit;
}

// Mapeo de rutas
$routes = [
    'app/Controllers/controladorInventario.php' => function() {
        require_once __DIR__ . '/app/Models/Producto.php';
        
        $producto = new App\Models\Producto();
        
        if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $product = $producto->buscarProductos($busqueda);
        } else {
            $product = $producto->obtenerProductoz();
        }
        
        include __DIR__ . '/app/Views/Admin/Inventario.php';
    },
    'app/Controllers/UsuarioInventario.php' => function() {
        loadFile('app/Controllers/UsuarioInventario.php');
    },
    'app/Views/Auth/IniciarSesion.php' => function() {
        loadFile('app/Views/Auth/IniciarSesion.php');
    }
];

// Verificar si la ruta existe en el mapeo
if (isset($routes[$request_uri])) {
    $routes[$request_uri]();
} else {
    // Si la ruta no existe, redirigir a la página de inicio de sesión
    header('Location: app/Views/Auth/IniciarSesion.php');
    exit;
} 