<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../public/css/Geroyn.css">
      <link rel="stylesheet" href="../../public/css/pie.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Gero y Natis</title>
  <link rel="icon" href="../../public/images/Gero_y_Natis Logo.png" type="image/png">

</head>

<body>
<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está iniciada y si el usuario tiene el rol adecuado (rol 2 para vendedor)
if (!isset($_SESSION['sesion']) || $_SESSION['sesion'] == "" || $_SESSION['rol'] != 1) {
    // Si no está logueado o no tiene el rol de vendedor, mostrar alerta y redirigir
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso denegado',
            text: 'Debe iniciar sesión para acceder a esta página',
            showConfirmButton: true,
            confirmButtonText: "Aceptar",
        }).then(function() {
            window.location = "../Principal/inicio.html"; // Redirigir a la página de inicio de sesión
        });
    </script>
    <?php
    exit(); // Asegúrate de salir después de mostrar el mensaje
}
?>
  <!-- Header de Navegación Compacto -->
    <div class="header-nav">
        <div class="header-nav-background"></div>
        
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Botón atrás, Logo e imagen a la izquierda -->
                <div class="d-flex align-items-center">
                    <!-- Botón para ir atrás -->
                    <button class="btn-back me-3" onclick="window.location.href='../../app/Controllers/controladorInventario.php'"  title="Ir atrás">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    
                    <!-- Logo imagen -->
                    <img src="../../public/images/Gero_y_Natis Logo.png" alt="Logo Gero y Natis" class="logo-img">
                    
                    <!-- Nombre de la empresa -->
                    <a class="navbar-brand" href="#dashboard">
                        Gero y Natis
                    </a>
                </div>
                
                <!-- Botón hamburguesa para móvil -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavigation">
                    <i class="fas fa-bars" style="color: #333;"></i>
                </button>
                
                <!-- Links de navegación y menú de usuario -->
                <div class="collapse navbar-collapse" id="navbarNavigation">
                    <!-- Links centrados -->
                    <ul class="navbar-nav mx-auto">
                        
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorInventario.php"><i class="far fa-copy me-2"></i>Inicio</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorInventario2.php"><i class="fa-regular fa-clipboard"></i> Inventario</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorProveedores.php"><i class="bi bi-file-person"></i> Proveedores</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../../app/Controllers/controladorMovimiento.php"> <i class="bi bi-book-half"></i> Movimientos</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorVentas.php"><i class="fa-regular fa-credit-card"></i> Ventas</a>
                    </li>
                    </ul>
                    
                    <!-- Menú de usuario a la derecha -->
                    <div class="user-menu">
                        <a href="../../app/Controllers/controladorUsuario.php" class="btn-icon-nav" title="Usuarios">
                             <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="../../app/Views/Auth/Cerrar Sesion.php" class="btn-icon-nav" title="Cerrar sesión">
                            <i class="fa-solid fa-door-open"></i>
                        </a>
                        
                    </div>
                </div>
            </div>
        </nav>
    </div>


<div class="container" style="padding: 0 0 50px 0; font-family: Oswald, sans-serif;">
  <div class="row">
    <!--Inicio Portafolio-->
    <div class="col-md-10">
      <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Movimientos <i class="bi bi-book-half"></i></h2>
      <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes visualizar la entrada de los productos</p>
      <div class="search-container">
    <form method="GET" class="mb-4">
        <div class="input-group search-input">
            <span class="input-group-text bg-transparent border-0">
                <i class="fas fa-search search-icon"></i>
            </span>
            <input type="text" name="busqueda" placeholder="Buscar Movimiento" class="form-control border-0 shadow-none" aria-label="Buscar movimiento" value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
            <button type="submit" name="enviar" class="btn btn-primary bg-transparent border-0">
                <i class="fas fa-arrow-right search-icon"></i>
            </button>
        </div>
    </form>
</div>
      <hr>
