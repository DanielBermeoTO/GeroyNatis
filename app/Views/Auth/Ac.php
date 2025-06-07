<?php
// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "geroynatis");
if ($mysqli->connect_errno) {
    die("Error al conectar: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);

    // Actualizar la contraseña en la tabla `sesion` usando AES_ENCRYPT
    $sql = "UPDATE sesion 
            SET contrasena = ?, 
                token = NULL, 
                token_expiry = NULL 
            WHERE documento = '$documento'";

              $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $hash);

    if ($stmt->execute()) {
        header("Location: ./IniciarSesion.php?message=okay");
        exit;
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    $stmt->close();
}
?>
