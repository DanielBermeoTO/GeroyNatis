<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

// Obtener la URL actual
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = dirname($_SERVER['SCRIPT_NAME']);
$path = substr(parse_url($request_uri, PHP_URL_PATH), strlen($base_path));

// Eliminar la barra inicial si existe
$path = ltrim($path, '/');

// Si no hay ruta, establecer una ruta por defecto
if (empty($path)) {
    $path = 'inicio';
}

// Dividir la ruta en segmentos
$segments = explode('/', $path);

// Determinar el controlador y la acción
$controller = !empty($segments[0]) ? $segments[0] : 'inicio';
$action = !empty($segments[1]) ? $segments[1] : 'index';

// Construir el nombre del archivo del controlador
$controller_file = __DIR__ . '/app/Controllers/controlador' . ucfirst($controller) . '.php';

// Verificar si el controlador existe
if (file_exists($controller_file)) {
    require_once $controller_file;
    $controller_class = 'App\\Controllers\\Controlador' . ucfirst($controller);
    if (class_exists($controller_class)) {
        $controller_instance = new $controller_class();
        if (method_exists($controller_instance, $action)) {
            $controller_instance->$action();
        } else {
            // Método no encontrado
            header("HTTP/1.0 404 Not Found");
            echo "Método no encontrado";
        }
    } else {
        // Clase no encontrada
        header("HTTP/1.0 404 Not Found");
        echo "Controlador no encontrado";
    }
} else {
    // Controlador no encontrado
    header("HTTP/1.0 404 Not Found");
    echo "Controlador no encontrado";
} 