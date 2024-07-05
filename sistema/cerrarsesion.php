<?php

session_start(); #Inicio la sesión
session_destroy(); #destruyo la sesión
/* echo "<script> alert('SESSIÓN CERRADA');window.location.href='../index.html';</script>";exit;
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>cerrar sesion </title>
</head>
<body>

<script>
    Swal.fire({
  position: "top-center",
  icon: "success",
  title: "SESION CERRADA CON EXITO",
  showConfirmButton: false,
  timer:1500,
  timerprogressBar:true,
    });

    setTimeout(() =>{
      window.location.href="../index.php";

    }, 1500);
  

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
    
</body>
</html>