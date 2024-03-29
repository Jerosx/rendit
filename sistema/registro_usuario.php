<?php

#-----------------------------------CONEXIÓN A LA BD----------------------------------------
     include ('conexion.php'); #me conecto a la BD

     # Verifico la conexión
     if ($con->connect_error) {
     die("Conexión fallida: " . $con->connect_error);

     }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$Nombres=$_POST['Nombres'];
$Apellidos=$_POST['Apellidos'];
$Codigo=$_POST['codigo'];
$Rol=$_POST['rol'];
$Contraseña=$_POST['contraseña'];
$Estado = $_POST['estado'];

#---------INICIO ENVIO INFO A LA BD, TBLUSUARIO------------------------
     $insuser=$con->query("insert into tblusuario(Codigo,Contraseña,Nombre,Rol,Apellido, Estado) 
                         values('$Codigo','$Contraseña','$Nombres','$Rol','$Apellidos','$Estado')");

     if($insuser){
          echo"<h1> Usuario registrado con exito. </h1>";
     }
     else{
     echo"<h1> Error en el registro. </h1>";
     }

#------------FIN ENVIO INFO A LA BD, TBLUSUARIO------------------------

print "<a href='../admin/formusuario.php'> REGRESAR </a>"; #creo un botón para regresar al formulario



?>