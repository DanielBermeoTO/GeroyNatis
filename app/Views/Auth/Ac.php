<?php
require_once __DIR__ . '/../../Config/Database.php';
require_once __DIR__ . '/../../../vendor/autoload.php';  



use App\Config\Database;


$mysqli = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);

    // Actualizar la contraseña en la tabla `sesion` usando prepared statement
    $sql = "UPDATE sesion 
            SET contrasena = ?, 
                token = NULL, 
                token_expiry = NULL 
            WHERE documento = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $hash, $documento);

    if ($stmt->execute()) {
        header("Location: ./IniciarSesion.php?message=okay");
        exit;
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    $stmt->close();
}
?>
