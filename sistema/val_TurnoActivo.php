<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('fecha.php');
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app
#-----------------------------------INCLUDES----------------------------------------

$consulta_TurnoActivo = "SELECT HoraInicio FROM tblturno WHERE DATE(Fecha) = '$fecha_actual' AND Empacador = '$valsesion'"; #Consulto si tiene turno iniciado en el día
$resultadoTurno = $con->query($consulta_TurnoActivo); #almaceno resultado en variable $resultadoTurno

$consulta_TurnoFinalizado = "SELECT HoraFin FROM tblturno WHERE DATE(Fecha) = '$fecha_actual' AND Empacador = '$valsesion'";
$resultadoFinTurno = $con->query($consulta_TurnoFinalizado);

#-----------------------------------VALIDACIÓN DATOS CONSULTA----------------------------------------

    if ($resultadoFinTurno && $resultadoFinTurno->num_rows > 0) #Revisamos si la consulta devuelve un valor antes de almacenarlo
    {
        $fila = $resultadoFinTurno->fetch_assoc();
        $horaFin = $fila['HoraFin']; #almacenamos el valor de 'HoraFin' en la variable $horaFin
    } 
    else 
    {
        
        $horaFin = ''; #Queda vacia 
    }
#-----------------------------------VALIDACIÓN DATOS CONSULTA----------------------------------------

    #echo "Op: " . $valsesion . "<br>"; #mensajes para depuración                -----------------------------\
    #echo "fecha: " . $fecha_actual . "<br>"; #mensajes para depuración               ------------------------  > MANTENER COMENTADO A MENOS QUE SE NECESITE REVISAR (Aparece en la pág)
    #echo "Número de filas (Inicio turno): " . $resultadoTurno->num_rows . "<br>"; #mensajes para depuración--/
    #echo "Hora fin: ". $horaFin; #---------------------------------------------------------------------------/


if($resultadoTurno->num_rows > 0 && $horaFin == '00:00:00') #Si el número de filas devueltas por la consulta es > (mayor) a 0, la persona ya tiene un turno iniciado en este dia
{
    
    #echo "Turno iniciado pero no ha finalizado";
    header("location:../operario/indexTurno.php"); #Si tiene el turno ya iniciado lo envio a la página indexTurno
    exit;

}
else
{
    #echo "Turno sin iniciar ";
}

$con->close()
?>