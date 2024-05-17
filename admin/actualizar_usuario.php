<?php
#------------------INCLUDES------------------------------
    include('../sistema/validar_sesion.php');
    include('../sistema/validar_rolad.php');
    include('../sistema/conexion.php');
#------------------INCLUDES------------------------------

$id = $_REQUEST['id']; // Se obtiene el valor del parámetro 'id' enviado a esta página

$sel = $con->prepare('SELECT * FROM tblusuario WHERE Codigo = ?');#Se prepara una consulta SQL para seleccionar datos de la tabla 'tblusuario' basados en el 'Codigo' proporcionado
$sel->bind_param('i', $id); #Se enlaza el parámetro de sustitución con el valor de la variable $id (un entero)
$sel->execute(); #Se ejecuta la consulta SQL preparada
$result = $sel->get_result(); #Se obtiene el resultado de la consulta como un conjunto de resultados
$fila = $result->fetch_assoc(); #Se extrae la primera fila de resultados como un array asociativo y se asigna a la variable $fila


$consultaEstados = 'SELECT Codigo, Nombre FROM tblestado';#Consulta SQL para obtener todos los códigos y nombres de la tabla 'tblestado'
$resultadoEstados = mysqli_query($con, $consultaEstados);#Se ejecuta la consulta SQL y se guarda el resultado en la variable $resultadoEstados
$consultaRoles = 'SELECT Codigo, Nombre FROM tblrol'; #Consulta SQL para obtener todos los códigos y nombres de la tabla 'tblrol'
$resultadoRoles = mysqli_query($con, $consultaRoles); #Se ejecuta la consulta SQL y se guarda el resultado en la variable $resultadoRoles
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: whitesmoke;
            background: linear-gradient(to right, rgb(71, 128, 194), rgb(34, 52, 80));
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <title>Actualizar datos Operarios</title>

</head>

<body>
    <a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
    <div class="container mt-5 text-center bg-light rounded w-75 ">
        <form class="form-floating" action="../sistema/update.php" method="POST">

            <h2 class="display-4 mt-5">Diligencie la información correspondiente</h2>

            <div class="mb-3">
                <input type="hidden" value="<?php echo $fila['Codigo'] ?>" name="Codigo"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">CONTRASEÑA</label>
                <input class="form-control" type="text" value="<?php echo $fila['Contraseña'] ?>" name="Contraseña"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">NOMBRE</label>
                <input class="form-control" type="text" value="<?php echo $fila['Nombre'] ?>" name="Nombre"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">APELLIDO</label>
                <input class="form-control" type="text" value="<?php echo $fila['Apellido'] ?>" name="Apellido"><br>
            </div>

            <div class="mb-3">
                <label class="form-label">ROL</label>
                <select id="Rol" name="Rol" required>
                    <?php while ($rol = mysqli_fetch_assoc($resultadoRoles)): ?>
                        <option value="<?= htmlspecialchars($rol['Codigo']) ?>"><?= htmlspecialchars($rol['Nombre']) ?></option>
                    <?php endwhile; ?>
                </select><br>
            </div>

            <div class="mb-3">
                <label for="Estado">ESTADO</label>
                <select id="Estado" name="Estado" required>
                    <?php while ($estado = mysqli_fetch_assoc($resultadoEstados)): ?>
                        <option value="<?= htmlspecialchars($estado['Codigo']) ?>"><?= htmlspecialchars($estado['Nombre']) ?></option>
                    <?php endwhile; ?>
                </select><br>
            </div>

            <input class="btn btn-warning m-3" type="submit" value="Modificar"><br>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
