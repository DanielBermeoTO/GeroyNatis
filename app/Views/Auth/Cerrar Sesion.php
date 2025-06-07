<?php
    session_start();// verificar sesion
    session_unset();// inhabilitar
    session_destroy();// cerrar sesion
?>
<html>
    <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>
    <script>
            swal.fire({
                icon: "success",
                tittle: "Bien",
                text: "Has cerrado sesión correctamente",
                showconfirmbutton: true,
                confirmButtonText: "Cerrar"
            }).then(function() {
                window.location= "../../../public/index.html"
            });
    </script>
</body>
</html>