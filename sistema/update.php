<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$id=$_POST['Codigo']; // Obtenemos los valores enviados por el formulario mediante el método POST
$Contraseña=$_POST['Contraseña'];// Obtenemos la contraseña del formulario mediante el método POST
$Nombre=$_POST['Nombre']; // Obtenemos el nombre del formulario mediante el método POST
$Rol=$_POST['Rol']; // Obtenemos el rol del formulario mediante el método POST
$Apellido=$_POST['Apellido']; // Obtenemos el apellido del formulario mediante el método POST
$Estado=$_POST['Estado']; // Obtenemos el estado del formulario mediante el método POST

#----------------------------------INICIO ENVIO INFO A LA BD-----------------------------------------------------

    $up=$con->query("UPDATE tblusuario SET ## se realiza la consulta a la BD para realizar actualización
                    Contraseña='$Contraseña',
                    Nombre='$Nombre',
                    Rol='$Rol',
                    Apellido='$Apellido',
                    Estado='$Estado'
        WHERE Codigo='$id' ");
    // se verifica si la consulta es exitosa
    if($up){
        header('location:../admin/indexadmin.php');
    }
    else{
        header('location:../admin/actualizar_usuario.php');
    }
#----------------------------------FIN ENVIO INFO A LA BD-----------------------------------------------------
?>