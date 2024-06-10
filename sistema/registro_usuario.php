<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
include ('conexion.php'); # me conecto a la BD

# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

# Obtengo los datos del formulario y los convierto a mayúsculas
$Nombres = strtoupper($_POST['Nombres']);
$Apellidos = strtoupper($_POST['Apellidos']);
$Codigo = strtoupper($_POST['codigo']);
$Rol = strtoupper($_POST['rol']);
$Contrasena = strtoupper($_POST['contrasena']);

#-------------inicio envio de la base de datos-----------#
switch($Rol) {  // este switch hace la llamada a rol donde puede escoger si es administrador o operario

    case "1": // este caso muestra el registro de inicio del administrador

        echo ("Eligió Administrador"); // muestra cuando eligió el administrador

        #------hace la llamada a la base de datos indicando que escogió el rol administrador--------#
        $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contrasena, Nombre, Rol, Apellido, Estado) 
                   VALUES('$Codigo', '$Contrasena', '$Nombres', 1, '$Apellidos', 1)");  

        if($insuser) {
            #-----------------el script muestra una ventana donde el administrador se registró con éxito----------------#
            echo "<script> alert('ADMINISTRADOR REGISTRADO EXITOSAMENTE');  
                       window.location.href='../admin/indexadmin.php';  
                  </script>";
        } else {
            #-------------------muestra fallos al registrar en la sesión administrador --------------#
            echo "<script> alert('FALLO AL REGISTRAR');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
            echo $con->error;
        }

        break; // rompe la consulta

    case "2": // muestra el registro de operario 

        echo ("Eligió operario"); // mensaje de aceptación que eligió operario

        #-------hace la llamada en la base de datos indicando que escogió el rol de operario-------#
        $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contrasena, Nombre, Rol, Apellido, Estado) 
                   VALUES('$Codigo', '$Contrasena', '$Nombres', 2, '$Apellidos', 1)"); // guarda el registro de operario con el rol 2 y lo guarda con el estado 1 

        if($insuser) {
            #------------muestra un mensaje donde el operario se registró correctamente--------#
            echo "<script> alert('OPERARIO REGISTRADO EXITOSAMENTE');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
        } else {
            #-----------------muestra fallos al registrar el rol de operario----------#
            echo "<script> alert('FALLO AL REGISTRAR');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
            echo $con->error;
        }
        
        break; // rompe la consulta del rol de operario

    default:
        echo "<script> alert('ROL NO VÁLIDO');
                   window.location.href='../admin/indexadmin.php';
              </script>";
        break; // rompe si el rol no es válido
}
#-------------fin envío de la base de datos-----------#

?>


