<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA

    session_start();
    $valsesion= $_SESSION['codigoUser'];

    if($valsesion== null || $valsesion==''){
        header("location:../index.html");
        die();
    }

# FIN DE VALIDACIÓN DE SESION ACTIVA
?>