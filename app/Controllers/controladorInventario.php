<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['sesion']) || empty($_SESSION['sesion']) || $_SESSION['rol'] != 1) {
    header('Location: ../Views/Auth/IniciarSesion.php');
    exit;
}

// Cargar el modelo
require_once __DIR__ . '/../Models/Producto.php';

use App\Models\Producto;

$producto = new Producto();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $product = $producto->buscarProductos($busqueda);
} else {
    $product = $producto->obtenerProductoz();
}

// Incluir la vista
include __DIR__ . "/../Views/Admin/Inventario.php";
?>
