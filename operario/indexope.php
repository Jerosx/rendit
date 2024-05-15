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
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página principal operario</title>

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
         <P class="text-dark">¿Que desea hacer?</P>

        <!-- INICIO Cronometro -->
            <!-- <div id="timer">00:00:00</div>
            <button onclick="startTimer()">Iniciar Cronómetro</button>
            <button onclick="pauseTimer()">Pausar Cronómetro</button>
            <button onclick="resetTimer()">Finalizar Cronómetro</button>

            <script src="../sistema/js/cronometro.js"></script>-->
        <!--FIN Cronometro-->

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

        <!--INICIO PESTAÑA MODAL PARE TURNO -->

            <button class="btn btn-warning" id="btn-modal-parar">PARAR TURNO</button>

            <dialog id="modal-parar">

                <h2 class="text-warning"> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres parar tú turno?<p>

                <form class="form-fluid" method="post" action="../sistema/iniciar_pare.php">

                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionSi">SI</option>
                            <option value="opcionNo">NO</option>
                        </select>

                        <p> ¿Cuál es el motivo del pare?<p>  
                        <select name="motivo" id="motivo">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionDesayuno">DESAYUNO</option>
                            <option value="opcionFCanastillas">FALTA CANASTILLAS</option>
                            <option value="opcionBandaLlena">BANDA LLENA</option>
                            <option value="opcionFFlor">FALTA FLOR</option>
                            <option value="opcionFMaterial">FALTA DE MATERIAL</option>
                        </select>
                        <button class="btn btn-success"  type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-parar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL PARE TURNO -->

        <!--INICIO PESTAÑA MODAL TERMINAR TURNO -->

            <button class="btn btn-danger" id="btn-modal-terminar">FINALIZAR TURNO</button>

            <dialog id="modal-terminar">

                <h2 class="text-danger"> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres terminar tú turno?<p>

                <form method="post" action="../sistema/terminarTurno.php">

                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionSi">SI</option>
                            <option value="opcionNo">NO</option>
                        </select>
                        <button class="btn btn-warning"  type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-terminar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL TERMINAR TURNO -->

    <!--INICIO Contador de cajas -->
        <div class="container mt-5 w-75">

            <form class="form-floating" action="../sistema/actualizarcajas.php" method="post">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Ingrese la cantidad de cajas" aria-label="Recipient's username" aria-describedby="button-addon2" min="0" id="cajas" name="cajas">
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>

               
            </form>

            <p id="numero-cajas"><?php include('../sistema/obtenerCajasBD.php'); ?></p>
        </div>
    <!--FIN Contador de cajas -->
       <!--INICIO BOTÓN CIERRE DE SESIÓN -->
        <form action="../sistema/cerrarsesion.php" method="post">
        <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
        <!--FIN BOTÓN CIERRE DE SESIÓN -->
    

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

    <script src="../sistema/js/modal_iniciar.js"></script>         <!--Script controla modal inicio turno -->
    <script src="../sistema/js/modal_parar.js"></script>                      <!--Script controla modal xxxxxx turno -->
    <script src="../sistema/js/modal_terminar.js"></script>        <!--Script controla modal terminar turno -->
</div>
<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>