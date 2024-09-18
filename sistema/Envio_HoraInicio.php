<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include('conexion.php'); #Conexión a la base de datos
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Variable $valsesion
    include('fecha.php'); #Variable $fecha_actual
#-----------------------------------INCLUDES----------------------------------------


    #-----------------------------------Consulta para obtener el código de turno----------------------------------------
    $consultaCodTurno = "SELECT Codigo FROM tblturno WHERE Empacador = ? AND Fecha = ?";
    $stmt = $con->prepare($consultaCodTurno);
    $stmt->bind_param("ss", $valsesion, $fecha_actual);
    $stmt->execute();
    $resultadoCodTurno = $stmt->get_result();

    if ($resultadoCodTurno->num_rows > 0) {
        $fila = $resultadoCodTurno->fetch_assoc();
        $codigoTurno = $fila['Codigo'];

        //echo "Código de turno: " . $codigoTurno . "<br>";

        #-----------------------------------Consulta del último pare generado por el empacador----------------------------------------
        $consultaMaxCodigo = "SELECT MAX(Codigo) AS MaximoCodigo FROM tblturnorazonpare WHERE CodTurno = ?";
        $stmt = $con->prepare($consultaMaxCodigo);
        $stmt->bind_param("i", $codigoTurno);
        $stmt->execute();
        $resultadoMaxCodigo = $stmt->get_result();

        if ($resultadoMaxCodigo->num_rows > 0) {
            $CodigoUltimoPare = $resultadoMaxCodigo->fetch_assoc();

            //echo "Código del último pare del empacador: " . $CodigoUltimoPare['MaximoCodigo'] . "<br>";

            if (!empty($CodigoUltimoPare['MaximoCodigo'])) {
                $HorasPare = "SELECT HoraInicioPare, HoraFinPare FROM tblturnorazonpare WHERE Codigo = " . $CodigoUltimoPare['MaximoCodigo'];

                //echo "Consulta SQL: " . $HorasPare . "<br>";

                $resultadoHorasPare = $con->query($HorasPare);

                if ($resultadoHorasPare && $resultadoHorasPare->num_rows > 0) {
                    $filaHoras = $resultadoHorasPare->fetch_assoc();
                    $HoraInicioPare = $filaHoras['HoraInicioPare'];
                    $HoraFinPare = $filaHoras['HoraFinPare'];

                    //echo "Hora de inicio pare: " . $HoraInicioPare . "<br>";
                    //echo "Hora de fin pare: " . $HoraFinPare . "<br>";

                    #---Convertimos los datos a formato JSON---
                    $horasPareArray = array(
                        "HoraInicioPare" => $HoraInicioPare,
                        "HoraFinPare" => $HoraFinPare
                    );

                    # Establecemos la cabecera para JSON
                    header('Content-Type: application/json');
                    
                    # Enviamos el JSON como respuesta
                    echo json_encode($horasPareArray);
                    exit;
                }
            }
        }
    }

    # Si no se encuentran resultados o hay un error, devolver un JSON vacío o un mensaje de error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se encontraron datos']);
    exit;
$con->close();





?>