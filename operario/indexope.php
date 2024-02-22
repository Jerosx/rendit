<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA

session_start();
$valsesion= $_SESSION['codigoUser'];

if($valsesion== null || $valsesion==''){
    header("location:../login.html");
    die();
}

# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
include('../sistema/conexion.php'); #Incluir el archivo de conexión
$consulta = "SELECT Rol, Nombre FROM tblusuario WHERE Codigo='$valsesion'"; #consulto el codigo y el nombre de la persona que ingresa y lo guardo en valsesion
$resultado = mysqli_query($con, $consulta); #creo una variable que almacene los datos de la consulta

$filas = mysqli_fetch_array($resultado);#Fetch_array me trae los datos de cada fila, Creo una variable llamada '$filas' que va a almacenar el resultado de la consulta
$rolUsuario = $filas['Rol']; #creo una variable llamada 'rolUsuario' para almacenar el resultado con el Rol
$nombreUsuario= $filas['Nombre'];#creo una variable llamada 'nombreUsuario' para almacenar el resultado con el Nombre

mysqli_free_result($resultado); #obtengo el resultado y cuando no sea necesario lo elimino
mysqli_close($con); #cierro la conexión abierta a la bd

if ($rolUsuario != 2) { # Si el rol del usuario no es operario, redirigir al usuario a la página de inicio de sesión y cerrar la sesión
    session_destroy();
    header("location:../login.html");
    exit; # Detener la ejecución del script
}

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