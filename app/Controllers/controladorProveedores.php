<?php
require_once __DIR__ . '/../Models/Proveedor.php';  // <-- ruta correcta

use App\Models\Proveedor;

$proveedor = new Proveedor();

if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $proveedores = $proveedor->buscarProducto($busqueda);
} else {
    $proveedores = $proveedor->consultarProveedor();
}

$tallas = $proveedor->consultartalla();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";

if ($elegirAcciones == 'Crear Proveedor') {
    $idProveedor = $proveedor->añadirProveedor(
        $_POST['nombreproveedor'],
        $_POST['Telefono'],
        $_POST['productos']
    );
    // Redireccionar a la página de éxito o mostrar un mensaje.
    header("Location: ../Controllers/controladorProveedores.php?success=1");
    exit();
}elseif ($elegirAcciones == 'Actualizar Proveedor') {
    $idProveedor = $_POST['idProveedor'] ?? null;

    if ($idProveedor) {
        $nombreproveedor = $_POST['nombreproveedor'];
        $Telefono = $_POST['Telefono'];
        $producto = $_POST['productos'];

        $proveedor->actualizarProveedor($idProveedor,$nombreproveedor,$Telefono,$producto);
        header("Location: ../Controllers/controladorProveedores.php?success=1");
        exit();
    }
}
include __DIR__ . "/../Views/Admin/Proveedores.php";

