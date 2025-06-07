<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../../vendor/autoload.php';  // Carga las librerías de Composer

use App\Config\Database; 
use Dotenv\Dotenv;          // CORRECTO uso del namespace para Dotenv

// Ajusta la ruta a la raíz de tu proyecto (normalmente 2 niveles arriba si estás en app/Models)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Venta
{
    private $idFactura;
    private $fechaventa;
    private $subtotal;
    private $total;
    private $id_estadof;
    private $ProductoidProducto;
    private $valorunitario;
    private $cantidad;
    private $cliente;
    private $Conexion;

    public function __construct($idFactura = null, $fechaventa = null, $subtotal = null, $total = null, $id_estadof = null, $ProductoidProducto = null, $valorunitario = null, $cantidad = null, $cliente = null)
    {
        $this->idFactura = $idFactura;
        $this->fechaventa = $fechaventa;
        $this->subtotal = $subtotal;
        $this->total = $total;
        $this->id_estadof = $id_estadof;
        $this->ProductoidProducto = $ProductoidProducto;
        $this->valorunitario = $valorunitario;
        $this->cantidad = $cantidad;
        $this->cliente = $cliente;
        $this->Conexion = Database::getConnection(); 
    }

    public function obtenerVentas()
    {
        $sqlv = "SELECT FV.idFactura,df.cliente, FV.fechaventa, FV.subtotal, FV.total,FV.usuario,(SELECT nombre FROM usuario WHERE FV.usuario = usuario.documento) AS nombre,(SELECT apellido FROM usuario WHERE FV.usuario = usuario.documento) AS apellido, (SELECT estados.tiposestados FROM estados WHERE FV.id_estadof = estados.idestado) AS estadi, GROUP_CONCAT(CONCAT(p.idProducto, ': ', p.nombreproducto, ' : ', df.cantidad, ': ', df.valorunitario, ': ', p.iva, ': ') SEPARATOR ', ') AS productos, SUM(df.cantidad) AS total_cantidad FROM detalle_factura df INNER JOIN factura AS FV ON df.FacturaidFactura = FV.idFactura INNER JOIN producto p ON df.ProductoidProducto = p.idProducto INNER JOIN estados AS E ON FV.id_estadof = E.idestado GROUP BY FV.idFactura, FV.fechaventa, FV.subtotal, FV.total, FV.id_estadof, E.tiposestados ORDER BY FV.idFactura DESC;";
        $resultado = $this->Conexion->query($sqlv);
        $venta = [];

        while ($fila = $resultado->fetch_assoc()) {
            $venta[] = $fila;
        }
        return $venta; // No cerrar la conexión aquí
    }

     public function buscarVentas($busqueda)
{
    $sql = "SELECT FV.idFactura,df.cliente, FV.fechaventa, FV.subtotal, FV.total,FV.usuario,(SELECT nombre FROM usuario WHERE FV.usuario = usuario.documento) AS nombre,(SELECT apellido FROM usuario WHERE FV.usuario = usuario.documento) AS apellido, (SELECT estados.tiposestados FROM estados WHERE FV.id_estadof = estados.idestado) AS estadi, GROUP_CONCAT(CONCAT(p.idProducto, ': ', p.nombreproducto, ' : ', df.cantidad, ': ', df.valorunitario, ': ', p.iva, ': ') SEPARATOR ', ') AS productos, SUM(df.cantidad) AS total_cantidad FROM detalle_factura df INNER JOIN factura AS FV ON df.FacturaidFactura = FV.idFactura INNER JOIN producto p ON df.ProductoidProducto = p.idProducto INNER JOIN estados AS E ON FV.id_estadof = E.idestado WHERE FV.idFactura LIKE ? GROUP BY FV.idFactura, FV.fechaventa, FV.subtotal, FV.total, FV.id_estadof, E.tiposestados ORDER BY FV.idFactura DESC;";

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

   public function agregarVenta($fechaventa, $id_estadof, $productos, $documento) {
    if (!$this->Conexion->ping()) {
        throw new Exception("La conexión a la base de datos se ha cerrado.");
    }

    // Verificar inventario antes de continuar
    foreach ($productos as $producto) {
        $ProductoidProducto = $producto['idProducto'];
        $talla = $producto['talla'];
        $cantidad = $producto['cantidad'];

        $sqlVerificarInventario = "SELECT cantidad FROM `producto_talla` WHERE id_producto = ? AND id_talla = ?";
        $stmtVerificar = $this->Conexion->prepare($sqlVerificarInventario);
        if (!$stmtVerificar) {
            throw new Exception("Error en verificación de inventario: " . $this->Conexion->error);
        }
        $stmtVerificar->bind_param("ii", $ProductoidProducto, $talla);
        $stmtVerificar->execute();
        $stmtVerificar->bind_result($cantidadDisponible);
        $stmtVerificar->fetch();
        $stmtVerificar->close();

        if ($cantidad > $cantidadDisponible) {
            header("Location: ../../app/Views/Web/UsuarioAñadirVenta.php?error=pocosproductos");
            exit;
        }
    }

    // Calcular subtotal e IVA
    $subtotal = 0;
    $ivaTotal = 0;

    foreach ($productos as $producto) {
        $ProductoidProducto = $producto['idProducto'];
        $valorunitario = $producto['valorunitario'];
        $cantidad = $producto['cantidad'];

        $sqlIva = "SELECT iva FROM `producto` WHERE idProducto = ?";
        $stmtIva = $this->Conexion->prepare($sqlIva);
        if (!$stmtIva) {
            throw new Exception("Error en la consulta de IVA: " . $this->Conexion->error);
        }
        $stmtIva->bind_param("i", $ProductoidProducto);
        $stmtIva->execute();
        $stmtIva->bind_result($iva);
        $stmtIva->fetch();
        $stmtIva->close();

        $subtotal += $valorunitario * $cantidad;
        $ivaTotal += ($valorunitario * $cantidad) * ($iva / 100);
    }

    $total = $subtotal + $ivaTotal;

    // Insertar factura
    $sql = "INSERT INTO `factura`(`fechaventa`, `id_estadof`, `subtotal`, `total`, `usuario`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->Conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al insertar factura: " . $this->Conexion->error);
    }
    $stmt->bind_param("ssidi", $fechaventa, $id_estadof, $subtotal, $total, $documento);
    $stmt->execute();
    $idFactura = $this->Conexion->insert_id;
    $stmt->close();

    // Insertar detalle factura y actualizar inventario
    $sqlDetalle = "INSERT INTO `detalle_factura`(`FacturaidFactura`, `ProductoidProducto`,`idTalla`, `valorunitario`, `cantidad`, `cliente`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtDetalle = $this->Conexion->prepare($sqlDetalle);
    if (!$stmtDetalle) {
        throw new Exception("Error en la consulta de detalles: " . $this->Conexion->error);
    }

    foreach ($productos as $producto) {
        $ProductoidProducto = $producto['idProducto'];
        $talla = $producto['talla'];
        $valorunitario = $producto['valorunitario'];
        $cantidad = $producto['cantidad'];
        $cliente = $producto['cliente'];

        $stmtDetalle->bind_param("iiiidi", $idFactura, $ProductoidProducto, $talla, $valorunitario, $cantidad, $cliente);
        if (!$stmtDetalle->execute()) {
            throw new Exception("Error al ejecutar detalle_factura: " . $stmtDetalle->error);
        }

        // Actualizar inventario en producto_talla
        $sqlActualizarInventario = "UPDATE `producto_talla` SET cantidad = cantidad - ? WHERE id_producto = ? AND id_talla = ?";
        $stmtActualizarInventario = $this->Conexion->prepare($sqlActualizarInventario);
        if (!$stmtActualizarInventario) {
            throw new Exception("Error al preparar actualización de inventario: " . $this->Conexion->error);
        }
        $stmtActualizarInventario->bind_param("iii", $cantidad, $ProductoidProducto, $talla);
        $stmtActualizarInventario->execute();
        $stmtActualizarInventario->close();

        // Inhabilitar producto si ya no hay unidades en ninguna talla
        $sqlVerificarStockTotal = "SELECT SUM(cantidad) FROM producto_talla WHERE id_producto = ?";
        $stmtVerificarStock = $this->Conexion->prepare($sqlVerificarStockTotal);
        if (!$stmtVerificarStock) {
            throw new Exception("Error al verificar stock total: " . $this->Conexion->error);
        }
        $stmtVerificarStock->bind_param("i", $ProductoidProducto);
        $stmtVerificarStock->execute();
        $stmtVerificarStock->bind_result($stockTotal);
        $stmtVerificarStock->fetch();
        $stmtVerificarStock->close();

        if ($stockTotal <= 0) {
            $sqlInhabilitarProducto = "UPDATE `producto` SET `id_estado` = 4 WHERE idProducto = ?";
            $stmtInhabilitar = $this->Conexion->prepare($sqlInhabilitarProducto);
            if (!$stmtInhabilitar) {
                throw new Exception("Error al inhabilitar producto: " . $this->Conexion->error);
            }
            $stmtInhabilitar->bind_param("i", $ProductoidProducto);
            $stmtInhabilitar->execute();
            $stmtInhabilitar->close();
        }
    }

    $stmtDetalle->close();
    return $idFactura;
}

    
    
    
}
