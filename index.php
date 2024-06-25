<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="diseño/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body{
            background: whitesmoke;
            background: linear-gradient(to right, rgb(71, 128, 194), rgb(34, 52, 80) );
        }
        .bg{
        background-image: url(diseño/img/login-img.jpg);
        background-position: center center;
    }</style>
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="container w-75  bg-light mt-5 rounded shadow">
        <div class="row align-items-stretch">
                <div class="col bg d-none d-lg-block">
                </div>
                <div class="col">
                    <h2 class="fw-bold text-center pt-5 mb-5">BIENVENIDO A RENDIT</h2>
                <form class="form-floating" action="sistema/validar.php" method="POST">
                <div class="mt-5 mb-4">
                        <label for="codigoUser" class="form-label"> Codigo personal </label>
                        <input type="text" placeholder="Inserte su código" class="form-control" id="codigoUser" name="codigoUser" required>
                    </div>
                <div class=" mt-5 mb-4">
                        <label for="contrasena" class="form-label"> Contraseña </label>
                        <input type="password" placeholder="Inserte su contraseña" class="form-control" id="contrasena" name="contrasena" required>
                
                    </div>
                    <div class="d-grid mt-5 mb-5">
                    <button class="btn btn-warning" type="submmit">Iniciar Sesión</button>
                </div>
                

                </form>
                <div class="form-text">SENA ADSO 2024 (RENDIT)</div>
            </div>
        </div>
    </div>

    <?php
        session_start();
     

     if(isset($_SESSION["estado"])){?>
     <script>
        Swal.fire({
        icon: "warning",
        title: "Aviso",
        text: "ESTE USUARIO SE ENCUENTRA INHABILITADO COMUNIQUESE CON SU SUPERVISOR MÁS CERCANO",
        footer: ''
        });
     </script>
         <?php 
     }
     unset($_SESSION["estado"]);
     ?>
  <?php
        if(isset($_SESSION["validar"])){?>
            <script>
                Swal.fire({
                icon: "error",
                title: "error",
                text: "CREDENCIALES INCORRECTAS",
                footer: ''
                });
            </script>
                <?php 
            }
            unset($_SESSION["validar"]);
            ?>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>