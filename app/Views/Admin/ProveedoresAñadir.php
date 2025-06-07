
<?php require_once __DIR__ . '/../../Controllers/controladorInventario3.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../public/css/Geroyn.css">
      <link rel="stylesheet" href="../../../public/css/pie.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Gero y Natis</title>
  <link rel="icon" href="../../../public/images/Gero_y_Natis Logo.png" type="image/png">

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
                    <button class="btn-back me-3" onclick="window.location.href='../../../app/Controllers/controladorInventario.php'"  title="Ir atrás">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    
                    <!-- Logo imagen -->
                    <img src="../../../public/images/Gero_y_Natis Logo.png" alt="Logo Gero y Natis" class="logo-img">
                    
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
                        <a class="nav-link" href="../../../app/Controllers/controladorInventario.php"><i class="far fa-copy me-2"></i>Inicio</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../../app/Controllers/controladorInventario2.php"><i class="fa-regular fa-clipboard"></i> Inventario</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="../../../app/Controllers/controladorProveedores.php"><i class="bi bi-file-person"></i> Proveedores</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../../app/Controllers/controladorMovimiento.php"> <i class="bi bi-book-half"></i> Movimientos</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../../app/Controllers/controladorVentas.php"><i class="fa-regular fa-credit-card"></i> Ventas</a>
                    </li>
                    </ul>
                    
                    <!-- Menú de usuario a la derecha -->
                    <div class="user-menu">
                        <a href="../../../app/Controllers/controladorUsuario.php" class="btn-icon-nav" title="Usuarios">
                             <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="../../../app/Views/Auth/Cerrar Sesion.php" class="btn-icon-nav" title="Cerrar sesión">
                            <i class="fa-solid fa-door-open"></i>
                        </a>
                        
                    </div>
                </div>
            </div>
        </nav>
    </div>


  <div class="container" style="padding: 0 0 50px 0;  font-family: Oswald, sans-serif;">
    <div class="row">
      <!--Inicio Portafolio-->
      <div class="col-md-8">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Añadir Proveedor</h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes añadir tu proveedor de confianza.</p>
        <hr>

        <div class="row">
          <div class="col-md-6" style="border: 2px solid black; border-radius: 10px; ">
            <form action="../../../app/Controllers/controladorProveedores.php" class="anadir" method="post" style="padding: 20px;">
              <div class="correo"><input type="text" name="nombreproveedor" required><label for="">Nombre Proveedor</label></div>
              <div class="correo"><input type="text" name="Telefono" required><label>Teléfono</label></div>
              
              <div class="col-md-12 mb-4">
                    <label for="status" class="form-label required">Producto</label>
                    <select class="form-select" name="productos"  id="productos">
                        <option value="" selected disabled>Seleccione un Producto</option>
                       <?php foreach($produ as $row) { ?>
                    <option value="<?php echo $row['idProducto']; ?>"><?php echo $row['idProducto'];
                                                                      echo '-';
                                                                      echo $row['nombreproducto']; ?></option><?php } ?>
                    </select>
                </div>

              
              <button name="Acciones" value="Crear Proveedor" style="background: linear-gradient(70deg, #c24a46, #c2a8a1); padding: 10px; border-radius: 20px;" type="submit" class="anadirr"><i class="bi bi-file-earmark-plus"></i> Añadir</button>
            </form>
          </div>
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


  <script>
    function previewImage(event) {
      /*Esta es una función que se ejecuta cuando se selecciona un archivo en el <input type="file">. El event es el objeto del evento que contiene información sobre el evento, incluyendo el archivo seleccionado.*/
      var reader = new FileReader(); /*Se crea una instancia del objeto FileReader. Este objeto se usa para leer archivos de manera asíncrona. En este caso, lo utilizaremos para leer la imagen seleccionada.*/
      reader.onload = function() {
        /*Aquí se define una función que se ejecutará cuando el FileReader haya terminado de leer el archivo. Esta función es un "event handler" que se activa cuando la lectura del archivo se completa con éxito.*/
        var output = document.getElementById('image-preview'); /*Obtiene una referencia al elemento con el id image-preview. Este es el <img> en el que se mostrará la imagen seleccionada.*/
        output.src = reader.result; /*Establece la propiedad src del elemento <img> con el resultado de la lectura del archivo. reader.result contiene la imagen en formato base64, que puede ser usado directamente como fuente para el <img>.*/
        output.style.display = 'block'; /*Cambia el estilo del elemento <img> a block para hacerlo visible. Este estilo se establece solo después de que la imagen ha sido cargada. Antes de la carga, el <img> tiene display: none;, por lo que no es visible.*/
      };
      reader.readAsDataURL(event.target.files[0]); /*nicia la lectura del archivo seleccionado. event.target.files[0] accede al primer archivo seleccionado por el usuario (en caso de que se permita seleccionar más de un archivo, files sería una lista de archivos). readAsDataURL lee el archivo como una URL de datos base64, que es adecuada para mostrar imágenes en la web.*/
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