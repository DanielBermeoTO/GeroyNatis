<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../public/css/Geroyn.css">
  <link rel="stylesheet" href="../../public/css/ventas.css">
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
                        <a class="nav-link" href="../../app/Controllers/controladorMovimiento.php"> <i class="bi bi-book-half"></i> Movimientos</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../../app/Controllers/controladorVentas.php"><i class="fa-regular fa-credit-card"></i> Ventas</a>
                    </li>
                    </ul>
                    
                    <!-- Menú de usuario a la derecha -->
                    <div class="user-menu">
                        <a href="../../app/Views/Admin/Calendario.html" class="btn-icon-nav" title="Calendario">
                            <i class="fa-solid fa-calendar-days"></i>
                        </a>
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
<br>
  <div class="container" style="padding: 0 0 50px 0;  font-family: Oswald, sans-serif;">
    <div class="row">
  
    
  </div>
  
      <!--Inicio Portafolio-->
      <div class="col-md-10">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Tus Ventas <i class="bi bi-credit-card"></i></h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes visualizar las ventas realizadas.</p>
        <div class="search-container">
    <form method="GET" class="mb-4">
        <div class="input-group search-input">
            <span class="input-group-text bg-transparent border-0">
                <i class="fas fa-search search-icon"></i>
            </span>
            <input type="text" name="busqueda" placeholder="Buscar venta" class="form-control border-0 shadow-none" aria-label="Buscar venta" value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
            <button type="submit" name="enviar" class="btn btn-primary bg-transparent border-0">
                <i class="fas fa-arrow-right search-icon"></i>
            </button>
        </div>
    </form>
</div>
        <hr>
        <div class="Ordenado" style="display: flex; justify-content:center; gap: 10px; ">
        <div class="añadirr" style="border: 1px solid black; padding: 0px; border-radius: 60px; display: flex; justify-content: space-between; align-items: center;">
    <a href="../Views/Admin/RegistroVentasAñadir.php" style="font-size: 20px; color: black; text-decoration: none; padding: 15px; ">
     Añadir <i class="fa-solid fa-plus"></i>
  </a>
  </div>
  </div>

        <!-- Cards de Ventas -->
        <div class="row">
          <?php
// Mostrar los productos
if (count($ventas) > 0) {
    foreach ($ventas as $row) {
        $productos = explode(', ', $row['productos']);
        ?>
        <div class="col-lg-4 col-md-6">
            <div class="card ticket-card" data-bs-toggle="modal" data-bs-target="#modal6<?= number_format($row['idFactura']) ?>">
                <div class="ticket-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="ticket-number">N° <?= number_format($row['idFactura']) ?></span>
                        <span class="status-badge status-completed"><?= $row['estadi'] ?></span>
                    </div>
                </div>
                <div class="ticket-body">
                    <h3 class="ticket-amount">$<?= number_format($row['total']) ?></h3>
                    <div class="ticket-info">
                        <span class="ticket-label">Cliente:</span>
                        <span class="ticket-value"><?= $row['cliente'] ?></span>
                    </div>
                    <div class="ticket-info">
                        <span class="ticket-label">Fecha:</span>
                        <span class="ticket-value"><?= $row['fechaventa'] ?></span>
                    </div>
                    <div class="ticket-info">
                        <span class="ticket-label">Producto:</span>
                        <span class="ticket-value">
                            <?php
                            foreach ($productos as $producto) {
                                list($idProducto, $nombreProducto) = explode(': ', $producto, 3);
                                echo htmlspecialchars($nombreProducto) . '<br>';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal6<?= number_format($row['idFactura']) ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-receipt me-2"></i>Detalle de Venta N° <?= number_format($row['idFactura']) ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="detail-card">
                            <h6 class="text-muted mb-3">INFORMACIÓN GENERAL</h6>
                            <div class="detail-row"><span class="detail-label">Cliente:</span><span class="detail-value"><?= htmlspecialchars($row['cliente']) ?></span></div>
                            <div class="detail-row"><span class="detail-label">Fecha:</span><span class="detail-value"><?= $row['fechaventa'] ?></span></div>
                            <div class="detail-row"><span class="detail-label">Estado:</span><span class="detail-value"><?= $row['estadi'] ?></span></div>
                            <div class="detail-row"><span class="detail-label">Vendedor:</span><span class="detail-value"><?= $row['usuario'] . ' - ' . $row['nombre'] . ' ' . $row['apellido'] ?></span></div>
                            <div class="detail-row"><span class="detail-label">Unidades en total:</span><span class="detail-value"><?= $row['total_cantidad'] ?></span></div>
                        </div>

                        <div class="detail-card">
                            <h6 class="text-muted mb-3">PRODUCTOS (IVA 19%)</h6>
                            <?php
                            foreach ($productos as $producto) {
                                list($idProducto, $nombreProducto, $cantidad, $precio, $iva, $cliente) = explode(': ', $producto);
                                $precio = str_replace('$', '', trim($precio));
                                ?>
                                <div class="detail-row">
                                    <span class="detail-label">Producto:</span>
                                    <span class="detail-value"><?= htmlspecialchars("$idProducto - $nombreProducto") ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Cantidad:</span>
                                    <span class="detail-value"><?= htmlspecialchars($cantidad) ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Precio Unitario:</span>
                                    <span class="detail-value">$<?= number_format($precio) ?></span>
                                </div>
                            <?php } ?>
                             <div class="detail-row">
                                    <span class="detail-label">Subtotal:</span>
                                    <span class="detail-value">$<?= number_format($row['subtotal']) ?></span>
                                </div>
                        </div>

                        <div class="total-row">
                            <div class="detail-row">
                                <span class="detail-label">TOTAL:</span>
                                <span class="detail-value">$<?= number_format($row['total']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo '<p class="text-center">No se han registrado ventas.</p>';
}
?>

      </div>
    </div>
  </div>

  
  <script>
    // Obtener elementos del DOM
    const selectFiltro = document.getElementById('filtrar');
    const cajonProductos = document.getElementById('cajonProductos');
    const tablaProductos = document.querySelector('table.edit');

    tablaProductos.style.display = 'table';
    cajonProductos.style.display = 'none';

    // Evento cuando el usuario selecciona una opción del select
    selectFiltro.addEventListener('change', function() {
      if (selectFiltro.value === 'opcion2') {
        // Mostrar el cajón y ocultar la tabla
        cajonProductos.style.display = 'block';
        tablaProductos.style.display = 'none';
      } else {
        // Mostrar la tabla y ocultar el cajón
        cajonProductos.style.display = 'none';
        tablaProductos.style.display = 'table';
      }
    });
  </script>




  

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

      <script>
        // Solo animación de entrada para las cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.ticket-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
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