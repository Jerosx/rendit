<?php
include ('conexion.php'); #me conecto a la BD

# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);

}

include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

#-------------------------------------INICIO ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcionSeleccionada = $_POST["opcion"];

    if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto el NOW a la BD para almacenar 'HoraInicio' en 'tblturno'
       
        echo ("Eligio si");
        #AQUÍ IRÍA EL UPDATE AL CAMPO HoraFinPare de la tblturnorazonpare

    
        if ($con->query($hora) === TRUE) { #si todo sale bien

            echo "Turno Retomado";

        } else { #si algo falla

            echo "Error al retomar turno: " . $con->error;

        }

    }
}
$con->close(); #Cerrar conexión
#-------------------------------------FIN ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------

#print "<a href='../operario/indexope.php'> REGRESAR </a>"; #creo un botón para regresar al formulario