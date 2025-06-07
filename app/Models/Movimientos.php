<?php

namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../../vendor/autoload.php';  

use App\Config\Database;
use Dotenv\Dotenv;

// Ajusta la ruta a la raíz de tu proyecto (normalmente 2 niveles arriba si estás en app/Models)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();


class Movimientos
{
    private $idproceso;
    private $entradaproducto;
    private $fechaentrada;
    private $ProductoidProducto;
    private $TallaidTalla;
    private $ProveedoridProveedor;
    private $precioproveedor;
    private $total;
    private $anadido;
    private $Conexion;

    public function __construct($idproceso = null, $entradaproducto = null, $fechaentrada = null, $ProductoidProducto = null, $ProveedoridProveedor = null, $total = null, $anadido = null, $precioproveedor = null, $Conexion = null, $TallaidTalla = null)
    {
        $this->idproceso = $idproceso;
        $this->entradaproducto = $entradaproducto;
        $this->fechaentrada = $fechaentrada;
        $this->ProductoidProducto = $ProductoidProducto;
        $this->ProveedoridProveedor = $ProveedoridProveedor;
        $this->precioproveedor= $precioproveedor;
        $this->anadido = $anadido;
        $this->total = $total;
        $this->TallaidTalla = $TallaidTalla;
        $this->Conexion = Database::getConnection();
    }
    public function obtenerMovimiento()
    {
        $sql = "SELECT pr.idProceso, pr.entradaproducto, pr.fecha_entrada, pr.ProductoidProducto, pr.precioproveedor, pr.total, (SELECT nombreproducto FROM producto WHERE pr.ProductoidProducto = producto.idProducto) AS producto, (SELECT tiposestados FROM estados WHERE estados.idestado = pr.anadido) AS anadido, (SELECT precio FROM producto WHERE pr.ProductoidProducto = producto.idProducto) AS precio, (SELECT nombreproveedor FROM proveedor WHERE pr.ProveedoridProveedor = proveedor.idProveedor) AS proveedor, GROUP_CONCAT(CONCAT(t.talla, ': ', pt.cantidad, ': ', pt.color) ORDER BY t.talla ASC SEPARATOR ', ') AS Detalle_Producto FROM proceso pr LEFT JOIN detalle_proceso pt ON pr.idProceso = pt.id_proceso LEFT JOIN talla t ON pt.id_talla = t.idtalla GROUP BY pr.idProceso;";
        $resultado = $this->Conexion->query($sql);
        
        $movimientos = [];

        while ($fila = $resultado->fetch_assoc()) {
            $movimientos[] = $fila;
        }
        return $movimientos;
    }
    
 public function buscarMovimientos($busqueda)
{
    $sql = "SELECT 
  pr.idProceso, 
  pr.entradaproducto, 
  pr.fecha_entrada, 
  pr.ProductoidProducto, 
  pr.precioproveedor, 
  pr.total, 
  producto.nombreproducto AS producto,
  estados.tiposestados AS anadido,
  producto.precio AS precio,
  proveedor.nombreproveedor AS proveedor,
  GROUP_CONCAT(CONCAT(t.talla, ': ', pt.cantidad, ': ', pt.color) ORDER BY t.talla ASC SEPARATOR ', ') AS Detalle_Producto
FROM proceso pr
LEFT JOIN detalle_proceso pt ON pr.idProceso = pt.id_proceso
LEFT JOIN talla t ON pt.id_talla = t.idtalla
LEFT JOIN producto ON pr.ProductoidProducto = producto.idProducto
LEFT JOIN estados ON pr.anadido = estados.idestado
LEFT JOIN proveedor ON pr.ProveedoridProveedor = proveedor.idProveedor
WHERE proveedor.nombreproveedor LIKE ?
GROUP BY pr.idProceso;
";

    $stmt = $this->Conexion->prepare($sql);
    $param = "%$busqueda%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $productos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }

    $stmt->close();
    return $productos;
}
public function añadirmovimiento($entradaproducto, $fechaentrada, $ProductoidProducto, $TallaidTalla, $ProveedoridProveedor, $precioproveedor, $anadido, $total, $tallas, $cantidades, $colores)
{
    // Iniciar transacción
    $this->Conexion->begin_transaction();

    try {
        // Sumar todas las cantidades ingresadas desde el formulario
        $entradaproducto = array_sum($cantidades);

        // Calcular el total (precio del producto por la cantidad total ingresada)
        $total = $precioproveedor * $entradaproducto;

        // Guardar el valor 6 en la variable anadido
        $anadido = 6;

        
        // Insertar el nuevo movimiento en la tabla proceso
        $sql = "INSERT INTO `proceso`(`entradaProducto`, `fecha_entrada`, `productoidProducto`, `proveedoridproveedor`, `precioproveedor`, `anadido`, `total`) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("isiiiii", $entradaproducto, $fechaentrada, $ProductoidProducto, $ProveedoridProveedor, $precioproveedor, $anadido, $total);
        $stmt->execute();

        // Obtener el id del proceso insertado
        $idproceso = $this->Conexion->insert_id;

        // Recorrer las tallas y actualizar cantidades
        for ($i = 0; $i < count($tallas); $i++) {
            $talla = $tallas[$i];
            $cantidad = $cantidades[$i];
            $color = $colores[$i];

            if ($talla !== null && $cantidad !== null && $color !== null) {
                // Verificar si ya existe esa talla para ese producto
                $sql_check = "SELECT cantidad FROM producto_talla WHERE id_producto = ? AND id_talla = ?";
                $stmt_check = $this->Conexion->prepare($sql_check);
                $stmt_check->bind_param("ii", $ProductoidProducto, $talla);
                $stmt_check->execute();
                $stmt_check->store_result();

                if ($stmt_check->num_rows > 0) {
                    // Existe: obtenemos la cantidad actual
                    $stmt_check->bind_result($cantidadExistente);
                    $stmt_check->fetch();

                    // Sumamos la cantidad existente con la nueva
                    $nuevaCantidad = $cantidadExistente + $cantidad;

                    // Actualizamos
                    $sql_update = "UPDATE producto_talla SET cantidad = ?, color = ? WHERE id_producto = ? AND id_talla = ?";
                    $stmt_update = $this->Conexion->prepare($sql_update);
                    $stmt_update->bind_param("isii", $nuevaCantidad, $color, $ProductoidProducto, $talla);
                    $stmt_update->execute();
                    $stmt_update->close();
                } else {
                    // Si no existe, insertamos nueva combinación producto-talla
                    $sql_insert = "INSERT INTO producto_talla (id_producto, id_talla, cantidad, color) VALUES (?, ?, ?, ?)";
                    $stmt_insert = $this->Conexion->prepare($sql_insert);
                    $stmt_insert->bind_param("iiis", $ProductoidProducto, $talla, $cantidad, $color);
                    $stmt_insert->execute();
                    $stmt_insert->close();
                }

                $stmt_check->close();

                // Registrar siempre en detalle_proceso
        $sql_detalle = "INSERT INTO detalle_proceso (id_proceso, id_talla, color, cantidad) VALUES (?, ?, ?, ?)";
        $stmt_detalle = $this->Conexion->prepare($sql_detalle);
        $stmt_detalle->bind_param("iisi", $idproceso, $talla, $color, $cantidad);
        $stmt_detalle->execute();
        $stmt_detalle->close();
                
            }
        }


        // Confirmar la transacción
        $this->Conexion->commit();
        return $idproceso;

    } catch (Exception $e) {
        // En caso de error, hacer rollback
        $this->Conexion->rollback();
        throw $e;
    }
}

}
