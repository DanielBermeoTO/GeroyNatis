<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../public/css/Geroyn.css">
      <link rel="stylesheet" href="../../../public/css/pie.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Gero y Natis</title>
  <link rel="icon" href="../../../public/images/gg.png" type="image/png">
  
</head>

<body>
<div class="header-wrapper">
        <div class="header-background triple"></div>
        
        <!-- Puntos decorativos -->
        <div class="decorative-dot dot-1"></div>
        <div class="decorative-dot dot-2"></div>
        <div class="decorative-dot dot-3"></div>
        <div class="decorative-dot dot-4">
          
        </div>
        
        <div class="container-fluid">

        
          <div class="row align-items-center justify-content-between">
    <div class="col-auto">
        <a class="nav-link" style="color: black; font-size: 1.5em" href="../../../public/index.html">
            <i class="bi bi-box-arrow-left"></i>
        </a>
    </div>
    <div class="col-auto mx-auto">
        <img src="../../../public/images/Gero_y_Natis Logo.png" alt="Avatar" class="img-fluid avatar">
    </div>
    <div class="col-auto invisible"></div>
  <div class="col-auto invisible"></div>
<div class="col-auto invisible"></div>
<div class="col-auto invisible"></div> </div>
            <!-- Main Heading -->
            <h1 class="main-heading">Gero y Natis</h1>
            
        </div>
    </div>

  <div class="container" style="padding: 0 0 50px 0;  font-family: Oswald, sans-serif;">
    <div class="row">
      <!--Inicio Portafolio-->
      <div class="col-md-8">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Iniciar Sesión</h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">Inicia sesión con tus datos para disrutar de
          nuestros servicios.</p>
        <hr>

        <div class="row">
          <div class="col-md-6" style="border: 2px solid black; border-radius: 10px; ">
            <form action="./IniciarSsesion.php" class="anadir" method="post" style="padding: 20px;">
              <div class="correo">
                <input type="number" name="documento" id="documento" required step="1"
title="Solo se permiten números enteros entre 8 y 11 dígitos."
oninput="validarLongitud(this)" maxlength="11" inputmode="numeric">

<script>
function validarLongitud(input) {
    input.value = input.value.replace(/\D/g, ''); // Elimina caracteres no numéricos
    if (input.value.length < 8) {
        input.setCustomValidity('El número de documento debe tener al menos 8 dígitos.');
    } else if (input.value.length > 11) {
        input.value = input.value.slice(0, 11); // Limita a 11 dígitos
        input.setCustomValidity('El número de documento no debe tener más de 11 dígitos.');
    } else {
        input.setCustomValidity(''); // La validación es exitosa
    }
}
</script>


                <label for="">Documento</label>
              </div>
              <div class="correo">
                <input type="password" name="contrasena" id="contrasena" minlength="8" maxlength="20"
                  required tittle="La contraseña debe tener al menos 8 caracteres"><label>Contraseña</label></div>
              <center>
                <button name="Acciones" value="Iniciar Sesión"
                  style="background: linear-gradient(70deg, #c24a46, #c2a8a1); padding: 10px; border-radius: 20px;"
                  type="submit" class="anadirr"><i class="bi bi-file-earmark-plus"></i> Iniciar</button>
              </center>
              <br>

              <p>¿Olvido su contraseña? <a style="color: #c24a46; text-decoration: none;"
                  href="./Recuperar contraseña.php">Recuperar
                  Contraseña</a></p>

              <?php
              if (isset($_GET['message'])) {
                // Definir clases y mensajes según el tipo
                $alertClass = 'alert-danger'; // Por defecto, alerta de error
                $icon = '<i class="bi bi-exclamation-triangle-fill"></i>'; // Ícono de error
                $messageText = 'Algo salió mal, intenta de nuevo'; // Mensaje por defecto

                // Evaluar el mensaje recibido
                switch ($_GET['message']) {
                  case 'ok':
                    $alertClass = 'alert-success'; // Cambiar a éxito
                    $icon = '<i class="bi bi-check-circle-fill"></i>'; // Ícono de éxito
                    $messageText = 'Su correo fue enviado satisfactoriamente, revise su correo';
                    break;

                  case 'Usuario no encontrado':
                    $messageText = 'Usuario no encontrado, Usuario inexistente o correo mal proporcionado.';
                    break;

                  case 'okay':
                    $alertClass = 'alert-success'; // Cambiar a éxito
                    $icon = '<i class="bi bi-check-circle-fill"></i>'; // Ícono de éxito
                    $messageText = 'Contraseña actualizada con exito.';
                    break;

                  default:
                    // Mantener valores por defecto
                    break;
                }
              ?>

                <!-- Mostrar la alerta -->
                <div class="alert <?= $alertClass ?> d-flex align-items-center" role="alert">
                  <?= $icon ?>
                  <div style="margin-left: 10px;">
                    <?= $messageText ?>
                  </div>
                </div>

              <?php
              }
              ?>


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


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>