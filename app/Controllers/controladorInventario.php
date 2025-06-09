<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Models/Producto.php';

use App\Models\Producto;

class ControladorInventario {
    private $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function index() {
        if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $product = $this->producto->buscarProductos($busqueda);
        } else {
            $product = $this->producto->obtenerProductos();
        }

        include __DIR__ . "/../Views/Admin/Inventario.php";
    }
}
?>
