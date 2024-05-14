<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

#-----------------------------------INCLUDE----------------------------------------
    include('validar_sesion.php'); #Incluyo este archivo para hacer uso de la variable "VALSESION", está almacena una consulta que contiene el codigo de quién inicia sesión en la app
#-----------------------------------INCLUDE----------------------------------------

#-------------------------------------INICIO ENVIO DE NOW A LA BD----------------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcionSeleccionada = $_POST["opcion"];

        if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto el NOW a la BD para almacenar 'HoraInicio' en 'tblturno'
        

            $hora = "INSERT INTO tblturno(Codigo, Empacador, Fecha, HoraInicio, HoraFin, Cajas)
                    VALUES(NULL, '$valsesion', NOW(), CURTIME(), '', '')"; #Hago el INSERT a la BD: 1)PK, 2)COD empacador de la sesion, 3)FECHA, 4)HoraInicio, 5)HoraFin, 6)Cajas

        
            if ($con->query($hora) === TRUE) { #si todo sale bien

                echo "<script> alert('TURNO INICIADO EXITOSAMENTE');
                        window.location.href='../operario/indexope.php';
                    </script>";
                exit;

            } else { #si algo falla

                echo "<script> alert('FALLO AL INICIAR TURNO');
                        window.location.href='../operario/indexope.php';
                    </script>"; $con->error;

            }

        } else {#Si elije NO

        
            header("Location: ../operario/indexope.php"); #Lo devuelvo a la página principal 
            exit; #Detengo la ejecución después de redirigirlo

        }
    }
    $con->close(); #Cerrar conexión
#-------------------------------------FIN ENVIO DE NOW A LA BD----------------------------------------------------------


?>