/*#-----------------------------------CONEXIÓN A LA BD----------------------------------------
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
     switch($Rol){  // este switch hace la llamada a rol donde puede escoger si es administrador o operario.

          case "Administrador"; // este caso muestra el registro de inicio del administrador

               echo ("Eligio Administrador"); // muetra cuando eligio el administrador.

          #------hace la llamada a la base de datos indicando que escogio el rol administrador--------#
               $insuser=$con->query("insert into tblusuario(Codigo,Contraseña,Nombre,Rol,Apellido, Estado) 
                         values('$Codigo','$Contraseña','$Nombres', 1 ,'$Apellidos',1 )");  

                    if($insuser){
        #-----------------el scrript muestra una ventana donde el administrador se registro con exito----------------#
                         echo "<script> alert('ADMINISTRADOR REGISTRADO EXITOSAMENTE');  
                                   window.location.href='../admin/indexadmin.php';  
                              </script>";

                    }
                    else{
       #-------------------muestra fallos al registrar en la session administrador --------------#
                         echo "<script> alert('FALLO AL REGISTRAR');
                                   window.location.href='../admin/indexadmin.php';
                              </script>"; $con->error;
                    }

                    break; // rompe la consulta

               break; // rompe el if mostrando el registro con exito.
     
          case  "Operario"; // muestra el registro de operario 

              echo ("Eligio operario"); // mensaje de de aceptacion que eligio operario

           #-------hace la llamada en la base de datos indicando que escogio el rol de operario-------#
              $insuser=$con->query("insert into tblusuario(Codigo,Contraseña,Nombre,Rol,Apellido, Estado) 
              values('$Codigo','$Contraseña','$Nombres', 2 ,'$Apellidos',1 )"); // guarda el registro de operario con el rol 2 y lo guarda con el estado 1 

                    if($insuser){
         #------------muestra un mensaje donde el operario se registro correctamente--------#
                         echo "<script> alert('OPERARIO REGISTRADO EXITOSAMENTE');
                                   window.location.href='../admin/indexadmin.php';
                              </script>";

                    }
                    else{
       #-----------------muestra fallos al registar el rol de operario----------#
                         echo "<script> alert('FALLO AL REGISTRAR');
                                    window.location.href='../admin/indexadmin.php';
                              </script>"; $con->error;

                    }
                    break; // rompe la consulta del  rol de operario.

               break; // rompe el if mostrando el registro con exitos.
     }

#-------------fin envio de la base de datos-----------#

?>












#-----------------------------------CONEXIÓN A LA BD----------------------------------------
include ('conexion.php'); # me conecto a la BD

# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

# Obtengo los datos del formulario y los convierto a mayúsculas
$Nombres = strtoupper($_POST['Nombres']);
$Apellidos = strtoupper($_POST['Apellidos']);
$Codigo = strtoupper($_POST['codigo']);
$Rol = strtoupper($_POST['rol']);
$Contraseña = strtoupper($_POST['contraseña']);

#-------------inicio envio de la base de datos-----------#
switch($Rol) {  // este switch hace la llamada a rol donde puede escoger si es administrador o operario

    case "ADMINISTRADOR": // este caso muestra el registro de inicio del administrador

        echo ("Eligió Administrador"); // muestra cuando eligió el administrador

        #------hace la llamada a la base de datos indicando que escogió el rol administrador--------#
        $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contraseña, Nombre, Rol, Apellido, Estado) 
                   VALUES('$Codigo', '$Contraseña', '$Nombres', 1, '$Apellidos', 1)");  

        if($insuser) {
            #-----------------el script muestra una ventana donde el administrador se registró con éxito----------------#
            echo "<script> alert('ADMINISTRADOR REGISTRADO EXITOSAMENTE');  
                       window.location.href='../admin/indexadmin.php';  
                  </script>";
        } else {
            #-------------------muestra fallos al registrar en la sesión administrador --------------#
            echo "<script> alert('FALLO AL REGISTRAR');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
            echo $con->error;
        }

        break; // rompe la consulta

    case "OPERARIO": // muestra el registro de operario 

        echo ("Eligió operario"); // mensaje de aceptación que eligió operario

        #-------hace la llamada en la base de datos indicando que escogió el rol de operario-------#
        $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contraseña, Nombre, Rol, Apellido, Estado) 
                   VALUES('$Codigo', '$Contraseña', '$Nombres', 2, '$Apellidos', 1)"); // guarda el registro de operario con el rol 2 y lo guarda con el estado 1 

        if($insuser) {
            #------------muestra un mensaje donde el operario se registró correctamente--------#
            echo "<script> alert('OPERARIO REGISTRADO EXITOSAMENTE');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
        } else {
            #-----------------muestra fallos al registrar el rol de operario----------#
            echo "<script> alert('FALLO AL REGISTRAR');
                       window.location.href='../admin/indexadmin.php';
                  </script>";
            echo $con->error;
        }
        
        break; // rompe la consulta del rol de operario

    default:
        echo "<script> alert('ROL NO VÁLIDO');
                   window.location.href='../admin/indexadmin.php';
              </script>";
        break; // rompe si el rol no es válido
}
#-------------fin envío de la base de datos-----------#

