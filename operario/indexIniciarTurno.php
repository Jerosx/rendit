<?php
#-----------------------------------INCLUDES----------------------------------------
  #CONEXIÓN BD
   include('../sistema/conexion.php');
  #CONEXIÓN BD

  # INICIO FECHA
    include ('../sistema/fecha.php');
  #FIN FECHA

  #INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
  # FIN DE VALIDACIÓN DE SESION ACTIVA

  #INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolop.php');
  #FIN VALIDACIÓN DE ROL

  #INICIO VALIDACIÓN DE TURNO ACTIVO
    include ('../sistema/val_TurnoActivo.php');
  #FIN VALIDACION TURNO ACTIVO
#-----------------------------------INCLUDES----------------------------------------
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../diseño/img/rendit logo.png.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>COMENZAR TURNO</title>
    <script src="../sistema/js/hora.js"></script>
    
    <style>
        body {
            background-image: url(../diseño/img/fondoRendit.jpeg);
            background-size: 100% 100%;
            filter: unsharp-mask(1px 1px 1px);

            background-repeat: no-repeat;

            background-position: center;

            background-blend-mode: multiply;
            
        }

        /* Centramos el contenido principal */
        .container-custom {
            min-height: 80vh; /* Asegura que ocupe el 80% del alto de la pantalla */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .modal-dialog {
            max-width: 500px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <!--   <a class="navbar-brand" href="#">RENDIT</a> -->
         <div>
             <img src="../diseño/img/rendit logo.png.png" alt="" style="width="110" height="110"">
            </div>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item"></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><p class="text-uppercase fs-6 mt-3 text-light"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p></li>
                <li class="nav-item">
                    <form action="../sistema/cerrarsesion.php" method="post">
                        <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- El contenido central -->
<div class="container-custom text-center">
    <h1 class="display-4">BIENVENIDO</h1>
    <p class="text-dark">Asegúrese de estar listo antes de comenzar su turno</p>

    <!-- INICIO PESTAÑA MODAL INICIAR TURNO -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-iniciar">INICIAR TURNO</button>

    <div class="modal fade" id="modal-iniciar" tabindex="-1" aria-labelledby="modalIniciarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modalIniciarLabel">ATENCIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres comenzar tu turno?</p>
                    <form class="form-fluid" method="post" action="../sistema/iniciarTurno.php">
                        <div class="mb-3">
                            <label for="opcion" class="form-label">Seleccione una opción:</label>
                            <select class="form-select" name="opcion" id="opcion" required>
                                <option disabled selected>SELECCIONE UNA OPCIÓN:</option>
                                <option value="opcionSi">SI</option>
                                <option value="opcionNo">NO</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">CONFIRMAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN PESTAÑA MODAL INICIAR TURNO -->
</div>

</body>
</html>


<?php
    
     

    if(isset($_SESSION["registroDia"])){
        if($_SESSION["registroDia"]){
            ?>
            <script>
                Swal.fire({
                icon: "success",
                title: "",
                text: 'USTED YA TIENE UN TURNO REGISTRADO EL DÍA DE HOY ',
                showConfirmButton: false,
                timer: 2000,
                });
            </script>
            <?php
        }
       
    
    }
    unset($_SESSION["registroDia"]);
    ?>

<?php
    
    if (isset($_SESSION["turnoFin"])){
        if($_SESSION["turnoFin"]){
    ?>
                <script>
                Swal.fire({
                icon: "success",
                title: "",
                text: 'TURNO FINALIZADO EXITOSAMENTE ',
                showConfirmButton: false,
                timer: 1500
                });
            </script>
            <?php
        }

    }
   unset($_SESSION["turnoFin"]);
 ?>


<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   

    <script src="../sistema/js/modal_iniciar.js"></script>         <!--Script controla modal inicio turno -->

<!--EL SCRIPT DEL MODAL VA AL FINAL PARA GARANTIZAR QUE SE CARGUE DESPUÉS DE LOS BOTONES QUE VA A USAR -->   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>