<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include('conexion.php'); #Conexión a la base de datos
    #Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Variable $valsesion
    include('fecha.php'); #Variable $fecha_actual
#-----------------------------------INCLUDES----------------------------------------

#-----------------------------------Inicio Consulta para obtener el código de turno----------------------------------------
$consultaCodTurno = "SELECT Codigo FROM tblturno WHERE Empacador = ? AND Fecha = ?";
$stmt = $con->prepare($consultaCodTurno);
$stmt->bind_param("ss", $valsesion, $fecha_actual);
$stmt->execute();
$resultadoCodTurno = $stmt->get_result();

if ($resultadoCodTurno->num_rows > 0) {
    $fila = $resultadoCodTurno->fetch_assoc();
    $codigoTurno = $fila['Codigo'];

    #echo "Código de turno: " . $codigoTurno . "<br>";
    #echo "Usuario: " . $valsesion . "<br>";
    #echo "Fecha actual: " . $fecha_actual . "<br>";

    #-----------------------------------Consulta del último pare generado por el empacador----------------------------------------
    $consultaMaxCodigo = "SELECT MAX(Codigo) AS MaximoCodigo FROM tblturnorazonpare WHERE CodTurno = ?";
    $stmt = $con->prepare($consultaMaxCodigo);
    $stmt->bind_param("i", $codigoTurno);
    $stmt->execute();
    $resultadoMaxCodigo = $stmt->get_result();

    if ($resultadoMaxCodigo->num_rows > 0) {
        $CodigoUltimoPare = $resultadoMaxCodigo->fetch_assoc();
        #echo "Código del último pare del empacador: " . $CodigoUltimoPare['MaximoCodigo'] . "<br>";

        #-----------------------------------Consulta del horaFinPare----------------------------------------
        # Asegúrate de que $CodigoUltimoPare['MaximoCodigo'] tiene un valor válido
        if (!empty($CodigoUltimoPare['MaximoCodigo'])) {
            $HorasPare = "SELECT HoraInicioPare, HoraFinPare FROM tblturnorazonpare WHERE Codigo = " . $CodigoUltimoPare['MaximoCodigo'];

            // Verificar cómo se ve la consulta antes de ejecutarla
            #echo "Consulta SQL: " . $HorasPare . "<br>";

            $resultadoHorasPare = $con->query($HorasPare);

            if ($resultadoHorasPare && $resultadoHorasPare->num_rows > 0) {
                $filaHoras = $resultadoHorasPare->fetch_assoc();
                $HoraInicioPare = $filaHoras['HoraInicioPare'];
                $HoraFinPare = $filaHoras['HoraFinPare'];

                #echo "Hora de inicio pare: " . $HoraInicioPare . "<br>";
                #echo "Hora de fin pare: " . $HoraFinPare . "<br>";

                if ($HoraFinPare == '00:00:00'){

                    #Si HoraFinPare es = a 00:00:00 es que lo tiene iniciado pero no finalizado

                    header("location:../operario/turno_parado.php"); #Si tiene el turno ya iniciado lo envio a la página indexTurno
                    exit;
                }
            } 
            else{
                #echo "No se encontraron datos del pare.<br>";
            }
        } 
        else{
            #echo "El código del último pare es inválido.<br>";
        }
    } 
    else{
        #echo "No se encontró ningún pare.<br>";
    }
} 
else {
    #echo "No se encontró ningún turno.<br>";
}

$con->close()
?>