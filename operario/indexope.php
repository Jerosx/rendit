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
    <link rel="stylesheet" href="../diseño/style.css">
    <title>Página principal operario</title>

    <script src="../sistema/js/hora.js"></script>

</head>
<body class="body-admin">
   <header class="header-index-admin"> 
    <div class="user-name">
        <p> <?php echo "Bienvenid@ <br> $nombreUsuario" ?> </p> <!--SALUDO Y NOMBRE -->
    </div>    

    <div class="time-config">
        <p> <span id="hora"></span></p> <!-- HORA -->
        <p> <?php echo "$fecha_actual" ?></p><!-- FECHA -->
        
            <!-- Llama a la función actualizarHora al cargar la página -->
                <script>
                    window.onload = function() {
                        actualizarHora();
                    };
                </script>
            <!-- Llama a la función actualizarHora al cargar la página -->
    </div>
    </header> 

    <div class="main-admin">
         <H1>OPERARIO</H1>

        <!-- INICIO Cronometro -->
            <!-- <div id="timer">00:00:00</div>
            <button onclick="startTimer()">Iniciar Cronómetro</button>
            <button onclick="pauseTimer()">Pausar Cronómetro</button>
            <button onclick="resetTimer()">Finalizar Cronómetro</button>

            <script src="../sistema/js/cronometro.js"></script>-->
        <!--FIN Cronometro-->

        <!--INICIO PESTAÑA MODAL INICIAR TURNO -->

            <button class="ope-but" id="btn-modal-iniciar">INICIAR TURNO</button>

            <dialog id="modal-iniciar">

                <h2> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres comenzar tú turno?<p>

                <form method="post" action="../sistema/iniciarTurno.php">
        
                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionSi">SI</option>
                            <option value="opcionNo">NO</option>
                        </select>
                        <button class="admin-but" type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-iniciar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL INICIAR TURNO -->

        <!--INICIO PESTAÑA MODAL PARE TURNO -->

            <button class="ope-but" id="btn-modal-parar">PARAR TURNO</button>

            <dialog id="modal-parar">

                <h2> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres parar tú turno?<p>

                <form method="post" action="../sistema/iniciar_pare.php">

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
                        <button class="admin-but"  type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-parar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL PARE TURNO -->

        <!--INICIO PESTAÑA MODAL TERMINAR TURNO -->

            <button class="ope-but" id="btn-modal-terminar">FINALIZAR TURNO</button>

            <dialog id="modal-terminar">

                <h2> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres terminar tú turno?<p>

                <form method="post" action="../sistema/terminarTurno.php">

                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE UNA OPCIÓN:</option>
                            <option value="opcionSi">SI</option>
                            <option value="opcionNo">NO</option>
                        </select>
                        <button class="admin-but"  type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <!--<button id="btn-cerrar-modal-terminar">Cerrar</button>-->

            </dialog>
        <!--FIN PESTAÑA MODAL TERMINAR TURNO -->

    <!--INICIO Contador de cajas -->
        <div class="campo-cajas">

            <form action="../sistema/actualizarcajas.php" method="post">
                <label for="cajas">Cajas empacadas:</label>
                <input type="number" min="0" id="cajas" name="cajas"> <!--La cantidad de cajas no va a ser inferior a 0 -->
                <button class="admin-but2"  type="submit">GUARDAR</button>
            </form>

            <p id="numero-cajas"><?php include('../sistema/obtenerCajasBD.php'); ?></p>
        </div>
    <!--FIN Contador de cajas -->

     <!--INICIO BOTÓN CIERRE DE SESIÓN -->
        <form action="../sistema/cerrarsesion.php" method="post">
        <button class="admin-but2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
     <!--FIN BOTÓN CIERRE DE SESIÓN -->

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

    <script src="../sistema/js/modal_iniciar.js"></script>         <!--Script controla modal inicio turno -->
    <script src="../sistema/js/modal_parar.js"></script>                      <!--Script controla modal xxxxxx turno -->
    <script src="../sistema/js/modal_terminar.js"></script>        <!--Script controla modal terminar turno -->
</div>
<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

</body>
</html>