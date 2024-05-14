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
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="../diseño/style.css">
    <!-- Título de la página -->
    <title>Registro de nuevos usuarios</title>
    <!-- Enlaces a Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="login">
    
    <!-- Formulario de registro de usuarios -->
    <form class="myForm" action="../sistema/registro_usuario.php" method="post">
        <!-- Título del formulario -->
        <div class="titulo">
            <h1>Diligencie la información correspondiente</h1>
        </div>
        <!-- Campo para ingresar nombres -->
        <div class="mb-3">
             <label class="form-label">NOMBRES</label><br/>
             <input type="text" class="form-control" name="Nombres">
        </div>
        <!-- Campo para ingresar apellidos -->
        <div class="mb-3">
            <label class="form-label">APELLIDOS</label><br/>
            <input type="text" class="form-control" name="Apellidos">
       </div>
        <!-- Campo para ingresar código personal -->
        <div class="mb-3">
            <label class="form-label">CÓDIGO PERSONAL</label><br/>
            <input type="text" class="form-control" name="codigo">
        </div>
        <!-- Campo para ingresar contraseña -->
        <div class="mb-3">
            <label class="form-label">CONTRASEÑA</label><br/>
            <input type="text" class="form-control" name="contraseña">
        </div>
        <!-- Lista desplegable para seleccionar el cargo -->
        <div class="mb-3">
            <label class="form-label">CARGO</label><br/>
            <select name="rol" class="form-control">
                <option value="Administrador">Administrador</option>
                <option value="Operario">Operario</option>
            </select>
        </div>

        <!-- Botón para enviar el formulario -->
        <button class="login-but" type="submit" class="bt-send">LISTO</button>
    </form>
    
</body>
</html>
