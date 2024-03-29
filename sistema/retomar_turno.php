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

    echo "Código de turno: " . $codigoTurno . "<br>"; #Este es un mensaje de depuración que imprime en pantalla el código de turno recuperado. Es útil para verificar que el código se haya obtenido correctamente.


    #-------------- El campo codigo es PK-AI, Por ende necesito buscar el código más grande que tenga afiliado el codigo de turno, así garantizo que el
    #               pare que estoy actualizando sea el último que la persona en ese turno haya generado                                                   ------------------------------------------------------------------------------------------

    #-----------------------------------INICIO Consulta del último pare generado por el empacador----------------------------------------

    $consultaMaxCodigo = "SELECT MAX(Codigo) AS MaximoCodigo FROM tblturnorazonpare WHERE CodPare = ?";
    #Esta línea define una consulta SQL que selecciona el valor máximo del campo 'Codigo' de la tabla 'tblturnorazonpare' y lo asigna al alias 'MaximoCodigo', filtrando los resultados por el valor de 'CodPare' que se pasará como parámetro más adelante.
    
    $stmt = $con->prepare($consultaMaxCodigo); #Prepare la consulta SQL para su ejecución. La variable $condebe ser una instancia de conexión a la base de datos previamente establecida.
    $stmt->bind_param("i", $codigoTurno); #Vincula el valor de $codigoTurnoal marcador de posición de la consulta preparada. Se espera que el valor sea un entero ( i), por lo que se utiliza como segundo argumento de bind_param.
    $stmt->execute(); #Ejecuta la consulta preparada.
    $resultadoMaxCodigo = $stmt->get_result(); #Obtiene el resultado de la ejecución de la consulta. Esto devuelve un conjunto de resultados que contiene el valor máximo del campo 'Codigo' bajo el alias 'MaximoCodigo', filtrado por el valor de 'CodPare' proporcionado.

    #-----------------------------------FIN Consulta del último pare generado por el empacador----------------------------------------

    
    if ($resultadoMaxCodigo->num_rows > 0) { #Este condicional verifica si la consulta devolvió al menos una fila, lo que significa que se encontraron resultados.
        $filaMax = $resultadoMaxCodigo->fetch_assoc(); #Extrae la primera fila del resultado de la consulta y la almacena en la variable $filaMaxcomo un array asociativo.
        $maxCodigo = $filaMax['MaximoCodigo']; #Obtiene el valor del campo 'MaximoCodigo' de la fila obtenida y lo almacena en la variable $maxCodigo.

        echo "Máximo código encontrado: " . $maxCodigo . "<br>"; #Este es un mensaje de purificación que imprime en pantalla el código máximo encontrado.

        if (!empty($maxCodigo)) { #Esta condicional verifica si el valor de $maxCodigono está vacío.

            #-------------------------------------INICIO ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["opcion"])) {
                    $opcionSeleccionada = $_POST["opcion"];

                    if ($opcionSeleccionada == "opcionSi") { #Este condicional verifica si la variable $opcionSeleccionadaes igual a la cadena "opcionSi". Si esto es cierto, significa que el usuario eligió la opción "Si".

                        #---------Actualización del campo HoraFinPare utilizando NOW() para el número máximo encontrado------------------

                        $consultaActualizarHoraFin = "UPDATE tblturnorazonpare SET HoraFinPare = NOW() WHERE CodPare = ? AND Codigo = ?";
                        #Esta línea define una consulta SQL para actualizar el campo 'HoraFinPare' en la tabla 'tblturnorazonpare' utilizando la función NOW()de MySQL para establecer la hora actual como valor del campo. La actualización se aplica a las filas donde el campo 'CodPare' sea igual a $codigoTurnoy el campo 'Codigo' sea igual a $maxCodigo.
                        
                        $stmt = $con->prepare($consultaActualizarHoraFin);#Prepare la consulta SQL para su ejecución.
                        $stmt->bind_param("ii", $codigoTurno, $maxCodigo);
                        #Vincula los valores de $codigoTurnoy $maxCodigoa los marcadores de posición de la consulta preparada. Ambos valores se esperan como enteros ( i), por lo que se utilizan dos "i"s como primer argumento de bind_param.
                        
                        if ($stmt->execute()) { #Esta condicional verifica si la ejecución de la consulta preparada fue exitosa. Si es así, significa que la actualización se realizó correctamente.
                            
                            echo "La actualización se realizó correctamente."; #Si la actualización se realiza con éxito, se muestra este mensaje.
                            header("Location: ../operario/indexope.php"); #Lo devuelvo a la página principal del op

                        } else {
                            echo "Error al actualizar la hora de fin: " . mysqli_error($con); #Si la ejecución de la consulta preparada no es exitosa, se muestra un mensaje de error junto con el mensaje de error proporcionado por MySQL.
                        }
                    } else {
                        echo ("Eligió no"); #Imprimo si elije que no para validar que el if funcione, más uso como tal no tendrá, ayq ue si recargo la página el cronometro que está allá se reiniciaría
                    }
                }

            #-------------------------------------FIN ENVIO DE HORAFINPARE A LA BD----------------------------------------------------------

        } else {
            echo "El número máximo de Codigo está vacío."; #Si el valor de $maxCodigoestá vacío, se muestra este mensaje.
        }
    } else {
        echo "Error al obtener el número máximo de Codigo: " . mysqli_error($con); #Si ocurre un error al obtener el código máximo, se muestra este mensaje junto con el mensaje de error proporcionado por MySQL.
    }
} else {
    echo "No se encontraron registros para el empacador actual."; #Si la consulta no devuelve ninguna fila, lo que significa que no se encontraron registros para el empacador actual, se muestra este mensaje.
}

$stmt->close(); #Cerrar la consulta preparada
$con->close(); #Cerrar la conexión

?>