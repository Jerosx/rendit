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

#-------------------------------------INICIO SUMAR CAJAS A LA BD----------------------------------------------------------

    $sumarCaja = $con->query("UPDATE tblturno
                                SET Cajas = Cajas + 1
                                WHERE Empacador = '$valsesion'
                                AND Fecha = '$fecha_actual'"); #Creo la consulta que le suma 1 a la cantidad de cajas que hay filtrando por empacador y fecha del día
        
        if($sumarCaja === TRUE) #Valido que todo salga bien
        {
            echo "Caja sumada"; #mensaje depuración
            header ("location: ../operario/indexTurno.php"); #lo devuelvo al index directamente
            exit(); #detengo la ejecución del script
        }
        else
        {
            echo "Error al sumar la caja" . $con->error; #mensaje depuración
            header ("location: ../operario/indexTurno.php");#lo devuelvo al index directamente
        }

#-------------------------------------FIN SUMAR CAJAS A LA BD----------------------------------------------------------
$con->close(); #cierro la conexión a la bd
?>