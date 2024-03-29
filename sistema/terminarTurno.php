<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

    include('fecha.php'); #Incluyo este archivo para hacer uso de la variable 'fecha_actual´, está almacena el día en el que se está al abrir el aplicativo

#-----------------------------------INCLUDES----------------------------------------

#-------------------------------------INICIO ENVIO DE NOW A LA BD----------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcionSeleccionada = $_POST["opcion"];

        if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto el NOW a la BD para almacenar 'HoraInicio' en 'tblturno'
        

            $hora =("UPDATE tblturno SET HoraFin = NOW() 
                                    WHERE Empacador = '$valsesion'
                                    AND Fecha = '$fecha_actual'"); #Actualizo el campo HoraFin filtrando por el operario con la sesión y por la fecha del día

        
            if ($con->query($hora) === TRUE) { #si todo sale bien

                echo "Turno finalizado";

            } else { #si algo falla

                echo "Error al Finalizar turno: " . $con->error;

            }

        } else {#Si elije NO

        
            header("Location: ../operario/indexope.php"); #Lo devuelvo a la página principal 
            exit; #Detengo la ejecución después de redirigirlo

        }
    }
    $con->close(); #Cerrar conexión
#-------------------------------------FIN ENVIO DE NOW A LA BD----------------------------------------------------------
print "<a href='../operario/indexope.php'> REGRESAR </a>"; #creo un botón para regresar al formulario
?>