<?php
require_once __DIR__ . "/../Models/Venta.php";

use App\Models\Venta;
$venta = new Venta();
$ventas = $venta->obtenerVentas();
$resultado = $ventas;

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Venta') {
    // Registrar información no sensible para depuración
    $logData = [
        'timestamp' => date('Y-m-d H:i:s'),
        'action' => 'Crear Venta',
        'user_id' => $_SESSION['sesion'] ?? 'no_session',
        'product_count' => isset($_POST['idProducto']) ? count($_POST['idProducto']) : 0
    ];
    
    error_log("Acción de venta: " . json_encode($logData));
    
    // Verificar si se han enviado productos
    if (isset($_POST['idProducto']) && is_array($_POST['idProducto']) && count($_POST['idProducto']) > 0) {
        $productos = [];
        for ($i = 0; $i < count($_POST['idProducto']); $i++) {
            // Validar y sanitizar los datos
            $idProducto = filter_var($_POST['idProducto'][$i], FILTER_SANITIZE_NUMBER_INT);
            $valorunitario = filter_var($_POST['valorunitario'][$i], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $cantidad = filter_var($_POST['cantidad'][$i], FILTER_SANITIZE_NUMBER_INT);
            $talla = filter_var($_POST['talla'][$i], FILTER_SANITIZE_STRING);
            $cliente = filter_var($_POST['cliente'], FILTER_SANITIZE_STRING);
            
            $productos[] = [
                'idProducto' => $idProducto,
                'valorunitario' => $valorunitario,
                'cantidad' => $cantidad,
                'talla' => $talla,
                'cliente' => $cliente
            ];
        }

        // Agregar la venta
        $venta->agregarVenta(
            filter_var($_POST['fechaventa'], FILTER_SANITIZE_STRING),
            filter_var($_POST['id_estadof'], FILTER_SANITIZE_NUMBER_INT),
            $productos,
            filter_var($_POST['documento'], FILTER_SANITIZE_NUMBER_INT)
        );    

        header("Location: ../Controllers/VentasControlador.php?message=agregadoexitosamente");
        exit();
    } else {
        error_log("Error: Intento de crear venta sin productos válidos");
        throw new Exception("No se han enviado productos válidos.");
    }
}


?>




