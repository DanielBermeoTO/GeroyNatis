<?php
require_once __DIR__ . "/../Models/VentaU.php";

use App\Models\Venta;
$venta = new Venta();
$ventas = $venta->obtenerVentas();
$resultado = $ventas;

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Venta') {
    // Imprimir datos para depuración
    print_r($_POST);
    
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

        header("Location: ../Controllers/VentasControlador.php?message=agregadoexitosamente");
        exit(); // Es buena práctica terminar el script después de redirigir

    } else {
        throw new Exception("No se han enviado productos válidos.");
    }
} if ($elegirAcciones == 'Pago') {
    if (isset($_POST['idFactura'])) {
        $idFactura = $_POST['idFactura'];
        echo "Intentando actualizar factura con ID: " . $idFactura; // Para depuración
        $venta->pagarVenta($idFactura, '1', null);
        header("Location: ../Controllers/VentasControlador.php?message=agregadoexitosamente");
        exit(); 
    } else {
        echo "No se recibió el ID de la factura.";
    }
} if ($elegirAcciones == 'No Pago') {
    if (isset($_POST['idFactura'])) {
        $idFactura = $_POST['idFactura'];
        echo "Intentando actualizar factura con ID: " . $idFactura; // Para depuración
        $venta->nopagarVenta($idFactura, '2', null);header("Location: ../UsuarioControlador/VentasControlador.php?success=1");
        exit(); 
    } else {
        echo "No se recibió el ID de la factura.";
    }
}



include __DIR__ . "/../Views/Web/VentasUsuario.php";
?>




