<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$Codigo=$_POST['Codigo'];   #se crea variable comercializadora para tomar el dato con id=codigo en 'formcomercializadora.html'
$Nombre=$_POST['Nombre'];   #se crea variable nombre para tomar el dato con id=nombre en 'formcomercializadora.html'

#---------INICIO ENVIO INFO A LA BD, TBLcomercializadora------------------------
    $inscomercializadora=$con->query("insert into tblcomercializadora (Codigo, Nombre)
                            values('$Codigo','$Nombre')");

    if($inscomercializadora){
        echo"<h1> comercializadora registrada con exito. </h1>";
    }
    else{
        echo"<h1> Error en el registro. </h1>";
    }
#------------FIN ENVIO INFO A LA BD, TBLCOMERCIALIZADORA------------------------



print "<a href='../admin/formcomercializadora.php'> REGRESAR </a>"; #creo un botón para regresar al formulario


?>