<?php require_once __DIR__ . '/../../Controllers/controladorInventario3.php'; ?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="../../../../public/css/Geroyn.css">
      <link rel="stylesheet" href="../../../../public/css/pie.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Gero y Natis</title>
  <link rel="icon" href="../../../../public/images/Gero_y_Natis Logo.png" type="image/png">

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
 <!-- Header de Navegación Compacto -->
    <div class="header-nav">
        <div class="header-nav-background vent"></div>
        
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Botón atrás, Logo e imagen a la izquierda -->
                <div class="d-flex align-items-center">
                    <!-- Botón para ir atrás -->
                    <button class="btn-back me-3" onclick="window.location.href='../../../../app/Controllers/VentasControlador.php'"  title="Ir atrás">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    
                    <!-- Logo imagen -->
                    <img src="../../../../public/images/Gero_y_Natis Logo.png" alt="Logo Gero y Natis" class="logo-img">
                    
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
                        <a class="nav-link" href="../../../../app/Controllers/UsuarioInventario.php"><i class="far fa-copy me-2"></i>Inicio</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../../../app/Controllers/VentasControlador.php"><i class="bi bi-credit-card"></i> Ventas</a>
                    </li>
                    </ul>
                    
                    <!-- Menú de usuario a la derecha -->
                    <div class="user-menu">
                        <a href="../../../Views/Auth/Cerrar Sesion.php" class="btn-icon-nav" title="Cerrar sesión">
                            <i class="fa-solid fa-door-open"></i>
                        </a>
                        
                    </div>
                </div>
            </div>
        </nav>
    </div>

  <?php
              if (isset($_GET['message'])) {
                // Definir clases y mensajes según el tipo
                $alertClass = 'alert-danger'; // Por defecto, alerta de error
                $icon = '<i class="bi bi-exclamation-triangle-fill"></i>'; // Ícono de error
                $messageText = 'Algo salió mal, intenta de nuevo'; // Mensaje por defecto

                // Evaluar el mensaje recibido
                switch ($_GET['message']) {
                  case 'pocosproductos':
                    $messageText = 'No hay suficientes productos en el inventario para hacer la venta';
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

<div class="container" style="padding: 0 0 50px 0;  font-family: Oswald, sans-serif;">
    <div class="row">
      <div class="col-md-8">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Añadir Venta</h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes añadir una venta.</p>
        <hr>
        <div class="row">
          <div class="col-md-6" style="border: 2px solid black; border-radius: 10px; ">
            <form action="../../../../app/Controllers/VentasControlador.php" class="anadir" method="post" id="product-form">
              <div id="product-list">
                <div class="product-section" style="padding: 20px;">
                  <div class="correo">
                    <input type="date" name="fechaventa" id="fechaventa" required>
                    <label for="fechaventa">Fecha</label>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="producto" class="form-label">Producto</label>
                      <select class="form-select product-select" name="idProducto[]" id="producto" required>
                        <option value="" selected disabled>Seleccionar producto</option>
                        <?php foreach ($produ as $rowe) { ?>
                          <option value="<?php echo $rowe['idProducto']; ?>" data-precio="<?php echo $rowe['precio']; ?>">
                            <?php echo $rowe['idProducto'] . ' ' . $rowe['nombreproducto'] . ' | $' . number_format($rowe['precio']); ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="talla" class="form-label">Talla</label>
                      <select name="talla[]" class="form-select" id="talla" required>
                        <option value="" selected disabled>Seleccionar talla</option>
                        <?php foreach ($tallas as $rowe) { ?>
                          <option value="<?php echo $rowe['idtalla']; ?>">
                            <?php echo $rowe['talla'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="correo" style="flex: 1;">
                    <input type="number" style="width: 100%;" name="cantidad[]" required step="1" title="Solo se permiten números enteros." oninput="validarLongitudt(this)" maxlength="3" inputmode="numeric">
                    <label for="">Cantidad</label>
                  </div>
                  <input type="hidden" name="valorunitario[]" class="valorunitario">
                </div>
              </div>


              <center>
                <div class="jepo">
                  <button id="add-product" type="button" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle me-2"></i>Agregar Otro Producto
                  </button>
                </div>
              </center>
              <div style="padding: 20px;">
                <div class="correo">
                  <input type="number" name="cliente" required step="1" title="Solo se permiten números enteros." oninput="validarLongitud(this)" maxlength="11" inputmode="numeric">
                  <label for="">Documento Cliente</label>
                </div>

                <div class="row mb-4">
                  <div class="col-12">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="id_estadof" id="id_estadof" required>
                      <option selected disabled>Seleccionar estado</option>
                      <?php foreach ($estados as $row) { ?>
                        <option value="<?php echo $row['idestado']; ?>"><?php echo $row['tiposestados']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <input type="hidden" name="documento" value="<?php echo $_SESSION['sesion']; ?>">


                <div class="botones" style="padding: 0 0 30px 0;">
                  <button type="submit" name="Acciones" value="Crear Venta" class="btn btn-success btn-custom">
                    <i class="bi bi-check-circle me-2"></i>Añadir
                  </button>
                  <button type="button" class="btn btn-danger btn-custom" onclick="this.form.reset()">
                    <i class="bi bi-trash me-2"></i>Borrar
                  </button>
                </div>
            </form>
          </div>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Set current date
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      const formattedDate = `${year}-${month}-${day}`;
      const fechaventaInput = document.getElementById('fechaventa');
      if (fechaventaInput) {
        fechaventaInput.value = formattedDate;
      }

      // Function to validate quantity input
      window.validarLongitudt = function(input) { // Make it global if used inline (or remove inline usage)
        input.value = input.value.replace(/\D/g, '');
        if (input.value.length < 1) { // Changed condition for minimum length
          input.setCustomValidity('El número de cantidad debe tener al menos 1 dígito.');
        } else if (input.value.length > 3) {
          input.value = input.value.slice(0, 3);
          input.setCustomValidity('El número de cantidad no debe tener más de 3 dígitos.');
        } else {
          input.setCustomValidity('');
        }
      };

      // Function to validate client document input
      window.validarLongitud = function(input) { // Make it global if used inline
        input.value = input.value.replace(/\D/g, '');
        if (input.value.length > 11) {
          input.value = input.value.slice(0, 11);
        }
      };

      // Event listener for product selection to update valorunitario
      document.addEventListener('change', function(event) {
        if (event.target.classList.contains('product-select')) {
          const selectedOption = event.target.options[event.target.selectedIndex];
          const precio = selectedOption.dataset.precio;
          const productContainer = event.target.closest('.product-section');

          if (productContainer) {
            const valorUnitarioInput = productContainer.querySelector('.valorunitario');
            if (valorUnitarioInput) {
              valorUnitarioInput.value = precio;
            }
          }
        }
      });

      // Add another product button functionality
      document.getElementById('add-product').addEventListener('click', function() {
        const productList = document.getElementById('product-list');
        const productItem = document.createElement('div');
        productItem.classList.add('product-item', 'product-section'); // Add 'product-section' class
        productItem.style.padding = '20px';
        productItem.style.border = '1px solid #ddd';
        productItem.style.borderRadius = '5px';
        productItem.style.marginBottom = '15px';

        // Content of the new product
        productItem.innerHTML = `
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="producto" class="form-label">Producto</label>
              <select class="form-select product-select" name="idProducto[]" required>
                <option value="" selected disabled>Seleccionar producto</option>
                <?php
                // It's important to understand that this PHP section runs ONLY once on the server
                // to generate the JavaScript string. If $produ comes from a database result,
                // and you used data_seek(0) in the original context, ensure $produ is an array
                // that can be iterated over multiple times.
                foreach ($produ as $rowe) { ?>
                  <option value="<?php echo $rowe['idProducto']; ?>" data-precio="<?php echo $rowe['precio']; ?>">
                    <?php echo $rowe['idProducto'] . ' ' . $rowe['nombreproducto'] . ' | $' . number_format($rowe['precio']); ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="talla" class="form-label">Talla</label>
              <select name="talla[]" class="form-select" required>
                <option value="" selected disabled>Seleccionar talla</option>
                <?php
                // Same note as above for $produ.
                foreach ($tallas as $rowe) { ?>
                  <option value="<?php echo $rowe['idtalla']; ?>">
                    <?php echo $rowe['talla'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="correo">
                <input type="number" style="width: 100%;" name="cantidad[]" required step="1"
                  title="Solo se permiten números enteros." oninput="validarLongitudt(this)" maxlength="3"
                  inputmode="numeric">
                <label for="">Cantidad</label>
            </div>
          </div>
          <input type="hidden" name="valorunitario[]" class="valorunitario">
          <button type="button" class="btn btn-danger btn-sm mt-2 remove-product"><i class="bi bi-trash"></i> Eliminar Producto</button>
        `;

        productList.appendChild(productItem);

        // Add event listener for the new remove button
        productItem.querySelector('.remove-product').addEventListener('click', function() {
          productItem.remove();
        });
      });
    });
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>