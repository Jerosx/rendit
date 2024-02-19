<?php
    include('conexion.php'); 
    $id=$_REQUEST['id'];

    $sel=$con->query('SELECT*FROM tblusuario WHERE Codigo='.$id);
        if($fila=$sel->fetch_assoc()){

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
<body> 
    <form action="update.php" method="POST">

            <div class="id"><br> 
                <input type="hidden" value="<?php echo $fila['Codigo']?>" name="Codigo"><br></div>
       
                <div class="Contraseña"><label><h1>Contraseña</h1></label><br>
                <input type="text" value="<?php echo $fila['Contraseña']?>" name="Contraseña"><br></div>

                <div class="Nombre"><label><h1>Nombre</h1></label><br>
                <input type="text" value="<?php echo $fila['Nombre']?>"name="Nombre"><br></div>

                <div class="Rol"><label><h1>Rol</h1></label><br>
                <input type="text" value="<?php echo $fila['Rol']?>" name="Rol"><br></div>

                <div class="Apellido"><label><h1>Apellido</h1></label><br>
                <input type="text" value="<?php echo $fila['Apellido']?>" name="Apellido"><br></div>

                <div class="Estado"><label><h1>Estado</h1></label><br>
                <input type="text" value="<?php echo $fila['Estado']?>" name="Estado"><br></div>

                
                <div class="enviar"><input type="submit" value="Modificar"><br></div>
            </div>
    </forms> 
</body>