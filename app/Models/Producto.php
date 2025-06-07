<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../../vendor/autoload.php';  // Carga las librerías de Composer

use App\Config\Database; 
use Dotenv\Dotenv;          // CORRECTO uso del namespace para Dotenv
use Cloudinary\Cloudinary;  

// Ajusta la ruta a la raíz de tu proyecto (normalmente 2 niveles arriba si estás en app/Models)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();



class Producto
{
    private $idProducto;
    private $nombreProducto;
    private $cantidadp;
    private $precio;
    private $color;
    private $iva;
    private $estado;
    private $talla;
    private $foto;
    private $categoria;
    private $Conexion;

    public function __construct($idProducto = null, $nombreProducto = null, $cantidadp = null, $precio = null, $color = null, $iva = null, $estado = null, $talla = null, $Conexion = null, $foto = null, $categoria = null)
    {
        $this->idProducto = $idProducto;
        $this->nombreProducto = $nombreProducto;
        $this->cantidadp = $cantidadp;
        $this->precio = $precio;
        $this->color = $color;
        $this->iva = $iva;
        $this->estado = $estado;
        $this->talla = $talla;
        $this->foto = $foto;
        $this->categoria = $categoria;
        $this->Conexion = Database::getConnection();
    }

    public function obtenerProductos()
    {
        $sql ="SELECT P.idProducto, P.nombreproducto, P.precio, P.iva, P.imagen, P.CategoriaidCategoria, C.categoria, P.id_estado, S.tiposestados, GROUP_CONCAT(CONCAT(T.talla, ': ', DP.cantidad, ': ', DP.color) ORDER BY T.idtalla ASC SEPARATOR ', ') AS Detalle_Producto, SUM(DP.cantidad) AS total_unidades FROM producto P JOIN estados S ON P.id_estado = S.idestado JOIN producto_talla DP ON P.idProducto = DP.id_producto JOIN talla T ON T.idtalla = DP.id_talla JOIN categoria C ON C.idCategoria = P.CategoriaidCategoria  GROUP BY P.idProducto;";
        $resultado = $this->Conexion->query($sql);
        $productos = [];

        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
        return $productos;
    }

    public function obtenerProductoz()
    {
        $sql ="SELECT p.idProducto, p.nombreproducto, p.imagen , GROUP_CONCAT( CONCAT(dt.Talla, ': ', dt.cantidad_vendida) ORDER BY dt.Talla SEPARATOR ', ' ) AS detalle_por_talla, SUM(dt.cantidad_vendida) AS total_producto FROM producto p JOIN ( SELECT p.idProducto, t.Talla, COALESCE(SUM(dv.cantidad), 0) AS cantidad_vendida FROM producto p CROSS JOIN talla t LEFT JOIN detalle_factura dv ON p.idProducto = dv.ProductoidProducto AND t.idTalla = dv.idTalla GROUP BY p.idProducto, t.idTalla ) AS dt ON p.idProducto = dt.idProducto GROUP BY p.idProducto ORDER BY total_producto DESC LIMIT 10;";
        $resultado = $this->Conexion->query($sql);
        $product = [];

        while ($fila = $resultado->fetch_assoc()) {
            $product[] = $fila;
        }
        return $product;
    }

    public function buscarProductos($busqueda) {
    $busqueda = $this->Conexion->real_escape_string($busqueda);
    $sql = "SELECT p.idProducto, p.nombreproducto, p.imagen,
        GROUP_CONCAT(CONCAT(dt.Talla, ': ', dt.cantidad_vendida) ORDER BY dt.Talla SEPARATOR ', ') AS detalle_por_talla,
        SUM(dt.cantidad_vendida) AS total_producto
        FROM producto p
        JOIN (
            SELECT p.idProducto, t.Talla, COALESCE(SUM(dv.cantidad), 0) AS cantidad_vendida
            FROM producto p
            CROSS JOIN talla t
            LEFT JOIN detalle_factura dv ON p.idProducto = dv.ProductoidProducto AND t.idTalla = dv.idTalla
            GROUP BY p.idProducto, t.idTalla
        ) AS dt ON p.idProducto = dt.idProducto
        WHERE p.nombreproducto LIKE '%$busqueda%'
        GROUP BY p.idProducto
        ORDER BY total_producto DESC;";
    
    $resultado = $this->Conexion->query($sql);
    $product = [];

    while ($fila = $resultado->fetch_assoc()) {
        $product[] = $fila;
    }
    return $product;
}


