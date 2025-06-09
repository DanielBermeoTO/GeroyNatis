<?php

require_once '/../Models/Producto.php';  // <-- ruta correcta

use App\Models\Producto;

$producto = new Producto();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $product = $producto->buscarProductos($busqueda);
} else {
    $product = $producto->obtenerProductoz();
}



// Include the HTML part, not included directly in PHP script
// Include the HTML part, not included directly in PHP script
include "/../Views/Admin/Inventario.php";
?>
