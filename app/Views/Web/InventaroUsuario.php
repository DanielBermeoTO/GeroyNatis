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
    
   .buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .text-success-custom {
    color: green !important;
}

.text-danger-custom {
    color: red !important;
}
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            height: 100%;
            position: relative;
            padding: 0px 0px 15px 0px;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .product-card .btn {
            transition: all 0.3s;
            background-color: rgb(231, 121, 115);
            border-color: rgb(247, 94, 86);
        }
        
        .product-card:hover .btn {
            background-color: rgb(247, 94, 86);
            border-color: rgb(231, 121, 115);
        }

        .badge-estado-1 {
            background-color: #28a745;
        }

        .badge-estado-2 {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-estado-3 {
            background-color: #dc3545;
        }
        
        /* Estilo para el ID del producto en forma de bolita */
        .product-id-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgb(231, 121, 115);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
            z-index: 10;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        /* Contenedor de imagen con tamaño fijo */
        .product-image-container {
            height: 180px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Mantiene la proporción y se ajusta dentro del contenedor */
            padding: 10px;
        }
        
        /* Estilo para la imagen en el modal */
        .modal-product-image {
            width: 100%;
            height: 300px;
            object-fit: contain;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
  </style>
</head>

<body>
<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está iniciada y si el usuario tiene el rol adecuado (rol 2 para vendedor)
if (!isset($_SESSION['sesion']) || $_SESSION['sesion'] == "" || $_SESSION['rol'] != 2) {
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
  <div class="header-wrapper">
        <div class="header-background vend"></div>
        
        <!-- Puntos decorativos -->
        <div class="decorative-dot dot-1"></div>
        <div class="decorative-dot dot-2"></div>
        <div class="decorative-dot dot-3"></div>
        <div class="decorative-dot dot-4"></div>
        
        <div class="container-fluid">
            <!-- Header Top -->
            <div class="header-top d-flex justify-content-end align-items-center">
                <button onclick="window.location.href='../Views/Auth/Cerrar Sesion.php'" class="btn-icon">
                    <i class="fa-solid fa-door-open"></i>
                </button>
                <div class="ms-2">
                    <img src="../../public/images/Gero_y_Natis Logo.png?height=40&width=40" alt="Avatar" class="avatar">
                </div>
            </div>
            
            <!-- Main Heading -->
            <h1 class="main-heading">Gero y Natis</h1>
            
            <!-- Navigation Pills -->
            <div class="d-flex justify-content-center mb-4" style="font-family: Oswald, sans-serif; font-size: 1.1em;">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="../Controllers/UsuarioInventario.php"><i class="far fa-copy me-2"></i>Inicio</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="../Controllers/VentasControlador.php"><i class="fa-regular fa-credit-card"></i> Ventas</a>
                    </li>
                </ul>
            </div>
            
            <!-- Search Bar -->
            
        </div>
    </div>

  <!--Inicio Inventario-->
  <div class="container">
    <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Inicio <i class="bi bi-postcard-heart-fill"></i></h2>
    <p style="font-family: Oswald, sans-serif; font-size: 22px;">¡Estos son tus productos en pantalla! </p>
    <hr>
    <div style="padding: 30px 0 50px 0;" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
      <?php if (count($product) > 0): ?>
    <?php foreach ($product as $row): ?>
        <div class="col">
                        <div class="card product-card" data-bs-toggle="modal">
                            <div class="product-id-badge"><?php echo $row['idProducto']; ?></div>
                            <div class="product-image-container">
                                <img src="<?php echo $row['imagen']; ?>" class="product-image" alt="Producto">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombreproducto']; ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text fw-bold mb-0">Cantidad vendida:</p>
                                    <small class="text-muted"><?php echo $row['total_producto']; ?></small>
                                </div>
                                <div class="d-flex flex-wrap gap-1 mt-2">
  <?php
    // Divide las tallas en un array (vienen como: "S: 5, M: 2, L: 3")
    $tallas = explode(',', $row['detalle_por_talla']);
    foreach ($tallas as $item):
      list($talla, $cant) = array_map('trim', explode(':', $item));
  ?>
    <div style="min-width: 45px; height: 45px; border-radius: 50%; background-color: rgb(231, 121, 115); text-align: center; line-height: 45px; font-size: 12px;">
      <?php echo "$talla<br><small>$cant</small>"; ?>
    </div>
  <?php endforeach; ?>
</div>
                                <br>
                               
                            </div>
                        </div>
                    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">No se han registrado productos.</p>
<?php endif; ?>

    </div>
  </div>
  <!--Fin Inventario-->

  

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

  <!-- Optional JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
