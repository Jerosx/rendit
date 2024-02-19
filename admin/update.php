<?php

include('conexion.php'); //Conexión a la BD 

// Obtenemos los valores enviados por el formulario mediante el método POST
    $id=$_POST['Codigo'];
    $Contraseña=$_POST['Contraseña'];
    $Nombre=$_POST['Nombre'];
    $Rol=$_POST['Rol'];
    $Apellido=$_POST['Apellido'];
    $Estado=$_POST['Estado'];

$up=$con->query("UPDATE tblusuario SET ## se realiza la consulta a la BD para realizar actualización
                Contraseña='$Contraseña',
                Nombre='$Nombre',
                Rol='$Rol',
                Apellido='$Apellido',
                Estado='$Estado'
    WHERE Codigo='$id' ");
// se verifica si la consulta es exitosa
if($up){
    header('location:indexadmin.php');
}
else{
    header('location:actualizar.php');
}

?>