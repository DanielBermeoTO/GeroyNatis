
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

   <style>
        .image-preview {
            width: 100%;
            height: 150px;
            border: 2px dashed #ddd;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            overflow: hidden;
            position: relative;
            Cursor: pointer;
        }
        
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .image-preview-text {
            position: absolute;
            z-index: 1;
        }
        
        .image-preview.has-image .image-preview-text {
            display: none;
        }
        
        .form-label.required:after {
            content: " *";
            color: red;
        }
        
        #imageInput {
            display: none;
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
            window.location = "../../../public/index.html"; // Redirigir a la página de inicio de sesión
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
                    <button class="btn-back me-3" onclick="window.location.href='../../../app/Controllers/controladorInventario2.php'"  title="Ir atrás">
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
                        <a class="nav-link active" href="../../../app/Controllers/controladorInventario2.php"><i class="fa-regular fa-clipboard"></i> Inventario</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../../app/Controllers/controladorProveedores.php"><i class="bi bi-file-person"></i> Proveedores</a>
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
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Añadir Producto</h2>
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes añadir tu producto para que quede en tu inventario de productos.</p>
        <hr>

        <div class="row">
          <div class="col-md-12" style="border: 2px solid black; border-radius: 10px; ">
<form action="../../../app/Controllers/controladorInventario3.php" method="post" enctype="multipart/form-data" style="padding: 20px;" id="productForm" class="needs-validation" novalidate>
            <!-- Imagen del producto -->
            <div class="mb-3">
                <label for="imageInput" class="form-label required">Imagen del Producto</label>
                <div class="image-preview" id="imagePreview">
                    <span class="image-preview-text">Haga clic para seleccionar una imagen</span>
                    <img src="/placeholder.svg" alt="Vista previa de imagen" id="previewImg" style="display: none;">
                </div>
                <input type="file" class="form-control" name="foto" id="imageInput" accept="image/*" required>
                <div class="invalid-feedback">
                    Por favor seleccione una imagen para el producto.
                </div>
            </div>
            
            <div class="row">
                <!-- Nombre del producto -->
                <div class="col-md-6 mb-2">
                  <div class="correo">
                <input type="text" name="nombreproducto" id="nombreproducto" required>
                <label for="nombreproducto">Nombre Producto</label>
              
                    <div class="invalid-feedback">
                        Por favor ingrese el nombre del producto.
                    </div>
                </div>
                </div>
                
                <!-- Precio unitario -->
                <div class="col-md-3 mb-2">
                  <div class="correo">
                <input type="number" name="precio" id="precio" required step="1"
                  title="Solo se permiten números enteros." oninput="validarLongitud(this)" maxlength="7"
                  inputmode="numeric">
                <script>
                  function validarLongitud(input) {
                    input.value = input.value.replace(/\D/g, '');
                    // Limitar a 11 dígitos
                    if (input.value.length > 11) {
                      input.value = input.value.slice(0, 11);
                    }
                  }
                </script> <label for="precio">Precio Unitario</label>
                <div class="invalid-feedback">
                            Ingrese el precio unitario.
                        </div>
              </div>
                </div>
                
                <!-- Precio proveedor -->
                <div class="col-md-3 mb-2">
                     <div class="correo">
              <input type="number" name="precioproveedor" id="precioproveedor" required step="1"
                  title="Solo se permiten números enteros." oninput="validarLongitud(this)" maxlength="11"
                  inputmode="numeric">
                  <label for="nombreproducto">Precio Proveedor</label>
              
                        <div class="invalid-feedback">
                            Ingrese el precio del proveedor.
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Categoría -->
                <div class="col-md-4 mb-2">
                    <label for="category" class="form-label required">Categoría</label>
                    <select class="form-select" name="categoria" id="category" required>
                        <option value="" selected disabled>Seleccione una categoría</option>
                         <?php foreach ($categorias as $row) { ?>
                    <option value="<?php echo $row['idCategoria']; ?>"><?php echo $row['categoria']; ?></option><?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione una categoría.
                    </div>
                </div>
                
                <!-- Estado -->
                <div class="col-md-4 mb-2">
                    <label for="status" class="form-label required">Estado</label>
                    <select class="form-select" name="estado" id="estado" required>
                        <option value="" selected disabled>Seleccione un estado</option>
                        <?php foreach ($estado as $row) { ?>
                    <option value="<?php echo $row['idestado']; ?>"><?php echo $row['tiposestados']; ?></option><?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione un estado.
                    </div>
                </div>
                
                <!-- Proveedor -->
                <div class="col-md-4 mb-2">
                    <label for="supplier" class="form-label required">Proveedor</label>
                    <select class="form-select" name="ProveedoridProveedor" id="ProveedoridProveedor" required>
                        <option value="" selected disabled>Seleccione un proveedor</option>
                        <?php foreach ($proveedor as $row) { ?>
                    <option value="<?php echo $row['idProveedor']; ?>"><?php echo $row['nombreproveedor']; ?></option>
                  <?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor seleccione un proveedor.
                    </div>
                </div>
            </div>
            
            <!-- Fecha -->
            <div class="mb-3">
              <div class="correo">
                <input type="date" name="fecha_entrada" id="fecha_entrada" required>
                <label for="fecha_entrada">Fecha</label>
                <div class="invalid-feedback">
                    Por favor seleccione una fecha.
                </div>
                              </div>
            </div>
            
            <!-- Sección de tallas -->
            <h5 class="mt-3 mb-2">Inventario por Tallas</h5>

            <div class="row row-cols-2 row-cols-md-3 g-2 mb-3">
                <!-- XS -->
                <div class="col">
                    <div class="card h-100" style="border: 2px solid black; border-radius: 5px;">
                        <div class="card-header py-1" style="background: rgb(231, 121, 115) ">
                            <h6 class="card-title mb-0">Talla XS</h6>
                        </div>
                        <div class="card-body p-2">
                            <input type="hidden" name="talla[]" value="1">
                            <div class="correo">
                                
                                <input placeholder="Cantidad" type="number" class="form-control" id="quantityXS" name="cantidad[]" min="0" required>                                
                                <div class="invalid-feedback">
                                    Por favor ingrese la cantidad.
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="correo">
                                  <input placeholder="Color" type="text" class="form-control" id="colorXS" name="color[]" required>  
                                <div class="invalid-feedback">
                                    Por favor ingrese el color.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- S -->
                <div class="col">
                    <div class="card h-100" style="border: 2px solid black; border-radius: 5px;">
                        <div class="card-header py-1" style="background: rgb(231, 121, 115) ">
                            <h6 class="card-title mb-0">Talla S</h6>
                        </div>
                        <div class="card-body p-2">
                            <input type="hidden" name="talla[]" value="2">
                            <div class="mb-2">
                                <div class="correo">
                                <input placeholder="Cantidad" type="number" class="form-control" id="quantityS" name="cantidad[]" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese la cantidad.
                                </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="correo">
                                  <input placeholder="Color" type="text" class="form-control" id="colorS" name="color[]" required>  
                                <div class="invalid-feedback">
                                    Por favor ingrese el color.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- M -->
                <div class="col">
                    <div class="card h-100" style="border: 2px solid black; border-radius: 5px;">
                        <div class="card-header py-1" style="background: rgb(231, 121, 115) ">
                            <h6 class="card-title mb-0">Talla M</h6>
                        </div>
                        <div class="card-body p-2">
                       <input type="hidden" name="talla[]" value="3">
                            <div class="mb-2">
                                <div class="correo">
                                <input placeholder="Cantidad" type="number" class="form-control" id="quantityM" name="cantidad[]" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese la cantidad.
                                </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="correo">
                                  <input placeholder="Color" type="text" class="form-control" id="colorM" name="color[]" required>  
                                <div class="invalid-feedback">
                                    Por favor ingrese el color.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- L -->
                <div class="col">
                    <div class="card h-100" style="border: 2px solid black; border-radius: 5px;">
                        <div class="card-header py-1" style="background: rgb(231, 121, 115) ">
                            <h6 class="card-title mb-0">Talla L</h6>
                        </div>
                        <div class="card-body p-2">
                            <input type="hidden" name="talla[]" value="4">
                            <div class="mb-2">
                                <div class="correo">
                                <input placeholder="Cantidad" type="number" class="form-control" id="quantityL" name="cantidad[]" min="0" required> 
                                <div class="invalid-feedback">
                                    Por favor ingrese la cantidad.
                                </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="correo">
                                  <input placeholder="Color" type="text" class="form-control" id="colorL" name="color[]" required>  
                                <div class="invalid-feedback">
                                    Por favor ingrese el color.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- XL -->
                <div class="col">
                    <div class="card h-100" style="border: 2px solid black; border-radius: 5px;">
                        <div class="card-header py-1" style="background: rgb(231, 121, 115) " >
                            <h6 class="card-title mb-0">Talla XL</h6>
                        </div>
                        <div class="card-body p-2">
                            <input type="hidden" name="talla[]" value="5">

                            <div class="mb-2">
                                <div class="correo">
                                <input placeholder="Cantidad" type="number" class="form-control" id="quantityXL" name="cantidad[]" min="0" required>                                
                                <div class="invalid-feedback">
                                    Por favor ingrese la cantidad.
                                </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="correo">
                                  <input placeholder="Color" type="text" class="form-control" id="colorXL" name="color[]" required>  
                                <div class="invalid-feedback">
                                    Por favor ingrese el color.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-3">
<button style="background: linear-gradient(70deg, #c24a46, #c2a8a1); padding: 10px; border-radius: 20px;" name="Acciones" value="Crear Producto" type="submit" class="anadirr">
                <i class="bi bi-file-earmark-plus"></i> Añadir
              </button>            </div>
        </form>
          </div>

          
        </div>

      </div>
    </div>
  </div>

  <script>
    // Obtener la fecha actual
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes entre 01 y 12
    const day = String(today.getDate()).padStart(2, '0'); // Día entre 01 y 31

    // Formatear la fecha en el formato YYYY-MM-DD
    const formattedDate = `${year}-${month}-${day}`;

    // Asignar la fecha al input
    document.getElementById('fecha_entrada').value = formattedDate;
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
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('image-preview-display');
        output.src = reader.result;
        output.style.display = 'block'; // Muestra la imagen previa
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

   <script>
        // Manejar la vista previa de la imagen
        const imagePreview = document.getElementById('imagePreview');
        const imageInput = document.getElementById('imageInput');
        const previewImg = document.getElementById('previewImg');
        
        // Cuando se hace clic en el área de vista previa, activar el input de archivo
        imagePreview.addEventListener('click', function() {
            imageInput.click();
        });
        
        // Cuando se selecciona un archivo, mostrar la vista previa
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.addEventListener('load', function() {
                    previewImg.src = reader.result;
                    previewImg.style.display = 'block';
                    imagePreview.classList.add('has-image');
                });
                
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
                imagePreview.classList.remove('has-image');
            }
        });

        // Validación del formulario
        (function () {
            'use strict'
            
            // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
            const forms = document.querySelectorAll('.needs-validation');
            
            // Bucle sobre ellos y evitar el envío
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } 
                    
                    form.classList.add('was-validated');
                }, false);
            });
        })();
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