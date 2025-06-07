<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Models/Producto.php';  // <-- ruta correcta

use App\Models\Producto;

$producto = new Producto();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $productos = $producto->buscarProducto($busqueda);
} else {
    $productos = $producto->obtenerProductos();
}

$tallas = $producto->obtenerTallas();
$categorias = $producto->obtenerCategorias();


// Include the HTML part, not included directly in PHP script
include __DIR__ . "/../Views/Admin/InventarioProductos.php";

?>