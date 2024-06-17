<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
include ('../sistema/validar_rolop.php');
#FIN VALIDACIÓN DE ROL

# INICIO FECHA
include ('../sistema/fecha.php');
#FIN FECHA

#CONEXIÓN BD
include('../sistema/conexion.php');
#CONEXIÓN BD
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>COMENZAR TURNO</title>

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
    </ul>
  <ul class="navbar-nav ">
    <li class="nav-item"><p class="text-uppercase fs-6 mt-3 text-light"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p></li><!--SALUDO Y NOMBRE -->
  
  </ul>
  </div>
</div>
</nav>
    <div class="container text-center mt-5 w-75">
         <H1 class="display-4">BIENVENIDO</H1>
         <P class="text-dark">Asegurese de estar listo antes de comenzar su turno</P>


        <!--INICIO PESTAÑA MODAL INICIAR TURNO -->

            <button class="btn btn-success" id="btn-modal-iniciar">INICIAR TURNO</button>

            <dialog id="modal-iniciar">

                <h2 class="text-warning"> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres comenzar tú turno?<p>

                <form  class="form-fluid" method="post" action="../sistema/iniciarTurno.php">
        
                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionSi">SI</option>
                            <option value="opcionNo">NO</option>
                        </select>
                        <button class="btn btn-success" type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-iniciar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL INICIAR TURNO -->
            
        <!--INICIO BOTÓN CIERRE DE SESIÓN -->

            <form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
            </form>

        <!--FIN BOTÓN CIERRE DE SESIÓN -->
    

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

    <script src="../sistema/js/modal_iniciar.js"></script>         <!--Script controla modal inicio turno -->

</div>
<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>