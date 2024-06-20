<?php
#----------------INCLUDES----------------
    #INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');#VALIDACIÓN DE SESION ACTIVA


    #INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');#VALIDACIÓN DE ROL
    #FIN VALIDACIÓN DE ROL

    # INICIO FECHA
    include ('../sistema/fecha.php');#FECHA
    #FIN FECHA

    include('../sistema/conexion.php'); #conexión a la bd
        
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
    <title>Página principal administrador</title>
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../sistema/js/hora.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RENDIT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           USUARIOS
          </a>
          <ul class="dropdown-menu">
                <li class="dropdown-item"><a class="navbar-brand" href="tablaoperarios.php">Operarios registrados</a></li>
                <li class="dropdown-item"><a class="navbar-brand" href="tablaadmin.php">Administradores registrados</a></li>
                <li class="dropdown-item"><a class="navbar-brand" href="formusuario.php">Nuevo usuario</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           ESTADÍSTICA
          </a>
          <ul class="dropdown-menu">
                <li class="dropdown-item"><a class="navbar-brand" href="estadisticas.php">Estadisticas operarios</a></li>
                <li class="dropdown-item"><a class="navbar-brand" href="estadisticasParo.php">Estadisticas de paros</a></li>
                <li class="dropdown-item"><a class="navbar-brand" href="estadisticasGeneral.php">Estadistica general</a></li>
            </ul>
        </li>
      </ul>
    <ul class="navbar-nav ">
      <li class="nav-item"><p class="text-uppercase fs-6 mt-3 text-light"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p></li><!--SALUDO Y NOMBRE -->
      <li class="nav-item">
            <form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
    </div>
  </div>
</nav>
<div class="container text-center mt-5">
    <div class="tabla-usuarios">
        <h3 class="display-4">ADMINISTRADORES REGISTRADOS</h3>

        <!-- Formulario de búsqueda -->
        <form method="post" action="">
            <div class="mb-3">
                <input type="text" class="form-control" name="searchTerm" placeholder="Buscar administrador" value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <table class="table mt-5" border="1" align="left">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Código</th>
                <th>Estado</th>
                <th>Actualizar datos</th>
            </tr>
            <?php

            # Modificar la consulta según el término de búsqueda
            $consulta = $con->prepare("SELECT * FROM tblusuario WHERE Rol = 1 AND (
                CONCAT(Nombre, ' ', Apellido) LIKE ? 
                OR Nombre LIKE ? 
                OR Apellido LIKE ? 
                OR Codigo LIKE ? 
                OR Estado LIKE ?
            )");
            $likeTerm = '%' . $searchTerm . '%';
            $consulta->bind_param('sssss', $likeTerm, $likeTerm, $likeTerm, $likeTerm, $likeTerm);
            $consulta->execute();
            $resultado = $consulta->get_result();

            while($fila = $resultado->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $fila['Nombre']; ?></td>
                <td><?php echo $fila['Apellido']; ?></td>
                <td><?php echo $fila['Codigo']; ?></td>
                <td><?php echo $fila['Estado']; ?></td>
                <td><a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="actualizar_usuario.php?id=<?php echo $fila['Codigo']; ?>">Editar</a></td>
            </tr>
            <?php
            }
            $consulta->close();
            ?>
        </table>
        <!--FIN LISTA DE ADMINISTRADORES EN LA BASE DE DATOS-->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>