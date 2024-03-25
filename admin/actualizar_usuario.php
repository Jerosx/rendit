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
    <link rel="stylesheet" href="../diseño/style.css">
    <title>Actualizar datos Operarios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="login"> 
    <form class="myForm" action="../sistema/update.php" method="POST">

            <div class="id"><br> 
                <input type="hidden" value="<?php echo $fila['Codigo']?>" name="Codigo"><br></div> <!--campo oculto para enviar el codigo a la actualizacion-->
       
                <div class="Contraseña"><label><h1>Contraseña</h1></label><br>
                <input type="text" value="<?php echo $fila['Contraseña']?>" name="Contraseña"><br></div> <!--campo para abtener la contraseña-->

                <div class="Nombre"><label><h1>Nombre</h1></label><br>
                <input type="text" value="<?php echo $fila['Nombre']?>"name="Nombre"><br></div> <!--campo para abtener el nombre-->

                <div class="Rol"><label><h1>Rol</h1></label><br>
                <input type="text" value="<?php echo $fila['Rol']?>" name="Rol"><br></div> <!--campo para abtener el rol-->

                <div class="Apellido"><label><h1>Apellido</h1></label><br>
                <input type="text" value="<?php echo $fila['Apellido']?>" name="Apellido"><br></div> <!--campo para abtener los apellidos-->

                <div class="Estado"><label><h1>Estado</h1></label><br>
                <input type="text" value="<?php echo $fila['Estado']?>" name="Estado"><br></div> <!--campo para abtener el estado del operario-->

                
                <input class="login-but" type="submit" value="Modificar"><br> <!--Boton para enviar los cambios a la actualizacion-->
            </div>
    </forms> 
</body>