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

#-------------------------------------INICIO VALIDAR QUE CAJAS NO SEA - A 0----------------------------------------------------------

    $cajas = "SELECT Cajas FROM tblturno WHERE (Fecha) = '$fecha_actual' AND Empacador = '$valsesion'"; #Genero una consulta para bsucar cuantas cajas tiene registrado el turno
    $resultadoCajas = $con->query($cajas);
        
        if ($resultadoCajas) #Si se ejecuta la consulta
        {
            
            if ($fila = $resultadoCajas->fetch_assoc()) #Si se encuentra al menos un resultado 
            {

                $cajasEncontradas = $fila['Cajas']; #almaceno la cantidad en la variable cajasEncontradas
                echo $cajasEncontradas; #mensaje para depuracion

            } 
            else #manejo de posible error
            {

                echo "No se encontraron resultados.";

            }
        } 
        else #manejo de error en consulta
        {
            
            echo "Error en la consulta: " . $con->error;
            
        }

#-------------------------------------FIN VALIDAR QUE CAJAS NO SEA - A 0----------------------------------------------------------

#-------------------------------------INICIO RESTAR CAJAS A LA BD----------------------------------------------------------

    if($cajasEncontradas>0)
    {
        $restarCaja = $con->query("UPDATE tblturno
                                    SET Cajas = Cajas - 1
                                    WHERE Empacador = '$valsesion'
                                    AND Fecha = '$fecha_actual'"); #Creo la consulta que le resta 1 a la cantidad de cajas que hay filtrando por empacador y fecha del día
            
            if($restarCaja === TRUE) #Valido que todo salga bien
            {
                echo "Caja restada"; #mensaje depuración
                header ("location: ../operario/indexTurno.php"); #lo devuelvo al index directamente
                exit(); #detengo la ejecución del script
            }
            else
            {
                echo "Error al restar la caja" . $con->error; #mensaje depuración
                header ("location: ../operario/indexTurno.php"); #lo devuelvo al index directamente
            }
    }
    else
    {
        echo "No se puede tener valores negativos en este campo"; #depuracion 
        header ("location: ../operario/indexTurno.php"); #lo devuelvo al index directamente
    }

#-------------------------------------FIN RESTAR CAJAS A LA BD----------------------------------------------------------
$con->close(); #cierro la conexión a la bd
?>

