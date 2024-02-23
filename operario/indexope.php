<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
include ('../sistema/validar_rolop.php');
#FIN VALIDACIÓN DE ROL

# INICIO FECHA
include ('../sistema/fecha.php');
#FIN FECHA
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal operario</title>

    <script src="../sistema/hora.js"></script>

</head>
<body>
    
    <p> <?php echo "Bienvenid@ <br> $nombreUsuario" ?> </p> <!--SALUDO Y NOMBRE -->
    <p> <span id="hora"></span></p> <!-- HORA -->
    <p> <?php echo "$fecha_actual" ?></p><!-- FECHA -->
    
    <!-- Llama a la función actualizarHora al cargar la página -->
    <script>
        window.onload = function() {
            actualizarHora();
        };
    </script>

    <H1>OPERARIO</H1>

     <!--BOTÓN CIERRE DE SESIÓN -->
    <form action="../sistema/cerrarsesion.php" method="post">
    <button type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
     <!--BOTÓN CIERRE DE SESIÓN -->


</body>
</html>