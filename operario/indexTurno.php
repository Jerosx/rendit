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
    <title>TURNO EN PROCESO</title>

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
    <li class="nav-item"></li>
    <LI class="nav-item"><form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
            </form></LI><!--SALUDO Y NOMBRE -->
  
  </ul>
  </div>
</div>
</nav>
    <div class="container text-center mt-5 w-75">
         <p class="text-uppercase display-3 mt-3 text-secondary"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p>
     <div class="row">
        <div class="col-6">    
            <div class="row">
                <div class="col">
        
                    <table class="table mt-5" border="1" align="left"> <!--Creo una tabla -->
                                    <tr> 
                        
                                        <th>Cajas empacadas</th> <!--Creo el campo Cajas empacadas en la cabecera-->

                                    </tr>
                            <?php

                                $consulta=$con->query("SELECT Cajas FROM tblturno WHERE Empacador = '$valsesion' AND Fecha = '$fecha_actual'");
                                    while($fila=$consulta->fetch_assoc()){ //while queda bierto para repetir hasta acabar la impresión de la consulta
                                

                            ?>
                                <tr><td><h3 class="display-1"><?php echo $fila['Cajas']?></h3></td> <!--Comienza a escribir las cajas que se encuentra con la consulta hasta finalizar el while -->

                                </tr>
                            <?php
                                } #cierro el while
                            ?>
                    </table>

            <!--TABLA CON CAJAS EMPACADAS--->
            </div>  
            </div>  
            <div class="row">
                <div class="col align-self-end">
                     <!--BOTÓN SUMAR +1 CAJA EMPACADA--->

                        <form action="../sistema/sumarcaja.php" method="post">

                        <button class="btn btn-success m-2  p-5" type="submit" id="sumarCajaBTN" name="sumarCajaBTN" style="border-radius:150px;"> <h3 class="display-1">+</h3></button>

                        </form>

                    <!--BOTÓN SUMAR +1 CAJA EMPACADA--->
                </div>
                <div class="col align-self-start">
                         <!--BOTÓN RESTAR -1 CAJA EMPACADA--->
            
                        <form action="../sistema/restarcaja.php" method="post">

                        <button class="btn btn-danger m-2 p-5" type="submit" id="restarCajaBTN" name="restarCajaBTN" style="border-radius:150px;"><h3 class="display-1">-</h3></button>

                        </form>
                </div>

           
            
           
                </div>
            </div>
        <div class="col-6 pt-4">
            <div class="row m-4"></div>
            <div class="row mt-4">
               
                <button class="btn btn-warning m-3 p-4" id="btn-modal-parar"><h3 class="display-2">PARAR TURNO</h3></button>

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



                        </dialog>
            <!--FIN PESTAÑA MODAL PARE TURNO -->
                </div>
                <div class="row">
                                                    
                        <!--INICIO PESTAÑA MODAL TERMINAR TURNO -->

                        <button class="btn btn-danger m-3 p-4" id="btn-modal-terminar"><h3 class="display-2">FINALIZAR TURNO</h3></button>

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
                </div>

            

                    
        </div>


        <!--INICIO PESTAÑA MODAL PARE TURNO -->

          
        <!--FIN PESTAÑA MODAL TERMINAR TURNO -->

            
        <!--INICIO BOTÓN CIERRE DE SESIÓN -->

           

        <!--FIN BOTÓN CIERRE DE SESIÓN -->
    

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
        <script src="../sistema/js/modal_parar.js"></script>                      <!--Script controla modal xxxxxx turno -->
        <script src="../sistema/js/modal_terminar.js"></script>                      <!--Script controla modal terminar turno -->
        </div>      
       
    </div>
<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>