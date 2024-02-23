<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');
#FIN VALIDACIÓN DE ROL
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECCIÓN DE ACCIÓN COMERCIALIZADORA O VARIEDADES</title>
</head>
<body>
    
    <h1>¿QUÉ DESEAS HACER?</h1>
    
    <a href="formcomercializadora.php">Registrar nueva comercializadora</a>
    <a href="formvariedades.php">Registrar nueva variedad</a>
    <a href='../admin/indexadmin.php'> REGRESAR </a>

</body>
</html>