<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');
#FIN VALIDACIÓN DE ROL

# INICIO FECHA
    include ('../sistema/fecha.php');
#FIN FECHA
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
                <li class="dropdown-item"><a class="navbar-brand" href="formMotivopare.php">Nuevo motivo de paro</a></li> <!--POSICION PROVICIONAL-->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>