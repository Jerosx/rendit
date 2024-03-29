<?php
#INICIO VALIDACIÓN DE ROL
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$consulta = "SELECT Rol, Nombre FROM tblusuario WHERE Codigo='$valsesion'"; #consulto el codigo y el nombre de la persona que ingresa y lo guardo en valsesion
$resultado = mysqli_query($con, $consulta); #creo una variable que almacene los datos de la consulta

$filas = mysqli_fetch_array($resultado);#Fetch_array me trae los datos de cada fila, Creo una variable llamada '$filas' que va a almacenar el resultado de la consulta
$rolUsuario = $filas['Rol']; #creo una variable llamada 'rolUsuario' para almacenar el resultado con el Rol
$nombreUsuario= $filas['Nombre'];#creo una variable llamada 'nombreUsuario' para almacenar el resultado con el Nombre

mysqli_free_result($resultado); #obtengo el resultado y cuando no sea necesario lo elimino
mysqli_close($con); #cierro la conexión abierta a la bd

if ($rolUsuario != 1) { # Si el rol del usuario no es administrador, redirigir al usuario a la página de inicio de sesión y cerrarle la sesión
    session_destroy();
    header("location:../index.html");
    exit; # Detener la ejecución del script
}

#FIN VALIDACIÓN DE ROL
?>