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
  <style>
    .hover-card {
      transition: all 0.3s ease;
    }
   
    .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
   
    .avatar-container {
      position: relative;
      display: inline-block;
    }
   
    .avatar-circle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: 1px solid black;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }
   
    .avatar-initials {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 14px;
      backdrop-filter: blur(10px);
    }
   
    .card-header {
      border-bottom: 0;
      border-top-left-radius: 0.5rem !important;
      border-top-right-radius: 0.5rem !important;
    }
        .gradient-2 { background: linear-gradient(135deg,rgb(186, 158, 189) 0%, rgba(231, 121, 115, 0.9) 100%); }
.btn-primary {
      background-color: white;
      border: 2px solid black;
      color: green;
    }
   
    .btn-primary:hover {
      background-color: green ;
      border-color: green;
      color: white
    }
   
    .btn-outline-primary {
      color: var(--bs-primary);
      border-color: var(--bs-primary);
    }
   
    .btn-outline-primary:hover {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
    }
  </style>

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
                        <a class="nav-link active" href="../../app/Controllers/controladorProveedores.php"><i class="bi bi-file-person"></i> Proveedores</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorMovimiento.php"> <i class="bi bi-book-half"></i> Movimientos</a>
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
      <div class="col-md-8">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Tus Proveedores <i class="bi bi-file-person"></i></h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes visualizar tus proveedores, actualizarlos, eliminarlos</p>
        <div class="search-container">
    <form method="GET" class="mb-4">
        <div class="input-group search-input">
            <span class="input-group-text bg-transparent border-0">
                <i class="fas fa-search search-icon"></i>
            </span>
            <input type="text" name="busqueda" placeholder="Buscar Proveedor" class="form-control border-0 shadow-none" aria-label="Buscar producto" value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
            <button type="submit" name="enviar" class="btn btn-primary bg-transparent border-0">
                <i class="fas fa-arrow-right search-icon"></i>
            </button>
        </div>
    </form>
</div>
        <hr>
        <div class="Ordenado" style="display: flex; justify-content:center; gap: 10px; ">
        <div class="añadirr" style="border: 1px solid black; padding: 0px; border-radius: 60px; display: flex; justify-content: space-between; align-items: center;">
    <a href="../Views/Admin/ProveedoresAñadir.php" style="font-size: 20px; color: black; text-decoration: none; padding: 15px; ">
     Añadir <i class="fa-solid fa-plus"></i>
  </a>
  </div>
  </div>
 <!-- Grid de proveedores -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
     <?php if (count($proveedores) > 0): ?>
    <?php foreach ($proveedores as $row): ?>
      <!-- Proveedor 1 -->
      <div class="col">
        <div class="card h-100 shadow-sm border-0 hover-card">
          <div class="card-header text-white d-flex justify-content-between align-items-center gradient-2">
            <span class="badge bg-light text-dark">ID: <?php echo $row['idProveedor']; ?></span>
            <div class="avatar-initials">PV</div>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="avatar-container me-3">
                <div class="avatar-circle gradient-2">
                  <i class="bi bi-person-fill"></i>
                </div>
              </div>
              <h5 class="card-title mb-0"><?php echo $row['nombreproveedor']; ?></h5>
            </div>
           
            <div class="info-list">
              <div class="d-flex align-items-start mb-3">
                <i class="bi bi-box-seam text-secondary me-2 mt-1"></i>
                <div>
                  <small class="text-muted d-block">Producto/Servicio:</small>
                  <span class="fw-medium"><?php echo $row['producto']; ?></span>
                </div>
              </div>
             
              <div class="d-flex align-items-center mb-2">
                <i class="bi bi-telephone text-secondary me-2"></i>
                <div>
                  <small class="text-muted d-block">Teléfono:</small>
                  <a href="tel:+34912345678" class="text-decoration-none"><?php echo $row['Telefono']; ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer bg-white border-0 pt-0">
            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
              <button class="btn btn-sm btn-primary flex-grow-1" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['idProveedor']; ?>">
                <i class="bi bi-cloud-upload"></i> Actualizar
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="updateModal<?php echo $row['idProveedor']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius: 20px">
                                <div class="modal-custom">
                                    <div class="modal-header-custom">
                                        <h5 class="modal-title-custom">
                                            <div class="modal-title-icon">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            Actualizar Proveedor
                                            <span class="product-id-badge-uper">ID: <?php echo $row['idProveedor']; ?></span>
                                        </h5>
                                    </div>
                                    
                                    <form action="../Controllers/controladorProveedores.php" method="POST" enctype="multipart/form-data">
                                                                            <input type="hidden" name="idProveedor" value="<?php echo $row['idProveedor']; ?>">
    
                                    <div class="modal-body-custom">
                                            <div class="form-group-custom">
                                                <label for="nombre" class="form-label-custom">
                                                    <i class="fas fa-tag input-icon"></i>
                                                    Nombre del Proveedor
                                                </label>
                            <input class="form-control" name="nombreproveedor" type="text" value="<?php echo $row['nombreproveedor']; ?>">
                                            </div>
                                            
                                            <div class="form-group-custom">
                                                <label for="precio" class="form-label-custom">
                                                    <i class="fas fa-dollar-sign input-icon"></i>
                                                    Teléfono
                                                </label>
                            <input class="form-control" name="Telefono" type="text" value="<?php echo $row['Telefono']; ?>">
                                            </div>
                                            
                                            <div class="form-group-custom">
                                                <label for="categoria" class="form-label-custom">
                                                    <i class="fas fa-list input-icon"></i>
                                                    Producto
                                                </label>
                                                <select class="form-select" name="productos" required>
                              <?php foreach ($tallas as $jeje): ?>
  <?php
    $selected = ($row['producto'] == $jeje['nombreproducto']) ? 'selected' : '';
    echo "<option value=\"{$jeje['idProducto']}\" $selected>{$jeje['nombreproducto']}</option>";
  ?>
<?php endforeach; ?>

                            </select>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="modal-footer-custom">
                                            <button type="button" class="btn-primary-custom cerrar" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Cerrar</button>
                                            <button type="submit" class="btn-primary-custom" name="Acciones" value="Actualizar Proveedor">
                                                <i class="fas fa-save me-2"></i>
                                                Actualizar Proveedor
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">No se han registrado productos.</p>
<?php endif; ?>
        </div>
      </div>
    </div>
  </div>



  

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