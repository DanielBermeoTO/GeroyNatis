<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../Models/Movimientos.php";

use App\Models\Movimientos;
$movimiento = new Movimientos();
$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Movimiento') {
    // Llamar a la función añadirmovimiento() pasando todos los parámetros necesarios
    $tallas = $_POST['talla'];          // Deben venir como arrays desde el formulario
    $cantidades = $_POST['cantidad'];
    $colores = $_POST['color'];

    $idproceso = $movimiento->añadirmovimiento(
        null,                             // Se calcula dentro del modelo
        $_POST['fecha_entrada'],         
        $_POST['ProductoidProducto'],
        null,                             // No se usa un único idTalla, porque vienen múltiples
        $_POST['ProveedoridProveedor'],
        $_POST['precioproveedor'],
        null,                             // Se define como 6 dentro del modelo
        null,                             // Se calcula total dentro del modelo
        $tallas,
        $cantidades,
        $colores
    );
    
    // Redireccionar a la página controladora con un mensaje de éxito
    header("Location: ../Controllers/controladorMovimiento.php?success=1");
    exit();
}
?>
