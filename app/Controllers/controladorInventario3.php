<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../Models/Producto.php";

use App\Models\Producto;

$producto = new Producto();

$prov = $producto->consultarProv();
$produ = $producto->obtenerProductos();
$tallas = $producto->obtenerTallas();
$categorias = $producto->obtenerCategorias();
$proveedor = $producto->obtenerProveedor();
$estado = $producto->obtenerEstado();
$estados = $producto->obtenerEstados();

$elegirAcciones = isset($_POST['Acciones']) ? $_POST['Acciones'] : "Cargar";


if ($elegirAcciones == 'Crear Producto') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validamos si se subió una imagen
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['foto'];
            $imagenTemp = $imagen['tmp_name'];
            
            // Verificamos si el archivo es una imagen válida
            $tipoImagen = mime_content_type($imagenTemp);
            if (strpos($tipoImagen, 'image') === false) {
                // Si no es una imagen, mostramos un error y no procesamos
                echo "El archivo no es una imagen válida.";
                exit();
            }

            // Comprobamos el tamaño máximo del archivo (por ejemplo 5MB)
            $maxSize = 5 * 1024 * 1024; // 5MB en bytes
            if ($imagen['size'] > $maxSize) {
                // Si el archivo excede el tamaño máximo
                echo "La imagen es demasiado grande. El tamaño máximo permitido es 5MB.";
                exit();
            }
            
            // La imagen será subida a Cloudinary directamente desde la función añadirProducto
            $idProducto = $producto->añadirProducto(
                $imagenTemp, // Enviamos el archivo temporal que será procesado por Cloudinary
                $_POST['nombreproducto'],
                $_POST['precio'],
                $_POST['precioproveedor'],
                $_POST['color'],  // Color general
                $_POST['categoria'],
                $_POST['estado'],
                $_POST['talla'], // Array de tallas
                $_POST['cantidad'], // Array de cantidades
                $_POST['color'], // Array de colores detallados
                $_POST['fecha_entrada'],
                $_POST['ProveedoridProveedor']
            );
            
            // Redirigir a la página de inventario con éxito
            header("Location: ../../app/Controllers/controladorInventario2.php?success=1");
            exit();
        } else {
            // Si no se subió una imagen, mostramos un error
            echo "Es necesario subir una imagen del producto.";
            exit();
        }
    }
} elseif ($elegirAcciones == 'Actualizar Producto') {
    // Asegúrate de que el ID del producto esté presente
    $idProducto = $_POST['idProducto'] ?? null;

    if ($idProducto) {
        $nombreProducto = $_POST['nombreproducto'] ?? null;
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $estado = $_POST['estado'];

        $producto->actualizarProducto($idProducto, $nombreProducto, $precio, $categoria, $estado);

        header("Location: ../../app/Controllers/controladorInventario2.php?success=1");
        exit();
    }
} elseif ($elegirAcciones == 'Borrar Producto') {
    $producto->borrarProducto($_POST['idProducto'], null, null, null, null, null, null, '4', null);
}