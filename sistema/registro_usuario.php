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

          echo "<script> alert('USUARIO REGISTRADO CON EXITO');
                        window.location.href='../admin/indexadmin.php';
                    </script>";

     }
     else{

          echo "<script> alert('FALLO AL REGISTRAR EL USUARIO');
                         window.location.href='../admin/indexadmin.php';
                    </script>";

     }

#------------FIN ENVIO INFO A LA BD, TBLUSUARIO------------------------




?>