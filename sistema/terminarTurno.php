<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDES----------------------------------------
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", que almacena una consulta que contiene el código de quién inicia sesión en la app
    include('fecha.php'); #Incluyo este archivo para hacer uso de la variable 'fecha_actual', que almacena el día en el que se está al abrir el aplicativo
    #-----------------------------------INCLUDES----------------------------------------
    include('fecha.php');
#-----------------------------------CONSULTA EXISTENCIA DE TURNO YA FINALIZADO----------------------------------------
    $turno = "SELECT HoraFin FROM tblturno WHERE DATE(Fecha) = '$fecha_actual' AND Empacador = '$valsesion'";
    $resultadoFinTurno = $con->query($turno);

    if ($resultadoFinTurno === false) {
        die("Error en la consulta: " . $con->error);
    }

    echo "Op: " . $valsesion . "<br>"; #mensajes para depuración
    echo "Fecha: " . $fecha_actual . "<br>"; #mensajes para depuración
    echo "Turnos encontrados en el día: " . $resultadoFinTurno->num_rows . "<br>"; #mensajes para depuración

    # Verificar el valor de HoraFin
    $horaFin = null;
    if ($resultadoFinTurno->num_rows > 0) {
        $fila = $resultadoFinTurno->fetch_assoc();
        $horaFin = $fila['HoraFin'];
        echo "HoraFin: " . $horaFin . "<br>"; #mensajes para depuración
    }
#-----------------------------------CONSULTA EXISTENCIA DE TURNO YA FINALIZADO----------------------------------------

#-------------------------------------INICIO ENVIO DE NOW A LA BD----------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcionSeleccionada = $_POST["opcion"];

        if ($opcionSeleccionada == "opcionSi") { # Si elige SI, ejecuto el NOW a la BD para almacenar 'HoraInicio' en 'tblturno'
            
            if ($horaFin == '00:00:00') { # Si HoraFin tiene valor 00:00:00, significa que su turno el día de hoy aún no se ha finalizado
                $hora = "UPDATE tblturno SET HoraFin = NOW() 
                        WHERE Empacador = '$valsesion' AND DATE(Fecha) = '$fecha_actual'"; # Actualizo el campo HoraFin filtrando por el operario con la sesión y por la fecha del día

                if ($con->query($hora) === TRUE) { # Si todo sale bien

                    echo "<script> alert('TURNO FINALIZADO EXITOSAMENTE');
                            window.location.href='../operario/indexIniciarTurno.php';
                        </script>";
                    exit;

                } else { # Si algo falla

                    echo "<script> alert('FALLO AL FINALIZAR EL TURNO');
                            window.location.href='../operario/indexTurno.php';
                        </script>";
                    echo "Error: " . $con->error;

                }
            } else { # Si HoraFin tiene un valor distinto de 00:00:00, significa que la persona ya finalizó el turno que tenía activo el día de hoy
                
                echo "<script> alert('USTED YA FINALIZÓ SU TURNO EL DÍA DE HOY');
                        window.location.href='../operario/indexTurno.php';
                    </script>";
                exit;

            }
        } else { # Si elige NO

            header("Location: ../operario/indexTurno.php"); # Lo devuelvo a la página principal
            exit; # Detengo la ejecución después de redirigirlo
        }
    }
    $con->close(); # Cerrar conexión
#-------------------------------------FIN ENVIO DE NOW A LA BD----------------------------------------------------------
?>