<?php
# Comprobar si no hay una sesión activa antes de iniciar una nueva sesión (Para evitar errores, si la sesión ya está activa no hay necesidad de volver a iniciarla)
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

$valsesion= $_SESSION['codigoUser'];# Obtener el valor de la sesión

# Validar si la sesión está activa
if($valsesion== null || $valsesion==''){ #Si el valor codigoUser está vacio, significa que no hay una sesión activa, por ende no le doy acceso y lo devuelvo al index de login
    header("location:../index.html");
    die(); 
}
?>
