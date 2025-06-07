<?php
require_once __DIR__ . "/../Models/Movimientos.php";

use App\Models\Movimientos;

$movimiento = new Movimientos();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $movimientos = $movimiento->buscarMovimientos($busqueda);
} else {
    $movimientos = $movimiento->obtenerMovimiento();
}

// Include the HTML part, not included directly in PHP script
// Include the HTML part, not included directly in PHP script

include __DIR__ . "/../Views/Admin/ProveedoresMovimientos.php";
?>
