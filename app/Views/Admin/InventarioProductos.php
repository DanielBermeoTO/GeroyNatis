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
            window.location = "../../public/index.html"; // Redirigir a la página de inicio de sesión
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
                        <a class="nav-link active" href="../../app/Controllers/controladorInventario2.php"><i class="fa-regular fa-clipboard"></i> Inventario</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="../../app/Controllers/controladorProveedores.php"><i class="bi bi-file-person"></i> Proveedores</a>
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

<br>


  <div class="container" style="padding: 0 0 50px 0;  font-family: Oswald, sans-serif;">

  
    <div class="row">
        
   
      <!--Inicio Portafolio-->
      <div class="col-md-8">
        <h2 style="font-family: Bebas Neue, sans-serif; padding: 20px 0 0 0; font-size: 60px;">Tus Productos <i class="bi bi-file-earmark-diff-fill"></i></h2>
        
        <p style="font-family: Oswald, sans-serif; font-size: 22px;">En este apartado puedes visualizar tus productos, actualizarlos, eliminarlos o inhabilitarlos.</p>
        <div class="search-container">
    <form method="GET" class="mb-4">
        <div class="input-group search-input">
            <span class="input-group-text bg-transparent border-0">
                <i class="fas fa-search search-icon"></i>
            </span>
            <input type="text" name="busqueda" placeholder="Buscar producto" class="form-control border-0 shadow-none" aria-label="Buscar producto" value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
            <button type="submit" name="enviar" class="btn btn-primary bg-transparent border-0">
                <i class="fas fa-arrow-right search-icon"></i>
            </button>
        </div>
    </form>