<div class="Ordenado" style="display: flex; justify-content:center; gap: 10px; ">
        <div class="añadirr" style="border: 1px solid black; padding: 0px; border-radius: 60px; display: flex; justify-content: space-between; align-items: center;">
    <a href="../Views/Admin/ProveedoresMAñadir.php" style="font-size: 20px; color: black; text-decoration: none; padding: 15px; ">
     Añadir <i class="fa-solid fa-plus"></i>
  </a>
  </div>
  </div>
      <div class="row"> <!-- Nueva fila para las tarjetas -->
        <?php
        if (count($movimientos) > 0) {
            foreach ($movimientos as $row) {
                echo '
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4"> <!-- Cada tarjeta en su propia columna -->
                    <div class="card movement-card h-100">
                        <div class="card-body">
                            <div class="header-section">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="compact-title">Movimiento #' . ($row['idProceso']) . '</h5>
                                    <span class="badge bg-light text-dark" style="font-size: 0.7rem;">' . ($row['anadido']) . '</span>
                                </div>
                            </div>

                            <div class="row compact-section">
                                <div class="col-6">
                                    <small class="text-muted compact-text">Entrada</small>
                                    <p class="compact-value"><i class="bi bi-calendar3"></i> ' . ($row['fecha_entrada']) . '</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted compact-text">Proveedor</small>
                                    <p class="compact-value text-truncate"><i class="bi bi-person"></i> ' . ($row['proveedor']) . '</p>
                                </div>
                            </div>

                            <div class="compact-section">
                                <small class="text-muted compact-text">Producto</small>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-secondary me-1" style="font-size: 0.7rem;">ID: ' . ($row['ProductoidProducto']) . '</span>
                                    <h6 class="compact-value">' . ($row['producto']) . '</h6>
                                </div>
                            </div>

                            <div class="row compact-section">
                                <div class="col-6">
                                    <small class="text-muted compact-text">Cantidad</small>
                                    <p class="compact-value text-primary"><i class="bi bi-box"></i> ' . ($row['entradaproducto']) . '</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted compact-text">Tallas</small>
                                    <div>';
                                        $detalles = explode(', ', $row['Detalle_Producto']);
                                        foreach ($detalles as $detalle) {
                                            list($tallaID, $cantidad, $color) = explode(': ', $detalle);
                                            echo '<span class="badge bg-info badge-size me-1">' . $tallaID . ': ' . $cantidad . '</span>';
                                        }
                                    echo '</div>
                                </div>
                            </div>

                            <div class="price-section">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <small class="text-muted compact-text">Precio Proveedor</small>
                                        <p class="compact-price text-success">$' . number_format($row['precioproveedor']) . '</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted compact-text">Total</small>
                                        <p class="compact-price text-danger">$' . number_format($row['total']) . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>'; // cierre columna
            }
        } else {
            echo '<p class="text-center">No se han registrado movimientos.</p>';
        }
        ?>
      </div> <!-- cierre row -->
    </div> <!-- cierre col-md-10 -->
  </div> <!-- cierre row principal -->
</div> <!-- cierre container -->


  

   <!-- Footer -->
    <footer class="footer">
        <div class="footer-decorative">
            <i class="fas fa-tools"></i>
        </div>
        
        <div class="container">
            <!-- Marca Principal -->
            <div class="footer-brand">
                <h2 class="footer-logo">GERO Y NATIS</h2>
                <p class="footer-tagline">Sistema de Gestión de Inventario</p>
                <p class="footer-version">Versión 1.0.0 | Instalación Local</p>
            </div>

            <!-- Sección de Soporte Técnico -->
            <div class="support-section">
                <h5 class="support-title">
                    <i class="fas fa-headset"></i>
                    Soporte Técnico
                </h5>
                
                <div class="contact-grid">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-label">Teléfono</div>
                        <div class="contact-value">
                            <a href="tel:+525512345678">+57 301 143 0988</a>
                            <br>
                            <a href="tel:+525512345678">+57 302 133 4678</a>
                            <br>
                            <a href="tel:+525512345678">+57 301 460 0998</a>

                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-label">WhatsApp</div>
                        <div class="contact-value">
                            <a href="https://wa.me/573011480544">+57 301 444 9971</a>
                            <br>
                            <a href="https://wa.me/573005467787">+57 300 546 7787</a>
                            <br>
                            <a href="https://wa.me/573014568799">+57 301 456 8799</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">
                            <a href="mailto:soporte@tuempresa.com">daniel_bermeo@soy.sena.edu.co</a>
                            <br>
                            <a href="mailto:soporte@tuempresa.com">deisy_gonzalez@soy.sena.edu.co</a>
                            <br>
                            <a href="mailto:soporte@tuempresa.com">vanessa_mateus@soy.sena.edu.co</a>
                        </div>
                    </div>

                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-label">Horario</div>
                        <div class="contact-value">
                            Lun - Vie: 9:00 - 18:00
                        </div>
                    </div>
                </div>

                <!-- Contacto de Emergencia -->
                <div class="emergency-contact">
                    <div class="contact-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="contact-label">Emergencias 24/7</div>
                    <div class="contact-value">
                        <a href="tel:+525587654321">+52 304 555 7689</a>
                    </div>
                </div>
            </div>

            <!-- Información del Sistema -->
            <div class="system-info">
                <div class="info-item">
                    <i class="fas fa-server"></i>
                    <span>Sistema Local</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Datos Seguros</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-tools"></i>
                    <span>Mantenimiento Incluido</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Capacitación Disponible</span>
                </div>
            </div>

            <!-- Divisor -->
            <div class="footer-divider"></div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    <strong>@2024</strong> <strong>Advertencia: </strong>Todos los derechos reservados. 
                    | Sistema desarrollado para <strong>Gero y Natis</strong> | ¿Problemas? Contáctanos arriba
                </p>
            </div>
        </div>
    </footer>

  </div>

  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>