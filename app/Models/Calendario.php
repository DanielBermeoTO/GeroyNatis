<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Incluir el archivo de conexión
require_once __DIR__ . '/../Config/Database.php';

// Usar la clase con namespace
use App\Config\Database;

try {
    // Obtener conexión
    $conexion = Database::getConnection();
    
    // Si se proporciona una fecha específica
    if (isset($_GET['fecha'])) {
        $date = $conexion->real_escape_string($_GET['fecha']);
        
        // Obtener facturas del día
        $query_invoices = "
            SELECT idFactura as id, total 
            FROM factura
            WHERE DATE(fechaventa) = '$date'
            ORDER BY idFactura DESC
        ";
        
        $result_invoices = $conexion->query($query_invoices);
        
        if (!$result_invoices) {
            throw new Exception('Error en consulta SQL: ' . $conexion->error);
        }
        
        $invoices = [];
        while ($row = $result_invoices->fetch_assoc()) {
            $invoices[] = $row;
        }
        
        // Devolver las facturas
        echo json_encode($invoices);
        
    } else {
        // Obtener datos para los eventos del calendario
        $query = "
            SELECT DATE(fechaventa) as date, 
                   SUM(total) as daily_sales,
                   COUNT(*) as invoice_count
            FROM factura
            WHERE MONTH(fechaventa) = MONTH(CURRENT_DATE())
              AND YEAR(fechaventa) = YEAR(CURRENT_DATE())
            GROUP BY DATE(fechaventa)
            ORDER BY date
        ";
        
        $result = $conexion->query($query);
        
        if (!$result) {
            throw new Exception('Error en consulta SQL del calendario: ' . $conexion->error);
        }
        
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = [
                'title' => '$' . number_format($row['daily_sales'], 0) . ' (' . $row['invoice_count'] . ' facturas)',
                'start' => $row['date'],
                'backgroundColor' => '#b93f39',
                'borderColor' => '#8b2f29',
                'textColor' => 'white'
            ];
        }
        
        echo json_encode($events);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error del servidor',
        'mensaje' => $e->getMessage()
    ]);
}
?>