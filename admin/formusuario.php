<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');
#FIN VALIDACIÓN DE ROL

#conexion BD
include('../sistema/conexion.php');

$consultaRoles = 'SELECT Codigo, Nombre FROM tblrol'; #Consulta SQL para obtener todos los códigos y nombres de la tabla 'tblrol'
$resultadoRoles = mysqli_query($con, $consultaRoles); #Se ejecuta la consulta SQL y se guarda el resultado en la variable $resultadoRoles
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al archivo CSS -->
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <!-- Título de la página -->
    <style>
        body{
            background: whitesmoke;
            background: linear-gradient(to right, rgb(71, 128, 194), rgb(34, 52, 80) );
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de nuevos usuarios</title>
    <!-- Enlaces a Google Fonts -->
</head>
<body>
<a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
    <div class="container mt-5 text-center bg-light rounded w-75 ">
    <!-- Formulario de registro de usuarios -->
        <form class="form-floating" action="../sistema/registro_usuario.php" method="post">
            <!-- Título del formulario -->
                <h2 class="display-4 mt-5">Diligencie la información correspondiente</h2> 
            <!-- Campo para ingresar nombres -->
            <div class="mb-3">
                <label class="form-label">NOMBRES</label><br/>
                <input type="text" class="form-control lg-8" name="Nombres" required>
            </div>
            <!-- Campo para ingresar apellidos -->
            <div class="mb-3">
                <label class="form-label">APELLIDOS</label><br/>
                <input type="text" class="form-control" name="Apellidos" required>
        </div>
            <!-- Campo para ingresar código personal -->
            <div class="mb-3">
                <label class="form-label">CÓDIGO PERSONAL</label><br/>
                <input type="text" class="form-control" name="codigo" required>
            </div>
            <!-- Campo para ingresar contraseña -->
            <div class="mb-3">
                <label class="form-label">CONTRASEÑA</label><br/>
                <input type="password" class="form-control" name="contrasena" required>
            </div>
            <!-- Lista desplegable para seleccionar el cargo -->
            <div class="mb-3">
                <label class="form-label">CARGO</label>
                <select id="rol" name="rol" required>
                    <?php while ($rol = mysqli_fetch_assoc($resultadoRoles)): ?>
                        <option value="<?= htmlspecialchars($rol['Codigo']) ?>"><?= htmlspecialchars($rol['Nombre']) ?></option>
                    <?php endwhile; ?>
                </select><br>
            </div>

            

            <!-- Botón para enviar el formulario -->
            <button class="btn btn-warning m-3" type="submit" class="bt-send">LISTO</button>
         
            
        </form>
       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>