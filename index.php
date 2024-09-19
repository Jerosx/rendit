<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="diseño/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
       body {
            background: whitesmoke;
            background: linear-gradient(to right, rgb(71, 128, 194), rgb(34, 52, 80));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .bg {
            background-image: url(diseño/img/login-img.jpg);
            background-position: center center;
            padding-right: 50px;
            margin-right: 50px;
        }

        .form-container {
            width: 100%;
            max-width: 800px; /* Aumentamos el ancho máximo a 800px */


        }
        

        @media (min-width: 992px) {
            .form-container {
                max-width: 1200px; /* Expande el contenedor en pantallas grandes */
            }

            .bg {
                height: auto;
                border-radius: 0.5rem 0 0 0.5rem; /* Ajuste de los bordes en pantallas grandes */
            }

            .col.p-5 {
                padding: 50px; /* Mayor espaciado en pantallas grandes */
            }
        }

       
        
    </style>
    <title>Inicio de sesión</title>
</head>
<body>
    <div class="container w-75 bg-light rounded shadow form-container">
        <div class="row align-items-stretch expand-lg ">
            <div class="col bg d-none d-lg-block pl-3 img-thumbnail"></div>
            
            <div class="col p-5">
                <h2 class="fw-bold text-center pt-5 mb-5">BIENVENIDO A RENDIT</h2>
                <form class="form-floating" action="sistema/validar.php" method="POST">
                    <div class="mb-4">
                        <label for="codigoUser" class="form-label">Codigo personal</label>
                        <input type="text" placeholder="Inserte su código" class="form-control" id="codigoUser" name="codigoUser" required>
                    </div>
                    <div class="mb-4">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" placeholder="Inserte su contraseña" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <div class="d-grid mb-5">
                        <button class="btn btn-warning" type="submit">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="form-text">SENA ADSO 2024 (RENDIT)</div>
            </div>
        </div>
    </div>
</body>
</html>

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
                showConfirmButton: false,
                timer: 1500,
                });
            </script>
                <?php 
            }
            unset($_SESSION["validar"]);
            ?>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>