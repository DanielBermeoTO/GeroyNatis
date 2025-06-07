<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../../vendor/autoload.php';  // Carga las librerías de Composer

use App\Config\Database;
use Dotenv\Dotenv;          

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
class Proveedor
{
    private $idProveedor;
    private $nombreproveedor;
    private $Telefono;
    private $producto;
    private $Conexion;

    public function __construct($idProveedor = null, $nombreproveedor = null, $Telefono = null, $Conexion = null, $producto = null)
    {
        $this->idProveedor = $idProveedor;
        $this->nombreproveedor = $nombreproveedor;
        $this->Telefono = $Telefono;
        $this->producto = $producto;
        $this->Conexion = Database::getConnection();
    }

    public function consultarProveedor()
    {
        // No cierres la conexión aquí
        $sql = "SELECT `idProveedor`, `nombreproveedor`, `Telefono`, `productos`, (SELECT `nombreproducto` FROM producto WHERE producto.idProducto = proveedor.productos) AS producto FROM proveedor;";
        $resultado = $this->Conexion->query($sql);
        $proveedores = [];

        while ($fila = $resultado->fetch_assoc()) {
            $proveedores[] = $fila;
        }
        return $proveedores;
    }

       public function buscarProducto($busqueda)
{
    $sql = "SELECT `idProveedor`, `nombreproveedor`, `Telefono`, `productos`, (SELECT `nombreproducto` FROM producto WHERE producto.idProducto = proveedor.productos) AS producto FROM proveedor WHERE nombreproveedor LIKE ?;";

    $stmt = $this->Conexion->prepare($sql);
    $param = "%$busqueda%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $proveedores = [];
    while ($fila = $resultado->fetch_assoc()) {
        $proveedores[] = $fila;
    }

    $stmt->close();
    return $proveedores;
}




function consultartalla(){
    // Consulta SQL para obtener las tallas
$sqlt = "SELECT `idProducto`, `nombreproducto` FROM `producto`;";
$resultadot = $this->Conexion->query($sqlt);

$tallas = [];
    while ($fila = $resultadot->fetch_assoc()) {
        $tallas[] = $fila;
    }

    return $tallas;
}

    public function añadirProveedor($nombreproveedor, $Telefono, $producto)
    {
        // Asegúrate de no haber cerrado la conexión previamente
        $sql = "INSERT INTO `proveedor`(`nombreproveedor`, Telefono, productos) VALUES (?,?,?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("sii", $nombreproveedor, $Telefono, $producto);
        $stmt->execute();
        $idProveedor = $this->Conexion->insert_id;
        $stmt->close();
        return $idProveedor;
    }

    public function actualizarProveedor($idProveedor, $nombreproveedor, $Telefono, $producto)
    {
        // Asegúrate de mantener la conexión abierta
        $sql = 'UPDATE `proveedor` SET `nombreproveedor`= ?,`Telefono`= ?,`productos`= ? WHERE `idProveedor`=?';
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("siii", $nombreproveedor, $Telefono, $producto, $idProveedor);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    // Método para cerrar la conexión cuando todo haya terminado
    public function cerrarConexion()
    {
        $this->Conexion->close();
    }
}
