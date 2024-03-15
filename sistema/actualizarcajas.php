<?php
include('conexion.php'); // Incluir el archivo de conexión
# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);

}
include('validar_sesion.php');
#include('fecha.php'); HABILITAR ESTE COMENTARIO UNA VEZ FINALIZADO EL PROCESO DE PROGRAMACIÓN (#Incluyo este archivo para hacer uso de la variable 'fecha_actual´, está almacena el día en el que se está al abrir el aplicativo)

$fecha_actual='2023-07-23'; #ELIMINAR ESTÁ VARIABLE UNA VEZ TERMINADO EL PROCESO DE PROGRAMACIÓN

#-------------------------------------INICIO ACTUALIZAR CAJAS DEL OP A LA BD----------------------------------------------------------

$cajas = $_POST['cajas']; // Capturar el valor enviado desde el formulario

    $actualizarcaja = $con->query("UPDATE tblturno SET Cajas = '$cajas' 
                                WHERE Empacador = '$valsesion'
                                AND Fecha = '$fecha_actual'"); #Actualizo las cajas filtrando por el operario con la sesión y por la fecha del día

        if ($actualizarcaja === TRUE) { #Si sale bien 

            echo "Cajas actualizada correctamente.";

        } else { #Si sale mal mostrar el error

            echo "Error al actualizar la caja: " . $con->error;

        }
   
    mysqli_close($con); #Cierro la conexión
#-------------------------------------FIN ACTUALIZAR CAJAS DEL OP A LA BD----------------------------------------------------------

print "<a href='../operario/indexope.php'> REGRESAR </a>"; #creo un botón para regresar al formulario
?>

