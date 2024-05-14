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


#-------------inicio envio de la base de datos-----------#
     switch($Rol){

          case "Administrador";

               echo ("Eligio Administrador");
               
               $insuser=$con->query("insert into tblusuario(Codigo,Contraseña,Nombre,Rol,Apellido, Estado) 
                         values('$Codigo','$Contraseña','$Nombres', 1 ,'$Apellidos',1 )");

                    if($insuser){
                         echo"<h1> Usuario registrado con exito. </h1>";
                    }
                    else{
                    echo"<h1> Error en el registro. </h1>";
                    }
                    break;

               break;
     
          case  "Operario";

              echo ("Eligio operario");
           
              $insuser=$con->query("insert into tblusuario(Codigo,Contraseña,Nombre,Rol,Apellido, Estado) 
              values('$Codigo','$Contraseña','$Nombres', 1 ,'$Apellidos',1 )");

                    if($insuser){
                         echo"<h1> Usuario registrado con exito. </h1>";
                    }
                    else{
                    echo"<h1> Error en el registro. </h1>";
                    }
                    break;

               break; 
     }

     print "<a href='../admin/formusuario.php'> REGRESAR </a>"; #creo un botón para regresar al formulario

#-------------fin envio de la base de datos-----------#
/*
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

*/

?>