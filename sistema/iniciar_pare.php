<?php
include ('conexion.php'); #me conecto a la BD

# Verifico la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);

}

include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

#-------------------------------------INICIO ENVIO DE MOTIVO E INICIO DE PARE A LA BD----------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $opcionSeleccionada = $_POST["opcion"]; #almaceno la opcion seleccionada

    $motivoPare = $_POST["motivo"]; #almaceno el motivo del pare

    if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto la validación de cuál es el motivo de pare para hacer su respectivo insert
       
        switch($motivoPare){

            case "motivoDesayuno";

                echo("Motivo Desatuno");
                #la idea sería en este punto programar un insert variando el código con el que relaciona el pare, aparte del 'CURTIME ()' que da la fecha

                break;

            case "opcionFCanastillas";
            
                echo("Motivo Falta canastillas");

                break;

            case "opcionBandaLlena";
            
                echo("Motivo Banda llena");

                break;

            case "opcionFFlor";
            
                echo("Motivo Falta flor");

                break;

            case "opcionFMaterial";
            
                echo("Motivo Falta material");

                break;

            default:

                echo("Motivo fuera de rango");
        }
        
    


    } else {#Si elije NO

       
        header("Location: ../operario/indexope.php"); #Lo devuelvo a la página principal 
        exit; #Detengo la ejecución después de redirigirlo

    }
}
$con->close(); #Cerrar conexión
#-------------------------------------FIN ENVIO DE MOTIVO E INICIO DE PARE A LA BD----------------------------------------------------------

echo '<script>window.location.href = "../operario/turno_parado.php";</script>'; #me lo manda a la página depués de ejecutarse el código.






?>