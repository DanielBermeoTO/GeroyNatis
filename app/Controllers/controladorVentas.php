<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../Models/Venta.php";

use App\Models\Venta;

$venta = new Venta();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $ventas = $venta->buscarVentas($busqueda);
} else {
    $ventas = $venta->obtenerVentas();
}


$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Venta') {
    
    // Verificar si se han enviado productos
    if (isset($_POST['idProducto']) && is_array($_POST['idProducto']) && count($_POST['idProducto']) > 0) {
        $productos = [];
        for ($i = 0; $i < count($_POST['idProducto']); $i++) {
            $productos[] = [
                'idProducto' => $_POST['idProducto'][$i],
                'valorunitario' => $_POST['valorunitario'][$i],
                'cantidad' => $_POST['cantidad'][$i],
                'talla' => $_POST['talla'][$i],
                'cliente' => $_POST['cliente']
            ];
        }

        // Agregar la venta
        $venta->agregarVenta(
            $_POST['fechaventa'],
            $_POST['id_estadof'],
            $productos,
            $_POST['documento']

        );    

        header("Location: ../../app/Views/Admin/RegistroVentas.php?success=1");
        exit(); // Es buena práctica terminar el script después de redirigir

    } else {
        throw new Exception("No se han enviado productos válidos.");
    }
} 

?>




