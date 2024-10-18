<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
include ('../sistema/validar_rolop.php');
#FIN VALIDACIÓN DE ROL

#INICIO IMPRESIÓN MOTIVO DEL PARO
include ('../sistema/consultaMotivoPare.php');
#INICIO IMPRESIÓN MOTIVO DEL PARO

# INICIO FECHA
include ('../sistema/fecha.php');
#FIN FECHA
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Página de turno parado</title>
    <link rel="icon" href="../diseño/img/rendit logo.png.png" type="image/x-icon">
    <!-- <script src="../sistema/js/hora.js"></script> INHABILITO LA HORA POR FALLO-->

    <style>
        body {
            background-image: url(../diseño/img/fondoRendit.jpeg);
            background-size: 100% 100%;
            filter: unsharp-mask(1px 1px 1px);

            background-repeat: no-repeat;

            background-position: center;

            background-blend-mode: multiply;
            
        }
        .content-wrapper {
            min-height: 100vh; /* Asegura que el contenedor ocupe al menos toda la pantalla */
        }

        
    </style>
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">RENDIT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;"></ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <p class="text-uppercase fs-6 mt-3 text-light">
                            <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?>
                        </p>
                    </li> <!--SALUDO Y NOMBRE -->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid d-flex justify-content-center flex-wrap mb-5 p-5">
    <div class="container-fluid d-flex justify-content-center flex-wrap mb-5 p-5"></div>
    <div class="text-center mt-5 w-75">
        <H2 class="display-4">TURNO PARADO</H2>
        <br>
        <h3 class="display-5">MOTIVO: <?php echo $filaNombreParo['Nombre']?></h3>
        <h3 class="display-5">Ha transcurrido:</h3>
        <p class="text-primary fs-2" id="timer">00:00:00</p>
        <!--<script src="../sistema/js/cronometro_pare.js"></script>-->
        <script src="../sistema/js/retoma_tiempo_pare.js"></script> 

        <!--INICIO PESTAÑA MODAL RE-INICIAR TURNO -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-retomar">RETOMAR TURNO</button>

        <div class="modal fade" id="modal-retomar" tabindex="-1" aria-labelledby="modalRetomarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning" id="modalRetomarLabel">ATENCIÓN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que quieres retomar tú turno?</p>
                        <form method="post" action="../sistema/retomar_turno.php">
                            <div class="mb-3">
                                <label for="opcion" class="form-label">Seleccione "SI" para retomar:</label>
                                <select class="form-select" name="opcion" id="opcion" required>
                                    <option disabled selected>SELECCIONE UNA OPCIÓN:</option>
                                    <option value="opcionSi">SI</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">CONFIRMAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN PESTAÑA MODAL RE-INICIAR TURNO -->
    </div>
</div>

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
<script src="../sistema/js/modal_retomar_turno.js"></script>         <!--Script controla modal inicio turno -->

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>

<!-- Estilos CSS adicionales -->
