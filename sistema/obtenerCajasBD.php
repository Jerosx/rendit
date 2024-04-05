<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

    include('fecha.php'); #Incluyo este archivo para hacer uso de la variable 'fecha_actual´, está almacena el día en el que se está al abrir el aplicativo

#-----------------------------------INCLUDES----------------------------------------

// Realizar la consulta para obtener el valor deseado
$query = "SELECT Cajas as num_cajas FROM tblturno WHERE Empacador = '$valsesion' AND Fecha = '$fecha_actual'";
$resultado = $con->query($query);

// Verificar si se obtuvo un resultado válido
if ($resultado->num_rows > 0) {
    // Obtener el valor y mostrarlo en el campo de cajas
    $fila = $resultado->fetch_assoc();
    $num_cajas = $fila["num_cajas"];
    echo "<script>document.getElementById('cajas').value = $num_cajas;</script>";
} else {
    echo "<script>console.error('No se encontraron resultados para el número de cajas.');</script>";
}
?>
