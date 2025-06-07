<?php
if (isset($_GET['error']) && $_GET['error'] === 'usuario_existente') {
  echo "<script>alert('Error: El usuario ya existe.');</script>";
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../public/css/Geroyn.css">
      <link rel="stylesheet" href="../../../public/css/pie.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Gero y Natis</title>
  <link rel="icon" href="../Imagenes/Gero_y_Natis Logo.png" type="image/png">

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
        <a class="nav-link" style="color: black; font-size: 1.5em" href="../../../app/Controllers/controladorUsuario.php">
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
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Crear Usuario</h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">Crea usuarios a tus empleados con roles diferentes.</p>
        <hr>

        <div class="row">
          <div class="col-md-6" style="border: 2px solid black; border-radius: 10px; ">
            <form action="../../../app/Controllers/controladorUsuario.php" class="anadir" method="post" style="padding: 20px;">
              <label for="tipoDocumento">Tipo de Documento</label>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipoDocumento" id="tipoDocumentoCC" value="CC" required>
                <label class="form-check-label" for="tipoDocumentoCC">CC</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipoDocumento" id="tipoDocumentoTI" value="TI">
                <label class="form-check-label" for="tipoDocumentoTI">TI</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipoDocumento" id="tipoDocumentoCE" value="CE">
                <label class="form-check-label" for="tipoDocumentoCE">CE</label>
              </div>

              <div class="correo">
                <input type="number" name="documento" id="documento" required step="1" title="Solo se permiten números enteros." oninput="validarLongitud(this)" maxlength="11" inputmode="numeric">
                <script>
                  function validarLongitud(input) {
                    input.value = input.value.replace(/\D/g, '');
                    // Limitar a 11 dígitos
                    if (input.value.length > 11) {
                      input.value = input.value.slice(0, 11);
                    }
                  }
                </script>
                <label for="documento"><i class="bi bi-person"></i> Documento:</label>
              </div>

              <div class="correo">
                <input type="text" name="nombre" id="nombre" required oninput="validartext(this)" maxlength="15">
                <label for="nombre"><i class="bi bi-person-fill"></i> Nombres:</label>
              </div>
              <div class="correo">
                <input type="text" name="apellido" id="apellido" required oninput="validartext(this)" maxlength="15">
                <label for="apellido"><i class="bi bi-person-lines-fill"></i> Apellidos:</label>
              </div>

              <script>
                function validartext(input) {
                  // Eliminar caracteres que no sean letras o espacios
                  input.value = input.value.replace(/[^A-Za-z\s]/g, "");

                  // Limitar a 15 caracteres
                  if (input.value.length > 15) {
                    input.value = input.value.slice(0, 15);
                  }
                }
              </script>

              <div class="correo">
                <input type="text" name="direccion" id="direccion" required>
                <label for="direccion"><i class="bi bi-geo-alt"></i> Dirección:</label>
              </div>

              <div class="correo">
                <select name="localidad" id="localidad" required>
                  <option value="">Seleccione una localidad</option>
                  <option value="Usaquen">Usaquén</option>
                  <option value="Chapinero">Chapinero</option>
                  <option value="SantaFe">Santa Fe</option>
                  <option value="SanCristobal">San Cristóbal</option>
                  <option value="Usme">Usme</option>
                  <option value="Tunjuelito">Tunjuelito</option>
                  <option value="Bosa">Bosa</option>
                  <option value="Kennedy">Kennedy</option>
                  <option value="Fontibon">Fontibón</option>
                  <option value="Engativa">Engativá</option>
                  <option value="Suba">Suba</option>
                  <option value="BarriosUnidos">Barrios Unidos</option>
                  <option value="Teusaquillo">Teusaquillo</option>
                  <option value="LosMartires">Los Mártires</option>
                  <option value="AntonioNariño">Antonio Nariño</option>
                  <option value="PuenteAranda">Puente Aranda</option>
                  <option value="LaCandelaria">La Candelaria</option>
                  <option value="RafaelUribeUribe">Rafael Uribe Uribe</option>
                  <option value="CiudadBolivar">Ciudad Bolívar</option>
                  <option value="Sumapaz">Sumapaz</option>
                </select>
              </div>

              <div class="correo">
                <input type="number" name="telefono" id="telefono" step="1" title="Solo se permiten números enteros." oninput="validarLongitud(this)" maxlength="11" inputmode="numeric">
                <label for="telefono"><i class="bi bi-telephone"></i> Telefono:</label>
              </div>

              <div class="correo">
                <input type="email" name="correo" id="correo" required>
                <label for="correo"> <i class="bi bi-envelope"></i> Correo Electronico</label>
              </div>

              <div class="correo">
                <input type="password" name="contrasena" id="contrasena" required>
                <label for="contrasena"><i class="bi bi-lock"></i> Contraseña</label>
              </div>

              <div class="correo">
                <select name="estado" id="estado" required>
                  <option value="">Estado</option>
                  <option value="3">Activo</option>
                  <option value="4">Inactivo</option>
                </select>
              </div>
              <div class="correo">
                <select name="idrol" id="idrol" required>
                  <option value="">Estado</option>
                  <option value="1">Administrador</option>
                  <option value="2">Vendedor</option>
                </select>
              </div>



              <button style="background: linear-gradient(70deg, #c24a46, #c2a8a1); padding: 10px; border-radius: 20px;" type="submit" name="Acciones" value="Crear Usuario" class="anadirr">
                <i class="bi bi-file-earmark-person-fill"></i> Registrate
              </button>
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