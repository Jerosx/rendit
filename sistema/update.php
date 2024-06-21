<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$id = mb_strtoupper($_POST['Codigo']);// Obtenemos los valores enviados por el formulario mediante el método POST
$Contrasena = mb_strtoupper($_POST['Contrasena']);// Obtenemos la contraseña del formulario mediante el método POST
$Nombre = mb_strtoupper($_POST['Nombre']); // Obtenemos el nombre del formulario mediante el método POST
$Rol=$_POST['Rol']; // Obtenemos el rol del formulario mediante el método POST
$Apellido = mb_strtoupper($_POST['Apellido']); // Obtenemos el apellido del formulario mediante el método POST
$Estado=$_POST['Estado']; // Obtenemos el estado del formulario mediante el método POST

#----------------------------------INICIO ENVIO INFO A LA BD-----------------------------------------------------

    $up=$con->query("UPDATE tblusuario SET ## se realiza la consulta a la BD para realizar actualización
                    Contrasena='$Contrasena',
                    Nombre='$Nombre',
                    Rol='$Rol',
                    Apellido='$Apellido',
                    Estado='$Estado'
        WHERE Codigo='$id' ");
    // se verifica si la consulta es exitosa
    if($up){

        echo "<script> alert('DATOS ACTUALIZADOS');
                        window.location.href='../admin/indexadmin.php';
            </script>";

    }
    else{

        "<script> alert('FALLO AL ACTUALIZAR DATOS');
                        window.location.href='../admin/indexadmin.php';
        </script>";
        
    }
#----------------------------------FIN ENVIO INFO A LA BD-----------------------------------------------------
?>