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
    <title>Formulario de registro comercializadora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Diligencie la información correspondiente</h1>
        </div>
        <form action="../sistema/registro_comercializadora.php" method="post">
            
            <div class="mb-3">
                <label for="Codigo">Código comercializadora:</label>
                <input type="text" id="Codigo" name="Codigo" required>
            </div>

            <div class="mb-3">
                <label for="Nombre">Nombre Comercializadora:</label>
                <input type="text" id="Nombre" name="Nombre" required>
            </div>

            <button class="enviar" type="submit" class="bt-send">LISTO</button>

        </form>
    </div>
</body>
</html>