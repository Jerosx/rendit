<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDE----------------------------------------

    include('fecha.php');
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app

#-----------------------------------INCLUDE----------------------------------------

#-----------------------------------CONSULTA EXISTENCIA DE TURNO----------------------------------------

    $turno = "SELECT * FROM tblturno WHERE DATE(Fecha) = '$fecha_actual' AND Empacador = '$valsesion'";
    $resultadoTurno = $con->query($turno);

    echo "Op: " . $valsesion . "<br>"; #mensajes para depuración
    echo "fecha: " . $fecha_actual . "<br>"; #mensajes para depuración
    echo "Número de filas: " . $resultadoTurno->num_rows . "<br>"; #mensajes para depuración

#-----------------------------------CONSULTA EXISTENCIA DE TURNO----------------------------------------

#-------------------------------------INICIO ENVIO DE NOW A LA BD----------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcionSeleccionada = $_POST["opcion"];

    if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto el NOW a la BD para almacenar 'HoraInicio' en 'tblturno'
        
        if ($resultadoTurno === false) {
            
            echo "Error en la consulta: " . $con->error;

        } elseif ($resultadoTurno->num_rows < 1) { #Si la variable resultadoTurno tiene un valor menor a 1, significa que no hay un turno registrado en la fecha de hoy 
            
            $hora = "INSERT INTO tblturno(Codigo, Empacador, Fecha, HoraInicio, HoraFin, Cajas)
                     VALUES(NULL, '$valsesion', NOW(), CURTIME(), '', '')"; #Hago el INSERT a la BD: 1)PK, 2)COD empacador de la sesion, 3)FECHA, 4)HoraInicio, 5)HoraFin, 6)Cajas

            if ($con->query($hora) === TRUE) { #si todo sale bien
                
                echo "<script> alert('TURNO INICIADO EXITOSAMENTE');
                        window.location.href='../operario/indexTurno.php';
                      </script>";
                exit;

            } else { #si algo falla
                
                echo "<script> alert('FALLO AL INICIAR TURNO');
                        window.location.href='../operario/indexIniciarTurno.php';
                      </script>";
                echo $con->error;

            }
        } else { #Si la variable resultadoTurno tiene un valor mayor o igual a 1, significa que ya hay un turno registrado en la fecha de hoy 
            
            echo "<script> alert('USTED YA TIENE UN TURNO REGISTRADO EL DÍA DE HOY');
                    window.location.href='../operario/indexIniciarTurno.php';
                  </script>";
            exit;

        }
    } else { #Si elije NO
        
        header("Location: ../operario/indexIniciarTurno.php"); #Lo devuelvo a la página principal 
        exit; #Detengo la ejecución después de redirigirlo

    }
}
$con->close(); #Cerrar conexión

header("Location: ../operario/indexIniciarTurno.php");

#-------------------------------------FIN ENVIO DE NOW A LA BD----------------------------------------------------------
?>