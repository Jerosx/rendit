<?php
#----------------INCLUDES----------------
    include ('../sistema/validar_sesion.php'); #VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_rolad.php');  #VALIDACIÓN DE ROL
    include ('../sistema/fecha.php');          #FECHA
    include('../sistema/conexion.php');        #Conexión a la BD
#----------------INCLUDES----------------

#-----Manejo del término de búsqueda-----
$searchTerm = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = $_POST['searchTerm'];
}
#-----Manejo del término de búsqueda-----
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
    <title>Registro de nuevos motivos de</title>
</head>
<body>
<a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
<div class="container mt-5 text-center bg-light rounded w-75">
    <!-- Formulario de registro de usuarios -->
    <form class="form-floating" action="../sistema/registro_motivopare.php" method="post">
        <h2 class="display-4 mt-5">REGISTRO DE MOTIVOS DE PARO</h2>
        <div class="mb-3">
            <label class="form-label">NOMBRE</label><br/>
            <input type="text" class="form-control lg-8" name="Nombre" placeholder="Asigne un nombre al motivo de paro" required>
        </div>
        <button class="btn btn-warning m-3" type="submit">LISTO</button>
    </form>

    <!-- Formulario de búsqueda -->
    <form method="post" action="">
        <div class="mb-3">
            <input type="text" class="form-control" name="searchTerm" placeholder="Buscar motivo de paro" value="<?php echo htmlspecialchars($searchTerm); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Tabla de resultados de búsqueda -->
    <table class="table mt-5" border="1" align="left">
        <tr>
            <th>MOTIVOS DE PARO REGISTRADOS</th>
        </tr>
        <?php
        # Modificar la consulta según el término de búsqueda
        $consulta = $con->prepare("SELECT * FROM tblrazonparo WHERE Nombre LIKE ?");
        $likeTerm = '%' . $searchTerm . '%';
        $consulta->bind_param('s', $likeTerm);
        $consulta->execute();
        $resultado = $consulta->get_result();

        while ($fila = $resultado->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $fila['Nombre']; ?></td>
        </tr>
        <?php
        }
        $consulta->close();
        ?>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>