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
    <link rel="icon" href="../diseño/img/rendit logo.png.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Actualizar datos Operarios</title>
</head>

<body>
<style>

body {
  background-image: url(../diseño/img/fondoRendit.jpeg);
            background-size: 100% 100%;
            filter: unsharp-mask(1px 1px 1px);

            background-repeat: no-repeat;

            background-position: center;

            background-blend-mode: multiply;
            
        }

    .navbar-nav .nav-link {
      transition: background-color 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover {
      background-color: #ccc;
      /* Cambia el color de fondo al pasar el mouse */
      color: #333;
      /* Cambia el color del texto al pasar el mouse */
      border-radius: 5px;
      /* Agrega un borde redondeado */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Agrega una sombra */
    }
  </style>

<nav class="navbar bg-primary fixed-left px-3 py-3">
  <div class="container-fluid">
    <div class="d-flex align-items-center">

      <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- <a class="navbar-brand p-2 " href="#">RENDIT</a> -->
      <div class="mx-3">
             <img src="../diseño/img/renditlogo.png" alt="" style="width="60" height="60"">
            </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="margin: 10px;">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RENDIT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body overflow-auto px-3 py-3">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3" style="max-heigth: 70vh;">
          <li class="d-flex align-items-center nav-item mb-2"><i class="fa-solid fa-user fa-2xl " style="color: #1346a0;"></i><span class="nav-link fw-bold mx-2">USUARIOS</span> </li>

          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="tablaoperarios.php">Operarios registrados</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="tablaadmin.php">Administradores registrados</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="formusuario.php">Nuevo usuario</a></li>

          <li class="d-flex align-items-center nav-item mb-3 mt-3 ml-2"><i class="fa-solid fa-chart-line fa-2xl " style="color: #3c73d3;"></i><span class="nav-link fw-bold mx-2">ESTADISTICAS</span></li>

          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticas.php">Estadísticas operarios</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticasParo.php">Estadísticas de paros</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticasGeneral.php">Estadística general</a></li>
          <ul class="navbar-nav">
            <li class="nav-item">
              <p class="  text-uppercase fs-6 mt-5 text-dark"> <?php echo "$nombreUsuario" . " " . "$apellidoUsuario"; ?> </p>
            </li><!--SALUDO Y NOMBRE -->
            <li class="nav-item">
              <form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning mt-4" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

    <div class="container mt-5 text-center bg-light rounded w-75 ">
        <form class="form-floating" action="../sistema/update.php" method="POST">
            <h2 class="display-4 mt-5">Diligencie la información correspondiente</h2>
            <div class="mb-3">
                <input type="hidden" value="<?php echo $fila['Codigo'] ?>" name="Codigo"><br>
            </div>
            <div class="mb-3">
                <label class="form-label">CONTRASEÑA</label>
                <input class="form-control" type="password" value="<?php echo $fila['Contrasena'] ?>" name="Contrasena" required><br>
            </div>
            <div class="mb-3">
                <label class="form-label">NOMBRE</label>
                <input class="form-control" type="text" value="<?php echo $fila['Nombre'] ?>" name="Nombre"pattern="[A-Za-zÀ-ÿ\s]+"  required><br>
            </div>
            <div class="mb-3">
                <label class="form-label">APELLIDO</label>
                <input class="form-control" type="text" value="<?php echo $fila['Apellido'] ?>" name="Apellido" pattern="[A-Za-zÀ-ÿ\s]+" required><br>
            </div>
            <div class="mb-3">
                <label class="form-label">ROL</label>
                <select id="Rol" class="form-control" name="Rol" required>
                    <?php while ($rol = mysqli_fetch_assoc($resultadoRoles)): ?>
                        <option value="<?= htmlspecialchars($rol['Codigo']) ?>" <?php if ($rol['Codigo'] == $fila['Rol']) echo 'selected'; ?>>
                            <?= htmlspecialchars($rol['Nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select><br>
            </div>
            <div class="mb-3">
                <label for="form-label" class="form-label">ESTADO</label>
                <select id="Estado" class="form-control" name="Estado" required>
                    <?php while ($estado = mysqli_fetch_assoc($resultadoEstados)): ?>
                        <option value="<?= htmlspecialchars($estado['Codigo']) ?>" <?php if ($estado['Codigo'] == $fila['Estado']) echo 'selected'; ?>>
                            <?= htmlspecialchars($estado['Nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select><br>
            </div>
            <input class="btn btn-warning m-3" type="submit" value="Modificar"><br>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
