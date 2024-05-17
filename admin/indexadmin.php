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
           MENÚ
          </a>
          <ul class="dropdown-menu">
                <li class="dropdown-item"><a class="navbar-brand" href="#">Estadisticas</a></li>
                <li class="dropdown-item"><a class="navbar-brand" href="formusuario.php">Nuevo operario</a></li>
            </ul>
        </li>
      </ul>
    <ul class="navbar-nav ">
      <li class="nav-item"><p class="text-uppercase fs-6 mt-3 text-light"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p></li><!--SALUDO Y NOMBRE -->
      <li class="nav-item"><form action="../sistema/cerrarsesion.php" method="post">
            <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button></li>
    </ul>
    </div>
  </div>
</nav>
    <div class="container text-center mt-5">
        <!--CREACION LISTA DE OPERARIOS EN LA BASE DE DATOS-->
        <?php
            include('../sistema/conexion.php'); #Traigo la conexión a la bd
        ?>
        <div class="tabla-usuarios">
             <h3 class="display-4">OPERARIOS REGISTRADOS</h3>
            <table class="table mt-5" border="1" align="left"> <!--Creo una tabbla -->
                            <tr> 
                
                                <th>Nombre</th> <!--Creo el campo Nombre en la cabecera-->
                                <th>Apellidos</th><!--Creo el campo Apellidos en la cabecera-->
                                <th>Código</th><!--Creo el campo Codigo en la cabecera-->
                                <th>Estado</th><!--Creo el campo Codigo en la cabecera-->
                                <th>Actualizar datos</th><!--Creo el campo Actualizar datos Operario en la cabecera-->

                            </tr>
                    <?php
                        $consulta=$con->query("SELECT * FROM tblusuario WHERE Rol=2");#Creo una variable llamada 'conuslta' para almacenar la consulta a la Bd, le digo que traiga todos los usuarios con rol=2 (OPERARIOS) y estado = 1 (ACTIVO)
                            while($fila=$consulta->fetch_assoc()){ //while queda bierto para repetir hasta acabar la impresión de la consulta
                    ?>
                        <tr><td><?php echo $fila['Nombre']?></td> <!--Comienza a escribir en bucle los nombres, apellidos y codigos que se encuentra con la consulta hasta finalizar el while -->
                            <td><?php echo $fila['Apellido']?></td>
                            <td><?php echo $fila['Codigo']?></td>
                            <td><?php echo $fila['Estado']?></td>
                            <td><a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="actualizar_usuario.php?id=<?php echo $fila['Codigo']?>">Editar</a></td>

                        </tr>
                    <?php
                        } //cierro el while
                    ?>
            </table>

            <div class="tabla-usuarios">
             <h3 class="display-4">ADMINISTRADORES REGISTRADOS</h3>
            <table class="table mt-5" border="1" align="left"> <!--Creo una tabbla -->
                            <tr> 
                
                                <th>Nombre</th> <!--Creo el campo Nombre en la cabecera-->
                                <th>Apellidos</th><!--Creo el campo Apellidos en la cabecera-->
                                <th>Código</th><!--Creo el campo Codigo en la cabecera-->
                                <th>Estado</th><!--Creo el campo Codigo en la cabecera-->
                                <th>Actualizar datos</th><!--Creo el campo Actualizar datos Operario en la cabecera-->

                            </tr>
                    <?php
                        $consulta=$con->query("SELECT * FROM tblusuario WHERE Rol=1");#Creo una variable llamada 'conuslta' para almacenar la consulta a la Bd, le digo que traiga todos los usuarios con rol=2 (OPERARIOS) y estado = 1 (ACTIVO)
                            while($fila=$consulta->fetch_assoc()){ //while queda bierto para repetir hasta acabar la impresión de la consulta
                    ?>
                        <tr><td><?php echo $fila['Nombre']?></td> <!--Comienza a escribir en bucle los nombres, apellidos y codigos que se encuentra con la consulta hasta finalizar el while -->
                            <td><?php echo $fila['Apellido']?></td>
                            <td><?php echo $fila['Codigo']?></td>
                            <td><?php echo $fila['Estado']?></td>
                            <td><a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="actualizar_usuario.php?id=<?php echo $fila['Codigo']?>">Editar</a></td>

                        </tr>
                    <?php
                        } //cierro el while
                    ?>
            </table>
            <!--FIN LISTA DE OPERARIOS EN LA BASE DE DATOS-->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>