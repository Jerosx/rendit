<?php
#----------------INCLUDES----------------
    include ('../sistema/validar_sesion.php'); #VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_rolad.php'); #VALIDACIÓN DE ROL
    include ('../sistema/fecha.php');         #FECHA
    include('../sistema/conexion.php');       #Conexión a la BD
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
    <title>Administradores registrados</title>
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../diseño/img/rendit logo.png.png" type="image/x-icon">
    <script src="../sistema/js/hora.js"></script>
</head>
<body>
<style>



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
             <img src="../diseño/img/renditlogo.png" alt="" style="width:'60' height'60'">
            </div>
  
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="margin: 10px;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RENDIT</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body overflow-auto px-3 py-3">
    <ul class="navbar-nav justify-content-start flex-grow-1 pe-3" style="max-heigth:'70vh'">
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
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Código</th>
                <th>Estado</th>
                <th>Actualizar datos</th>
            </tr>
            <?php
            # Modificar la consulta según el término de búsqueda
            $consulta = $con->prepare("
                SELECT u.*, e.Nombre AS EstadoNombre
                FROM tblusuario u
                JOIN tblestado e ON u.Estado = e.Codigo
                WHERE u.Rol = 1
                AND (
                    CONCAT(u.Nombre, ' ', u.Apellido) LIKE ? 
                    OR u.Nombre LIKE ? 
                    OR u.Apellido LIKE ? 
                    OR u.Codigo LIKE ? 
                    OR e.Nombre LIKE ?
                )
            ");
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
                <td><?php echo $fila['EstadoNombre']; ?></td>
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
