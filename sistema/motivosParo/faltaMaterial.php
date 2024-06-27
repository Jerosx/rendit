<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('../conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
#-----------------------------------INCLUDES----------------------------------------
    include('../validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

    include('../fecha.php'); #Incluyo el archivo que contiene la fecha del día
#-----------------------------------INCLUDES----------------------------------------

#echo "Falta material"; #mensaje depuración

#-------------------------------------INICIO CONSULTA CODIGO PK DEL TURNO EN BASE A EMPACADOR Y FECHA ------------------------------------------------------

$codTurno = $con->query("SELECT Codigo FROM tblturno WHERE Empacador = $valsesion AND Fecha = '$fecha_actual'");
if ($codTurno) {
    $row = $codTurno->fetch_assoc();
    $codigoTurno = $row['Codigo'];

    #-------------------------------------CÓDIGO POR SI SE NECESITA VALIDAR EL CÓDIGO DE TURNO QUE ESTÁ TRAYENDO LA CONSULTA----------------------------------------------------------
    # echo $codigoTurno; // Imprimir el valor de una columna específica
    #-------------------------------------CÓDIGO POR SI SE NECESITA VALIDAR EL CÓDIGO DE TURNO QUE ESTÁ TRAYENDO LA CONSULTA----------------------------------------------------------
} else {
    echo "Error en la consulta: " . $con->error; #mensaje depuración
    exit; # Salir del script en caso de error en la consulta
}
#-------------------------------------FIN CONSULTA CODIGO PK DEL TURNO EN BASE A EMPACADOR Y FECHA----------------------------------------------------------

$pare = "INSERT INTO tblturnorazonpare (Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES ('', $codigoTurno, 5, NOW(), '')"; # Hago el INSERT A LA BD 1) Codigo, 2) Codigo de turno, 3) Codigo de pare (1=Desayuno), 4) Hora de inicio del pare, 5) Hora fin del pare

if($con->query($pare) === TRUE) 
{
    echo "Pare hecho."; #mensaje depuración
} else 
{
    echo "Error al realizar el pare: " . $con->error;#mensaje depuración
}

echo '<script>window.location.href = "../../operario/turno_parado.php";</script>'; # Me lo manda a la página 'turno_parado' después de ejecutarse el código.

?>