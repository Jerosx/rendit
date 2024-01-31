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

$conexion = mysqli_connect('localhost', 'root', '', 'rendit'); #creo una conexión a la BD 
$consulta = "SELECT Rol FROM tblusuario WHERE Codigo='$valsesion'"; #consulto el codigo de la persona y lo guardo en valsesion
$resultado = mysqli_query($conexion, $consulta); #creo una variable que almacene los datos de la consulta

$filas = mysqli_fetch_array($resultado);#Fetch_array me trae los datos de cada fila, Creo una variable llamada '$filas' que va a almacenar el resultado de la consulta
$rolUsuario = $filas['Rol']; #creo una variable llamada 'rolUsuario' para almacenar el resultado con el Rol

mysqli_free_result($resultado); #obtengo el resultado y cuando no sea necesario lo elimino
mysqli_close($conexion); #cierro la conexión abierta a la bd

if ($rolUsuario != 2) { # Si el rol del usuario no es operario, redirigir al usuario a la página de inicio de sesión y cerrar la sesión
    session_destroy();
    header("location:../login.html");
    exit; # Detener la ejecución del script
}

#FIN VALIDACIÓN DE ROL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal operario</title>
</head>
<body>
    
    <H1>OPERARIO</H1>

    <form action="../sistema/cerrarsesion.php" method="post">
    <button type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>



</body>
</html>