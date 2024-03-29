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

    include('fecha.php'); #Incluyo el archivo que contiene la fecha del día
#-----------------------------------INCLUDES----------------------------------------


#-------------------------------------INICIO CONSULTA CODIGO PK DEL TURNO EN BASE A EMPACADOR Y FECHA ------------------------------------------------------

 $codTurno = $con->query("SELECT Codigo FROM tblturno WHERE Empacador = $valsesion AND Fecha = '$fecha_actual' ");
 $row = $codTurno->fetch_assoc();
 $codTurno = $row['Codigo'];

    #-------------------------------------CÓDIGO POR SI SE NECESITA VALIDAR EL CÓDIGO DE TURNO QUE ESTÁ TRAYENDO LA CONSULTA----------------------------------------------------------
        #            $resultado = $codTurno->fetch_assoc(); // Obtener la fila de resultados como un arreglo asociativo
        #            echo $resultado['Codigo']; // Imprimir el valor de una columna específica
    #-------------------------------------CÓDIGO POR SI SE NECESITA VALIDAR EL CÓDIGO DE TURNO QUE ESTÁ TRAYENDO LA CONSULTA----------------------------------------------------------
 
#-------------------------------------FIN CONSULTA CODIGO PK DEL TURNO EN BASE A EMPACADOR Y FECHA----------------------------------------------------------

#-------------------------------------INICIO ENVIO DE MOTIVO E INICIO DE PARE A LA BD----------------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $opcionSeleccionada = $_POST["opcion"]; #almaceno la opcion seleccionada

        $motivoPare = $_POST["motivo"]; #almaceno el motivo del pare

        if ($opcionSeleccionada == "opcionSi") { #Si elije SI, ejecuto la validación de cuál es el motivo de pare para hacer su respectivo insert

            switch($motivoPare){ #SEGÚN el motivo de pare ejecuto LA MISMA CONSULTA, lo que cambia según el motivo es el número que incorpora, ya que cada número vincula una razón de apre diferente en la BD

                case "motivoDesayuno"; #Caso DESAYUNO

                    echo("Motivo Desayuno");
                    echo $codTurno;

                    $pare = "INSERT INTO tblturnorazonpare(Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES (NULL, $codTurno, 1, NOW(), '')"; #Hago el INSERT A LA BD 1)Codigo, 2)Codigo de turno, 3) Codigo de pare (1=Desayuno), 4) Hora de inicio del pare, 5) Hora fin del pare

                        if($con->query($pare) === TRUE) {
                            echo "Pare hecho.";
                        } else {
                            echo "Error al realizar el pare: " . $con->error;
                        }
                        break;

                    break;

                case "opcionFCanastillas"; #Caso FALTA DE CANASTILLA 
                
                    echo("Motivo Falta canastillas");
                    $pare = "INSERT INTO tblturnorazonpare(Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES (NULL, $codTurno, 2, NOW(), '')"; #Hago el INSERT A LA BD 1)Codigo, 2)Codigo de turno, 3) Codigo de pare (2=Falta canastillas), 4) Hora de inicio del pare, 5) Hora fin del pare

                        if($con->query($pare) === TRUE) { #valido si sale bien el insert
                            echo "Pare hecho.";
                        } else {
                            echo "Error al realizar el pare: " . $con->error;
                        }
                        break;

                    break;

                case "opcionBandaLlena"; #Caso BANDA LLENA
                
                    echo("Motivo Banda llena");
                    $pare = "INSERT INTO tblturnorazonpare(Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES (NULL, $codTurno, 3, NOW(), '')"; #Hago el INSERT A LA BD 1)Codigo, 2)Codigo de turno, 3) Codigo de pare (3=Banda llena), 4) Hora de inicio del pare, 5) Hora fin del pare

                        if($con->query($pare) === TRUE) { #valido si sale bien el insert
                            echo "Pare hecho.";
                        } else {
                            echo "Error al realizar el pare: " . $con->error;
                        }
                        break;

                    break;

                case "opcionFFlor"; #Caso FALTA DE FLOR
                
                    echo("Motivo Falta flor");
                    $pare = "INSERT INTO tblturnorazonpare(Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES (NULL, $codTurno, 4, NOW(), '')"; #Hago el INSERT A LA BD 1)Codigo, 2)Codigo de turno, 3) Codigo de pare (4=Falta flor), 4) Hora de inicio del pare, 5) Hora fin del pare

                        if($con->query($pare) === TRUE) { #valido si sale bien el insert
                            echo "Pare hecho.";
                        } else {
                            echo "Error al realizar el pare: " . $con->error;
                        }
                        break;

                    break;

                case "opcionFMaterial"; #Caso FALTA DE MATERIAL
                
                    echo("Motivo Falta material");
                    $pare = "INSERT INTO tblturnorazonpare(Codigo, CodTurno, CodPare, HoraInicioPare, HoraFinPare)
                            VALUES (NULL, $codTurno, 5, NOW(), '')"; #Hago el INSERT A LA BD 1)Codigo, 2)Codigo de turno, 3) Codigo de pare (5=Falta material), 4) Hora de inicio del pare, 5) Hora fin del pare

                        if($con->query($pare) === TRUE) { #valido si sale bien el insert
                            echo "Pare hecho.";
                        } else {
                            echo "Error al realizar el pare: " . $con->error;
                        }
                        break;

                    break;

                default:

                    echo("Motivo fuera de rango"); #Por si se ingresa un valor invalido (No es posible porque se maneja con una lista desplegable)
            }
            
        } else {#Si elije NO

        
            header("Location: ../operario/indexope.php"); #Lo devuelvo a la página principal 
            exit; #Detengo la ejecución después de redirigirlo

        }
    }
    $con->close(); #Cerrar conexión
#-------------------------------------FIN ENVIO DE MOTIVO E INICIO DE PARE A LA BD----------------------------------------------------------

echo '<script>window.location.href = "../operario/turno_parado.php";</script>'; #me lo manda a la página 'turno_parado' después de ejecutarse el código.






?>