<?php

require __DIR__ . '/../../../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Nombre : PHPMailer
// Contraseña: wcrb nibs sbhe fywe
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mysqli = new mysqli("localhost", "root", "", "geroynatis");
if ($mysqli->connect_errno) {
    die("Error al conectar: " . $mysqli->connect_error); // Mostrar error si falla la conexión
}

$correo = $_POST['correo'];
$sql = "SELECT * FROM `usuario` WHERE correo = '$correo' AND id_estado = 3;";
$resultado = $mysqli->query($sql);

if (isset($_POST['submitContact'])) {
    // Crear una instancia de PHPMailer; pasando `true` habilita las excepciones
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();                                            // Enviar usando SMTP
        $mail->SMTPAuth   = true;                                   // Habilitar autenticación SMTP
        $mail->Host       = 'smtp.gmail.com';                         // Establecer el servidor SMTP
        $mail->Username   = 'geroynatis2@gmail.com';                  // Nombre de usuario SMTP
        $mail->Password   = 'blrcnoxntrywanhv';                       // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Habilitar cifrado TLS
        $mail->Port       = 587;                                     // Puerto TCP para conectarse (587 para STARTTLS)

        // Destinatarios
        $mail->setFrom('geroynatis2@gmail.com', 'Gero y Natis');
        
        // Verificar si se ha encontrado un usuario y si el correo es válido
        if ($resultado && $resultado->num_rows > 0) {
            // Si se encuentra el correo en la base de datos, añadirlo como destinatario
            $mail->addAddress($correo);  // Se añade el correo del usuario
        } else {
            header("Location: ./IniciarSesion.php?message=Usuario no encontrado");
            exit;
        }

        // Generar un enlace único para el restablecimiento de la contraseña
        $token = bin2hex(random_bytes(16));  // Token único para la seguridad (se puede guardar en la base de datos)
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expira en 1 hora

        // Guardar el token en la base de datos
        $sqlToken = "UPDATE sesion 
            INNER JOIN usuario ON sesion.documento = usuario.documento
            SET sesion.token = ?, sesion.token_expiry = ?
            WHERE usuario.correo = ?";
        
        // Preparar la consulta
        $stmt = $mysqli->prepare($sqlToken);
        $stmt->bind_param('sss', $token, $expiry, $correo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Token actualizado exitosamente, continuar con el envío del correo
                $url = "http://localhost/GeroyNatis/app/Views/Auth/Actualizarcontraseña.php?token=" . $token;
                
                // Contenido del correo
                $mail->isHTML(true);                                  // Establecer el formato del correo a HTML
                $mail->Subject = 'Recuperar Contraseña';
                $mail->Body = '
                    <h3>Hola, has solicitado recuperar tu contraseña.</h3>
                    <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                    <a href="' . $url . '" target="_blank">Restablecer mi contraseña</a>
                    <p>Si no solicitaste este cambio, ignora este correo.</p>
                ';

                // Enviar el correo
                $mail->send();
                header("Location: ./IniciarSesion.php?message=ok");
            } else {
                // Si no se actualizó ninguna fila, mostrar un mensaje de error
                echo "No se pudo actualizar el token. Verifica que el correo sea correcto.";
                exit;
            }
        } else {
            echo "Error en la consulta: " . $stmt->error;
            exit;
        }

    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error del Mailer: {$mail->ErrorInfo}";
    }
}
?>

