<?php
session_start();
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); # me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

# Obtengo los datos del formulario y los convierto a mayúsculas
$Nombres = mb_strtoupper($_POST['Nombres']);
$Apellidos = mb_strtoupper($_POST['Apellidos']);
$Codigo = mb_strtoupper($_POST['codigo']);
$Rol = mb_strtoupper($_POST['rol']);
$Contrasena = $_POST['contrasena'];

#---------consulta codigos personales creados-----------

    $codigosRegistrados = $con->query("SELECT Codigo FROM tblusuario WHERE Codigo = '$Codigo'");

#---------consulta codigos personales creados-----------

if($codigosRegistrados) #Si se ejecuta la consulta
{
    if($codigosRegistrados->num_rows > 0) #si el número de rows es mayor a 0 es que ya está registrado
    {
        $_SESSION["codigo"]=true;
        header("location:../admin/estadisticasGeneral.php");
        /* echo "<script> 
                    alert('EL CODIGO PERSONAL INGRESADO YA ESTÁ REGISTRADO EN EL SISTEMA');  
                    window.location.href='../admin/indexadmin.php';  
                </script>";
        exit; */
    }
    else #si num rows es menor a 0, es que no esta registrado
    {
        #-------------inicio envio de la base de datos-----------#
        switch($Rol) {  // este switch hace la llamada a rol donde puede escoger si es administrador o operario

            case "1": // es administrador

                echo ("Eligió Administrador"); //mensaje depuración

                #------hace la llamada a la base de datos indicando que escogió el rol administrador--------#
                $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contrasena, Nombre, Rol, Apellido, Estado) 
                        VALUES('$Codigo', '$Contrasena', '$Nombres', 1, '$Apellidos', 1)");  

                if($insuser) {
                    #-----------------el script muestra una ventana donde el administrador se registró con éxito----------------#
                    
                    $_SESSION["adminRe"]=true;
                    header("location:../admin/estadisticasGeneral.php");
                    /* echo "<script> alert('ADMINISTRADOR REGISTRADO EXITOSAMENTE');  
                            window.location.href='../admin/indexadmin.php';  
                        </script>"; */
                } else {
                    #-------------------muestra fallos al registrar en la sesión administrador --------------#
                    echo "<script> alert('FALLO AL REGISTRAR');
                            window.location.href='../admin/?> estadisticasGeneral.php';
                        </script>";
                    echo $con->error;
                }

                break; // rompe la consulta

            case "2": // es operario 

                echo ("Eligió operario"); // mensaje de depuración

                #-------hace la llamada en la base de datos indicando que escogió el rol de operario-------#
                $insuser = $con->query("INSERT INTO tblusuario(Codigo, Contrasena, Nombre, Rol, Apellido, Estado) 
                        VALUES('$Codigo', '$Contrasena', '$Nombres', 2, '$Apellidos', 1)"); // guarda el registro de operario con el rol 2 y lo guarda con el estado 1 

                if($insuser) {
                    #------------muestra un mensaje donde el operario se registró correctamente--------#
                      
                    $_SESSION["operarioRe"]=true;
                    header("location:../admin/estadisticasGeneral.php");
                  /*   echo "<script> alert('OPERARIO REGISTRADO EXITOSAMENTE');
                            window.location.href='../admin/indexadmin.php';
                        </script>";  */
                } else {
                    #-----------------muestra fallos al registrar el rol de operario----------#
                    echo "<script> alert('FALLO AL REGISTRAR');
                            window.location.href='../admin/?> estadisticasGeneral.php';
                        </script>";
                    echo $con->error;
                }
                
                break; // rompe la consulta del rol de operario

            default:
                echo "<script> alert('ROL NO VÁLIDO');
                        window.location.href='../admin/estadisticaGeneral.php';
                    </script>";
                break; // rompe si el rol no es válido
        }
        #-------------fin envío de la base de datos-----------#
    }

}
$con->close();
?>