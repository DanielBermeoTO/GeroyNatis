<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("localhost", "root", "", "geroynatis");
if ($mysqli->connect_errno) {
    die("Error al conectar: " . $mysqli->connect_error);
}

session_start(); // Iniciar sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST['documento'];
    $Password = $_POST['contrasena'];
    echo "<br>";
    echo "<br>";

    // Consulta para obtener la contraseña y rol del usuario activo
    $query = "SELECT s.contrasena, u.idrol 
              FROM sesion s 
              JOIN usuario u ON u.documento = s.documento 
              WHERE s.documento = ? AND u.id_estado = 3";

    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        die("Error en la consulta: " . $mysqli->error);
    }

    $stmt->bind_param("i", $documento);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($contrasenna, $idrol);
        $stmt->fetch();

        if (password_verify($Password, $contrasenna)) {
            $_SESSION['sesion'] = $documento;
            $_SESSION['rol'] = $idrol;

            if ($idrol == 1) {
                // Administrador
                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sesión iniciada',
                        text: 'Bienvenido Administrador',
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar"
                    }).then(function () {
                        window.location = "../../Controllers/controladorInventario.php";
                    });
                </script>
                <?php
            } elseif ($idrol == 2) {
                // Vendedor
                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sesión iniciada',
                        text: 'Bienvenido vendedor',
                        showConfirmButton: true,
                        confirmButtonText: "Aceptar"
                    }).then(function () {
                        window.location = "../../Controllers/UsuarioInventario.php";
                    });
                </script>
                <?php
            }
        } else {
            // Contraseña incorrecta
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Contraseña incorrecta',
                    showConfirmButton: true,
                    confirmButtonText: "Devolver"
                }).then(function () {
                    window.location = "./IniciarSesion.php";
                });
            </script>
            <?php
        }
    } else {
        // Verificar si el documento existe pero no está activo
        $query_estado = "SELECT id_estado FROM usuario WHERE documento = ?";
        $stmt_estado = $mysqli->prepare($query_estado);
        $stmt_estado->bind_param("i", $documento);
        $stmt_estado->execute();
        $stmt_estado->store_result();

        if ($stmt_estado->num_rows > 0) {
            $stmt_estado->bind_result($id_estado);
            $stmt_estado->fetch();
            if ($id_estado != 3) {
                // Usuario inactivo
                ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'info',
                        title: 'Usuario inactivo',
                        text: 'Tu cuenta no está activa. Contacta con el administrador.',
                        showConfirmButton: true,
                        confirmButtonText: "Volver"
                    }).then(function () {
                        window.location = "./IniciarSesion.php";
                    });
                </script>
                <?php
            }
        } else {
            // Documento completamente inexistente
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Usuario no encontrado',
                    text: 'El documento no está registrado',
                    showConfirmButton: true,
                    confirmButtonText: "Devolver"
                }).then(function () {
                    window.location = "./IniciarSesion.php";
                });
            </script>
            <?php
        }

        $stmt_estado->close();
    }

    $stmt->close();
}

$mysqli->close();
?>
