<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
include ('conexion.php'); # me conecto a la BD

# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$motivo = mb_strtoupper($con->real_escape_string($_POST['Nombre']));
echo $motivo . "<br>";

# Reviso si en la bd no hay un motivo que se llame igual 
$motivoSistema = "SELECT Nombre FROM tblrazonparo WHERE Nombre = '$motivo'";
$resultadoMotivos = $con->query($motivoSistema);

if ($resultadoMotivos) #si la consulta fue exitosa...
{
    if ($resultadoMotivos->num_rows > 0) #si el numrows es mayor a 0, es que ese nombre ya está en la bd
    {
        echo "<script> 
                alert('EL MOTIVO DE PARO YA ESTÁ REGISTRADO');  
                window.location.href='../admin/indexadmin.php';  
              </script>";
    } 
    else #Si numrows no es mayor a 0 es que no encontro un motivo con ese nombre
    {
        
        $consulta = $con->query("INSERT INTO tblrazonparo (Codigo, Nombre) 
                                VALUES ('', '$motivo')");# Inserto el nuevo motivo

        if ($consulta) #si la consulta sale bien
        {
            echo "<script> 
                    alert('MOTIVO DE PARO REGISTRADO EXITOSAMENTE');  
                    window.location.href='../admin/indexadmin.php';  
                  </script>";
        } 
        else #si falla la consulta
        {
            echo "<script> 
                    alert('FALLO AL REGISTRAR MOTIVO DE PARO');  
                    window.location.href='../admin/indexadmin.php';  
                  </script>";
            echo $con->error;
        }
    }
} 
else #manejo de error en busqueda de motivos en la bd
{
    echo "Error en la consulta: " . $con->error;
}
?>







?>