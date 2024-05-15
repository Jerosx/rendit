<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');
#FIN VALIDACIÓN DE ROL
?>
<?php
    include('../sistema/conexion.php');
    $id=$_REQUEST['id'];

    $sel=$con->query('SELECT*FROM tblusuario WHERE Codigo='.$id); // Se realiza la consulta para obtener los datos del usuario con el Código proporcionado
        if($fila=$sel->fetch_assoc()){  // Si se encuentra una fila en el resultado de la consulta, significa que se encontró el usuario

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: whitesmoke;
            background: linear-gradient(to right, rgb(71, 128, 194), rgb(34, 52, 80) );
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../diseño/style.css">-->
    <title>Actualizar datos Operarios</title>

</head>
<body> 
<a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
    <div class="container mt-5 text-center bg-light rounded w-75 ">
        <form class="form-floating" action="../sistema/update.php" method="POST">
            
            <h2 class="display-4 mt-5">Diligencie la información correspondiente</h2> 

            <div class="mb-3">
                    <input type="hidden" value="<?php echo $fila['Codigo']?>" name="Codigo"><br> <!--campo oculto para enviar el codigo a la actualizacion-->
            </div>
           
            <div class="mb-3">
                    <label class="form-label">CONTRASEÑA</label>
                    <input class="form-control" type="text" value="<?php echo $fila['Contraseña']?>" name="Contraseña"><br> <!--campo para abtener la contraseña-->
            </div>
            
            <div class="mb-3">
                    <label class="form-label">NOMBRE</label>
                    <input class="form-control" type="text" value="<?php echo $fila['Nombre']?>"name="Nombre"><br> <!--campo para abtener el nombre-->
            </div>
            <div class="mb-3">
                    <label class="form-label">APELLIDO</label>
                    <input class="form-control" type="text" value="<?php echo $fila['Apellido']?>" name="Apellido"><br> <!--campo para abtener los apellidos-->
            </div>
            <div class="mb-3">
                   <label class="form-label">ROL</label>
                    <input class="form-control" type="text" value="<?php echo $fila['Rol']?>" name="Rol"><br> <!--campo para abtener el rol-->
            </div>
           <div class="mb-3">
                   <label class="form-label">ESTADO</label>
                    <input class="form-control" type="text" value="<?php echo $fila['Estado']?>" name="Estado"><br> <!--campo para abtener el estado del operario-->
            </div>
                    
                    <input class="btn btn-warning m-3" type="submit" value="Modificar"><br> <!--Boton para enviar los cambios a la actualizacion-->
                
        </form> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>