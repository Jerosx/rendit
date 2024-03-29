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
    <title>Página de turno parado</title>

    <!-- <script src="../sistema/hora.js"></script> INHABILITO LA HORA POR FALLO--> 

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
        </div>
                <!-- Llama a la función actualizarHora al cargar la página -->
    </header> 
    <div class="main-admin">
                <H1>TURNO PARADO</H1>

                

            <h1>Cronómetro</h1>
            <p id="timer">00:00</p>
            <script src="../sistema/cronometro_pare.js"></script>


        <!--INICIO PESTAÑA MODAL RE-INICIAR TURNO -->

            <button class="admin-but" id="btn-modal-retomar">RETOMAR TURNO</button>

            <dialog id="modal-retomar">

                <h2> ATENCIÓN </h2>
                <p> ¿Estás seguro de que quieres retomar tú turno?<p>

                <form method="post" action="../sistema/retomar_turno.php">

                        <select name="opcion" id="opcion">
                            <option disabled selected="">SELECCIONE "SI" PARA RETOMAR:</option>
                            <option value="opcionSi">SI</option>
                        </select>
                        <button type="submit" value="Enviar">CONFIRMAR</button>
                </form>

                <button class="admin-but" id="btn-cerrar-modal-retomar">AÚN NO VOY A RETOMAR</button>

            </dialog>

        <!--FIN PESTAÑA MODAL RE-INICIAR TURNO -->

        <!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

            <script src="../sistema/modal_retomar_turno.js"></script>         <!--Script controla modal inicio turno -->

        <!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->
                
    </div>

</body>
</html>