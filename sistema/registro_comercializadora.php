<?php
include('conexion.php'); //llamo a la conexión a la base de datos

$codigo=$_POST['codigo'];   #se crea variable comercializadora para tomar el dato con id=codigo en 'formcomercializadora.html'
$nombre=$_POST['nombre'];   #se crea variable nombre para tomar el dato con id=nombre en 'formcomercializadora.html'

#---------INICIO ENVIO INFO A LA BD, TBLcomercializadora------------------------
$inscomercializadora=$con->query("insert into tblcomercializadora (codigo,nombre)
                        values('$Codigo','$Nombre')");

if($inscomercializadora){
    echo"<h1> comercializadora registrada con exito. </h1>";
}
else{
    echo"<h1> Error en el registro. </h1>";
}
#------------FIN ENVIO INFO A LA BD, TBLCOMERCIALIZADORA------------------------



print "<a href='../formcomercializadora.html'> REGRESAR </a>"; #creo un botón para regresar al formulario


?>