    public function buscarProducto($busqueda)
{
    $sql = "SELECT P.idProducto, P.nombreproducto, P.precio, P.iva, P.imagen, P.CategoriaidCategoria, C.categoria, P.id_estado, S.tiposestados, 
            GROUP_CONCAT(CONCAT(T.talla, ': ', DP.cantidad, ': ', DP.color) ORDER BY T.idtalla ASC SEPARATOR ', ') AS Detalle_Producto, 
            SUM(DP.cantidad) AS total_unidades 
            FROM producto P 
            JOIN estados S ON P.id_estado = S.idestado 
            JOIN producto_talla DP ON P.idProducto = DP.id_producto 
            JOIN talla T ON T.idtalla = DP.id_talla 
            JOIN categoria C ON C.idCategoria = P.CategoriaidCategoria 
            WHERE P.id_estado = 3 AND P.nombreproducto LIKE ? 
            GROUP BY P.idProducto";

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

public function obtenerTallas()
{
    $sql = "SELECT idtalla, talla FROM talla";
    $resultado = $this->Conexion->query($sql);

    $tallas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $tallas[] = $fila;
    }

    return $tallas;
}

public function obtenerCategorias()
{
    $sql = "SELECT idCategoria, categoria FROM categoria";
    $resultado = $this->Conexion->query($sql);

    $categorias = [];
    while ($fila = $resultado->fetch_assoc()) {
        $categorias[] = $fila;
    }

    return $categorias;
}

public function obtenerProveedor()
{
    $sqlpro = "SELECT `idProveedor`, `nombreproveedor`, `Telefono`, `productos` FROM `proveedor`";
    $resultadopro = $this->Conexion->query($sqlpro);

    $proveedor = [];
    while ($fila = $resultadopro->fetch_assoc()) {
        $proveedor[] = $fila;
    }

    return $proveedor;
}

public function obtenerEstado()
{
    $sqlest = "SELECT idestado, tiposestados FROM estados WHERE idestado = 3 OR idestado = 4;";
    $resultadoest = $this->Conexion->query($sqlest);

    $estado = [];
    while ($fila = $resultadoest->fetch_assoc()) {
        $estado[] = $fila;
    }

    return $estado;
}

public function obtenerEstados()
{
    $sqlest = "SELECT idestado, tiposestados FROM estados WHERE idestado = 1 OR idestado = 2;";
    $resultadoest = $this->Conexion->query($sqlest);

    $estado = [];
    while ($fila = $resultadoest->fetch_assoc()) {
        $estado[] = $fila;
    }

    return $estado;
}

public function obtenerProdu()
{
    $sql = "SELECT `idProducto`, `nombreproducto`, precio FROM `producto`";
    $resultado = $this->Conexion->query($sql);

    $produ = [];
    while ($fila = $resultado->fetch_assoc()) {
        $produ[] = $fila;
    }

    return $produ;
}

function consultarProv(){
    // Consulta SQL para obtener las tallas
$sqlproceso = "SELECT `idProveedor`, `nombreproveedor`, `Telefono`, `productos` FROM `proveedor`";
$resultadoproceso = $this->Conexion->query($sqlproceso);

$prov = [];
    while ($fila = $resultadoproceso->fetch_assoc()) {
        $prov[] = $fila;
    }

    return $prov;
}


    
public function añadirProducto($foto, $nombreProducto, $precio, $precioproveedor, $color, $categoria, $estado, $tallas, $cantidades, $colores, $fechaEntrada, $proveedorId)
{
    $this->Conexion->begin_transaction();

    try {
        // 🔁 Subir imagen a Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'dmcwfn5kq',
                'api_key'    => $_ENV['CLAUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLAUDINARY_API_SECRET'],
            ]
        ]);

        $upload = $cloudinary->uploadApi()->upload($foto);
        $urlImagen = $upload['secure_url']; // URL de la imagen subida

        $iva = 19; // IVA fijo

        // 📝 Insertar el producto en la tabla `producto` con la URL de Cloudinary
        $sql = "INSERT INTO producto(nombreproducto, precio, iva, imagen, CategoriaidCategoria, id_estado) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("siisii", $nombreProducto, $precio, $iva, $urlImagen, $categoria, $estado);
        $stmt->execute();

        $idProducto = $this->Conexion->insert_id;
        $stmt->close();

        // 📏 Insertar en producto_talla
        for ($i = 0; $i < count($tallas); $i++) {
            $talla = $tallas[$i];
            $cantidad = $cantidades[$i];
            $color = $colores[$i];

            // Validar que no estén vacíos y sean coherentes
            if ($talla !== null && $cantidad !== null && $color !== null) {
                $sql = "INSERT INTO producto_talla (id_producto, id_talla, cantidad, color) VALUES (?, ?, ?, ?)";
                $stmt = $this->Conexion->prepare($sql);
                $stmt->bind_param("iiis", $idProducto, $talla, $cantidad, $color);
                $stmt->execute();
                $stmt->close();
            }
        }

        // 💰 Calcular el total e insertar en proceso
        $cantidadTotal = array_sum($cantidades);
        $total = $precioproveedor * $cantidadTotal;
        $anadido = 5;

        $sql = "INSERT INTO proceso (entradaProducto, fecha_entrada, productoidProducto, proveedoridproveedor, anadido, total, precioproveedor) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("isiiiii", $cantidadTotal, $fechaEntrada, $idProducto, $proveedorId, $anadido, $total, $precioproveedor);
        $stmt->execute();

        $idProceso = $this->Conexion->insert_id; // Obtener el ID del proceso insertado
        $stmt->close();

        // 📏 Insertar en detalle_proceso (los mismos datos)
        for ($i = 0; $i < count($tallas); $i++) {
            $talla = $tallas[$i];
            $cantidad = $cantidades[$i];
            $color = $colores[$i];

            // Validar que no estén vacíos y sean coherentes
            if ($talla !== null && $cantidad !== null && $color !== null) {
                $sql = "INSERT INTO detalle_proceso (id_proceso, id_talla, cantidad, color) VALUES (?, ?, ?, ?)";
                $stmt = $this->Conexion->prepare($sql);
                $stmt->bind_param("iiis", $idProceso, $talla, $cantidad, $color);
                $stmt->execute();
                $stmt->close();
            }
        }

        $this->Conexion->commit();
       header("Location: ../../app/Controllers/controladorInventario2.php?success=1");

        exit();

    } catch (Exception $e) {
        $this->Conexion->rollback();
        throw $e;
    }
}

 public function actualizarProducto($idProducto, $nombreProducto, $precio, $categoria, $estado)
    {
        // Asegúrate de mantener la conexión abierta
        $sql = 'UPDATE `producto` SET nombreproducto=?, precio=?, CategoriaidCategoria=?, id_estado=? WHERE idProducto=?';
        $stmt = $this->Conexion->prepare($sql);
$stmt->bind_param("siiii", $nombreProducto, $precio, $categoria, $estado, $idProducto);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function borrarProducto($idProducto, $nombreProducto, $cantidadp, $precio, $color, $iva, $categoria, $estado, $talla)
    {
        // Database connection should be established once in the constructor
        // or passed to the method. Removing the Conectarse() call here.

        $sql = "UPDATE `producto` SET `id_estado`= '4'WHERE idProducto=?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $idProducto);
        $resultado = $stmt->execute();
        $stmt->close();
        // Do not close connection here if it's reused across the application
        // $this->Conexion->close(); 
        if ($resultado) {
            header("Location: ../../app/Controllers/controladorInventario2.php?success=1");
            exit();
        }

        return $resultado;
    }
}