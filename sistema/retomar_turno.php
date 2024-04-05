<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

    include('conexion.php'); #Conexión a la base de datos

    #Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Incluir archivo para obtener la variable $valsesion
    include('fecha.php'); #Incluyo el archivo para obtener la fecha en la variable $fecha_actual
#-----------------------------------INCLUDES----------------------------------------

#-----------------------------------Inicio Consulta para obtener el código de turno----------------------------------------

#Para abordar este problema de retomar turno, voy a obtener el código PK del turno filtrando por el Empacador y la fecha de está sesión

    $consultaCodTurno = "SELECT Codigo FROM tblturno WHERE Empacador = ? AND Fecha = ?"; #genero la consulta que me va a traer el codigo filtrando por los datos 
    $stmt = $con->prepare($consultaCodTurno); #Esta línea prepara la consulta SQL para su ejecución. La variable $condebe ser una instancia de conexión a la base de datos previamente establecida.
    
    $stmt->bind_param("ss", $valsesion, $fecha_actual);
    #Esta línea vincula los valores proporcionados ( $valsesiony $fecha_actual) a los marcadores de posición de la consulta preparada. En este caso, se espera que ambos valores sean cadenas ( s), por lo que "ss"se pasa como primer argumento a bind_param.
    
    $stmt->execute(); #Esta línea ejecuta la consulta preparada con los valores proporcionados anteriormente.
    
    $resultadoCodTurno = $stmt->get_result(); 
    #Esta línea obtiene el resultado de la ejecución de la consulta en forma de un conjunto de resultados. Esto permitirá acceder a las filas devueltas por la consulta más adelante en el código.

#-----------------------------------Fin Consulta para obtener el código de turno----------------------------------------


if ($resultadoCodTurno->num_rows > 0) { #Este condicional verifica si la consulta $resultadoCodTurno ha devuelto al menos una fila. Si es así, el código dentro de este bloque se ejecutará.
    $fila = $resultadoCodTurno->fetch_assoc(); #Esta línea extrae la primera fila del resultado de la consulta y la almacena en la variable $filacomo un array asociativo donde las claves son los nombres de las columnas de la tabla y los valores son los datos de esas columnas para esa fila.
    $codigoTurno = $fila['Codigo']; #Aquí se extrae el valor del campo 'Codigo' de la fila obtenida y se almacena en la variable $codigoTurno.

    echo "Código de turno: " . $codigoTurno . "<br>"; #Im´primo el codigo del turno.
    echo "Usuario: " . $valsesion . "<br>"; #Imprimo el código del usuario.
    echo "Fecha actual: " . $fecha_actual . "<br>"; #Imprimo la fecha actual

    #-------------- El campo codigo es PK-AI, Por ende necesito buscar el código más grande que tenga afiliado el codigo de turno, así garantizo que el
    #               pare que estoy actualizando sea el último que la persona en ese turno haya generado                                                   ------------------------------------------------------------------------------------------

    #-----------------------------------INICIO Consulta del último pare generado por el empacador----------------------------------------

$consultaMaxCodigo = "SELECT MAX(Codigo) AS MaximoCodigo FROM tblturnorazonpare WHERE CodTurno = ?";
$stmt = $con->prepare($consultaMaxCodigo);
$stmt->bind_param("i", $codigoTurno);
$stmt->execute();
$resultadoMaxCodigo = $stmt->get_result();

#-----------------------------------FIN Consulta del último pare generado por el empacador----------------------------------------

if ($resultadoMaxCodigo->num_rows > 0) {
    $filaMax = $resultadoMaxCodigo->fetch_assoc();
    $maxCodigo = $filaMax['MaximoCodigo']; #Imprimo el código máximo que encuentras afiliado a esta turno

    echo "Máximo código encontrado: " . $maxCodigo . "<br>";

    if (!empty($maxCodigo)) {
        #-------------------------------------INICIO ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["opcion"])) {
            $opcionSeleccionada = $_POST["opcion"];

            if ($opcionSeleccionada == "opcionSi") {
                $consultaActualizarHoraFin = "UPDATE tblturnorazonpare SET HoraFinPare = NOW() WHERE Codigo = ?";
                $stmt = $con->prepare($consultaActualizarHoraFin);
                $stmt->bind_param("i", $maxCodigo);

                if ($stmt->execute()) {
                    header("Location: ../operario/indexope.php");
                    echo "La actualización se realizó correctamente.";
                } else {
                    echo "Error al actualizar la hora de fin: " . mysqli_error($con);
                }
            } else {
                echo ("Eligió no");
            }
        }

        #-------------------------------------FIN ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------
    } else {
            echo "El número máximo de Codigo está vacío.";}
} else 
{
     echo "Error al obtener el número máximo de Codigo: " . mysqli_error($con);
}
}
$stmt->close();
$con->close();

?>