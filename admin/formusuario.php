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
    <link rel="stylesheet" href="../diseño/style.css">
    <title>Registro de nuevos usuarios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="login">
    
        <form class="myForm" action="../sistema/registro_usuario.php" method="post">
            <div class="titulo">
                <h1>Diligencie la información correspondiente</h1>
            </div>
            <div class="mb-3">
                 <label class="form-label">NOMBRES</label><br/>
                 <input type="text" class="form-control" name="Nombres">
            </div>
            <div class="mb-3">
                <label class="form-label">APELLIDOS</label><br/>
                <input type="text" class="form-control" name="Apellidos">
           </div>
            <div class="mb-3">
                <label class="form-label">CÓDIGO PERSONAL</label><br/>
                <input type="text" class="form-control" name="codigo">
            </div>
            <div class="mb-3">
                <label class="form-label">CONTRASEÑA</label><br/>
                <input type="text" class="form-control" name="contraseña">
            </div>
            <div class="mb-3">
                <label class="form-label">CARGO</label><br/>
                <input type="text" class="form-control" name="rol">
            </div>
            <div class="mb-3">
                <label class="form-label">ESTADO</label><br/>
                <input type="number" class="form-control" name="estado">
            </div>
            <button class="login-but" type="submit" class="bt-send">LISTO</button>
        </form>
    
</body>
</html>