</div>
        <hr>
 <div class="Ordenado" style="display: flex; justify-content:center; gap: 10px; ">
        <div class="añadirr" style="border: 1px solid black; padding: 0px; border-radius: 60px; display: flex; justify-content: space-between; align-items: center;">
    <a href="../Views/Admin/InventarioAnadir.php" style="font-size: 20px; color: black; text-decoration: none; padding: 15px; ">
     Añadir <i class="fa-solid fa-plus"></i>
  </a>
  </div>
  </div>
  <br>
         <div class="row row-cols-1 row-cols-md-3 g-4" id="col">

         <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $row): ?>
                    <div class="col">
                        <div class="card product-card" data-bs-toggle="modal" data-bs-target="#productModal1<?php echo $row['idProducto']; ?>">
                            <div class="product-id-badge"><?php echo $row['idProducto']; ?></div>
                            <div class="product-image-container">
                                <img src="<?php echo $row['imagen']; ?>" class="product-image" alt="Producto">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombreproducto']; ?></h5>
                                <p class="card-text">
                                    <span class="badge <?php 
                                        if ($row['id_estado'] == 3) {
                                            echo 'badge-estado-1'; // Activo
                                        } elseif ($row['id_estado'] == 4) {
                                            echo 'badge-estado-3'; // Inactivo
                                        } else {
                                            echo 'badge-estado-2'; // Other states
                                        }
                                    ?>"><?php echo $row['tiposestados']; ?></span>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text fw-bold mb-0">$<?php echo number_format($row['precio']); ?></p>
                                    <small class="text-muted">IVA <?php echo $row['iva']; ?>%</small>
                                </div>
                                <br>
                                <div class="buttons">
                                    <button class="btn" title="Actualizar Producto" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['idProducto']; ?>" type="button">
                                        <i class="bi bi-pen"></i>
                                    </button>
                                    <form action="../../app/Controllers/controladorInventario3.php" method="post">
                                        <input type="hidden" name="idProducto" value="<?php echo $row['idProducto']; ?>">
                                        <button class="btn" title="Inhabilitar Producto" name="Acciones" value="Borrar Producto" type="submit">
                                            <i class="bi bi-slash-circle"></i>
                                        </button>
                                    </form>
                                    <button type="button" title="Visualizar Producto" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal1<?php echo $row['idProducto']; ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="productModal1<?php echo $row['idProducto']; ?>" tabindex="-1" aria-labelledby="productModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel1">Producto N° <?php echo $row['idProducto']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?php echo $row['imagen']; ?>" class="modal-product-image" alt="Smartphone XYZ">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <h3 class="mb-0"><?php echo $row['nombreproducto']; ?></h3>
                                                <div class="product-id-badge ms-2" style="position: relative; top: 0; right: 0;"><?php echo $row['idProducto']; ?></div>
                                            </div>
                                            <p class="fs-4 fw-bold text-primary">$<?php echo number_format($row['precio']); ?></p>
                                            <p><span class="badge <?php 
                                                if ($row['id_estado'] == 3) {
                                                    echo 'badge-estado-1'; // Activo
                                                } elseif ($row['id_estado'] == 4) {
                                                    echo 'badge-estado-3'; // Inactivo
                                                } else {
                                                    echo 'badge-estado-2'; // Other states
                                                }
                                            ?>"><?php echo $row['tiposestados']; ?></span></p>
                                            <p class="mb-2"><strong>Categoría:</strong> <span class="text-muted"><?php echo $row['categoria']; ?></span></p>
                                            <p class="mb-2"><strong>IVA:</strong> <span class="text-muted"><?php echo $row['iva']; ?>%</span></p>
                                            <p class="mb-2"><strong>Unidades:</strong> <span class="text-muted"><?php echo $row['total_unidades']; ?></span></p>

                                            <hr>
                                            
                                            <div class="row text-center">
                                                <?php
                                                    $detalles = explode(', ', $row['Detalle_Producto']);
                                                    foreach ($detalles as $detalle) {
                                                        $partes = explode(': ', $detalle); 
                                                        if (count($partes) === 3) {
                                                            $talla = htmlspecialchars($partes[0]);
                                                            $cantidad = htmlspecialchars($partes[1]);
                                                            $color = htmlspecialchars($partes[2]);
                                                ?>
                                                    <div class="col-4 col-md-2 mb-3">
                                                        <div class="border rounded p-2 shadow-sm">
                                                            <div class="fw-bold fs-5"><?php echo $talla; ?></div>
                                                            <div class="text-primary fs-6"><?php echo $cantidad; ?></div>
                                                            <div class="text-muted small"><?php echo $color; ?></div>
                                                        </div>
                                                    </div>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            
                                            <div class="d-grid gap-2 mt-4">
                                                <form action="../../app/Controllers/controladorInventario3.php" method="post" style="display:inline;">
                                                    <input type="hidden" name="idProducto" value="<?php echo $row['idProducto']; ?>">
                                                    <button name="Acciones" value="Borrar Producto" style="border: 0.5px solid red; background: white; color: red; padding: 10px; border-radius: 5px" type="submit">
                                                        <i class="bi bi-ban"></i> Inhabilitar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="updateModal<?php echo $row['idProducto']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius: 20px">
                                <div class="modal-custom">
                                    <div class="modal-header-custom">
                                        <h5 class="modal-title-custom">
                                            <div class="modal-title-icon">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            Actualizar Producto
                                            <span class="product-id-badge-uper">ID: <?php echo $row['idProducto']; ?></span>
                                        </h5>
                                        <button type="button" class="close-button-custom" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <form action="../../app/Controllers/controladorInventario3.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="idProducto" value="<?php echo $row['idProducto']; ?>">
                                        <div class="modal-body-custom">
                                            <div class="form-group-custom">
                                                <label for="nombre" class="form-label-custom">
                                                    <i class="fas fa-tag input-icon"></i>
                                                    Nombre del Producto
                                                </label>
                                                <input class="form-control" name="nombreproducto" type="text" value="<?php echo htmlspecialchars($row['nombreproducto']); ?>">
                                            </div>
                                            
                                            <div class="form-group-custom">
                                                <label for="precio" class="form-label-custom">
                                                    <i class="fas fa-dollar-sign input-icon"></i>
                                                    Precio
                                                </label>
                                                <input class="form-control" name="precio" type="number" value="<?php echo htmlspecialchars($row['precio']); ?>">
                                            </div>
                                            
                                            <div class="form-group-custom">
                                                <label for="categoria" class="form-label-custom">
                                                    <i class="fas fa-list input-icon"></i>
                                                    Categoría
                                                </label>
                                                <select class="form-select" name="categoria" required>
                                                    <?php
                                                    // Loop through available categories
                                                    foreach ($categorias as $cat) {
                                                        // Check if the current category matches the product's category
                                                        $selected = ($row['CategoriaidCategoria'] == $cat['idCategoria']) ? 'selected' : '';
                                                        echo "<option value=\"{$cat['idCategoria']}\" $selected>" . htmlspecialchars($cat['categoria']) . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group-custom">
                                                <label for="estado" class="form-label-custom">
                                                    <i class="fas fa-toggle-on input-icon"></i>
                                                    Estado
                                                </label>
                                                <select class="form-select" name="estado" required>
                                                    <option value="3" <?php echo ($row['id_estado'] == '3') ? 'selected' : ''; ?>>ACTIVO</option>
                                                    <option value="4" <?php echo ($row['id_estado'] == '4') ? 'selected' : ''; ?>>INACTIVO</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer-custom">
                                            <a href="../Principal/ProveedoresMAñadir.php" class="btn-secondary-custom">
                                                <i class="fa-solid fa-plus"></i>
                                                Stock
                                            </a>
                                            <button type="button" class="btn-primary-custom cerrar" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Cerrar</button>
                                            <button type="submit" class="btn-primary-custom" name="Acciones" value="Actualizar Producto">
                                                <i class="fas fa-save me-2"></i>
                                                Actualizar Producto
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center w-100">No se han registrado productos.</p>
            <?php endif; ?>
        </div>

        <div class="container" style="font-family: Oswald, sans-serif; display: none;" id="tablaProductos">
            <div style="padding: 0 0 50px 0;" class="row row-cols-1">
                <table class="edit table table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>IVA</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach ($productos as $row): ?>
                                <tr>
                                    <td><?php echo $row['idProducto']; ?></td>
                                    <td><?php echo $row['nombreproducto']; ?></td>
                                    <td><?php echo $row['total_unidades']; ?></td>
                                    <td>$<?php echo number_format($row['precio']); ?></td>
                                    <td><?php echo $row['categoria']; ?></td>
                                    <td>
                                        <span class="badge <?php 
                                            if ($row['id_estado'] == 3) {
                                                echo 'badge-estado-1'; // Activo
                                            } elseif ($row['id_estado'] == 4) {
                                                echo 'badge-estado-3'; // Inactivo
                                            } else {
                                                echo 'badge-estado-2'; // Other states
                                            }
                                        ?>"><?php echo $row['tiposestados']; ?></span>
                                    </td>
                                    <td><?php echo $row['iva']; ?>%</td>
                                    <td><img src="<?php echo $row['imagen']; ?>" alt="Producto" style="max-width: 50px; max-height: 50px;"></td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['idProducto']; ?>" style="border: none; background: white; color: green;" type="button" title="Actualizar">
                                            <i class="bi bi-cloud-upload"></i>
                                        </button>
                                        <form action="../Controlador/controladorInventario3.php" method="post" style="display:inline;">
                                            <input type="hidden" name="idProducto" value="<?php echo $row['idProducto']; ?>">
                                            <button name="Acciones" value="Borrar Producto" style="border: none; background: white; color: red;" type="submit" title="Inhabilitar">
                                                <i class="bi bi-ban"></i>
                                            </button>
                                        </form>
                                        <button type="button" title="Visualizar Producto" style="border: none; background: white; color: blue;" data-bs-toggle="modal" data-bs-target="#productModal1<?php echo $row['idProducto']; ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="9" class="text-center">No se han registrado productos.</td></tr>
                        <?php endif; ?>
            </tbody>
          </table>
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