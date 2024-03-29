<?php

#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

    # Verifico la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);

    }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$codigovariedad=$_POST['codigovariedad'];   #creo codigovariedad para tomar el dato con id=codigovariedad en 'formvariedades.html'
$nombrevariedad=$_POST['nombrevariedad'];   #creo nombrevariedad para tomar el dato con id=nombrevariedad en 'formvariedades.html'
$codigoflor=$_POST['codigoflor'];           #creo codigoflor para tomar el dato con id=codigoflor en 'formvariedades.html'
$colorvariedad=$_POST['color'];             #creo colorvariedad para tomar el dato con id=color en 'formvariedades.html'

#---------INICIO ENVIO INFO A LA BD, TBLVARIEDAD------------------------
    $insvariedad=$con->query("insert into tblvariedad (Codigo,Nombre,Flor,Color)
                            values('$codigovariedad','$$nombrevariedad','$codigoflor','$colorvariedad')");

    if($insvariedad){
        echo"<h1> Variedad registrada con exito. </h1>";
    }
    else{
        echo"<h1> Error en el registro. </h1>";
    }
#------------FIN ENVIO INFO A LA BD, TBLVARIEDAD------------------------



print "<a href='../admin/formvariedades.php'> REGRESAR </a>"; #creo un botón para regresar al formulario

?>