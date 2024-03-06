<?php
include('conexion.php'); // Incluir el archivo de conexión

if(isset($_POST['cajas'])) { // Verificar si se ha enviado un valor válido para el campo 'cajas' desde el formulario
    
    $cajas = $_POST['cajas']; // Capturar el valor enviado desde el formulario

    // Primero, obtenemos el próximo código de turno
    $query = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'rendit' AND TABLE_NAME = 'tblturno'";
    $resultado = mysqli_query($con, $query);

    if ($resultado) {  // Verificar si la consulta fue exitosa
        $fila = mysqli_fetch_assoc($resultado);

        // Obtener el código de turno
        $codigo_turno = $fila['AUTO_INCREMENT'] - 1; // Restamos 1 para obtener el último código antes del próximo autoincremento (ESTO PARA PODER IR TANTEANDOLO HACIENDO USO DE EL DATO QUE YA ESTA EN LA BD, CUANDO ESTO SE VAYA A IMPLEMENTAR SE DEBE MODIFICAR)

        // Cerrar el resultado
        mysqli_free_result($resultado);

        // Obtener el ID de sesión
        session_start();
        $session_id = session_id();

        // Ahora podemos usar $codigo_turno y $session_id según sea necesario

        // Luego, actualizamos la caja con el nuevo valor
        $actualizarcaja = $con->query("UPDATE tblturno SET Cajas = '$cajas' WHERE Codigo = $codigo_turno");

        if ($actualizarcaja === TRUE) {
            echo "Cajas actualizada correctamente.";
        } else {
            echo "Error al actualizar la caja: " . $con->error;
        }
    } else {
        // Error si la consulta falla
        echo "Error al consultar el código de turno: " . mysqli_error($con);
    }

    mysqli_close($con); // Cerrar la conexión
} else {
    echo "No se recibió un valor válido para el campo 'cajas' desde el formulario."; // Por si le meten letras
}
?>

