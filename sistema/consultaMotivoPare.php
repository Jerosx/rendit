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

        #-----------------------------------Consulta del Motivo de paro----------------------------------------
        if (!empty($CodigoUltimoPare['MaximoCodigo'])) {
            $CodigoUltimoPare = $CodigoUltimoPare['MaximoCodigo'];
            $MotivoParo = "SELECT CodPare FROM tblturnorazonpare WHERE Codigo = ?";
            $stmt = $con->prepare($MotivoParo);
            $stmt->bind_param("i", $CodigoUltimoPare);
            $stmt->execute();
            $resultadoMotivoParo = $stmt->get_result();

            if ($resultadoMotivoParo->num_rows > 0) {
                $filaParo = $resultadoMotivoParo->fetch_assoc();
                $CodigoParo = $filaParo['CodPare'];

                #echo "Codigo de paro: " . $CodigoParo . "<br>";

                $ConsultaNombreParo = "SELECT Nombre FROM tblrazonparo WHERE Codigo = ?";
                $stmt = $con->prepare($ConsultaNombreParo);
                $stmt->bind_param("i", $CodigoParo);
                $stmt->execute();
                $resultadoNombreParo = $stmt->get_result();

                if ($resultadoNombreParo->num_rows > 0) {

                    $filaNombreParo = $resultadoNombreParo->fetch_assoc();
                    #echo "Nombre del paro: " . $filaNombreParo['Nombre'];

                } else {

                    echo "No se encontró el nombre del paro.<br>";

                }
            } else {

                echo "No se encontraron datos del pare.<br>";

            }
        } else {

            echo "El código del último pare es inválido.<br>";

        }
    } else {

        echo "No se encontró ningún pare.<br>";

    }
} else {

    echo "No se encontró ningún turno.<br>";

}

$con->close();

?>
