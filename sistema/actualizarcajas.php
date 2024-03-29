<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include('conexion.php'); // Incluir el archivo de conexión
    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDE----------------------------------------
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app
    include('fecha.php'); #Incluyo este archivo para hacer uso de la variable 'fecha_actual´, está almacena el día en el que se está al abrir el aplicativo
#-----------------------------------INCLUDE----------------------------------------

#-------------------------------------INICIO ACTUALIZAR CAJAS DEL OP A LA BD----------------------------------------------------------

    $cajas = $_POST['cajas']; // Capturar el valor enviado desde el formulario

        $actualizarcaja = $con->query("UPDATE tblturno SET Cajas = $cajas 
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

