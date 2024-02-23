<?php

$codigousuario=$_POST['codigoUser']; #le digo que el campo con nombre 'codigoUser' me lo meta por medio del metodo POST en la variable $codigousuario 
$contraseña=$_POST['contraseña']; #le digo que el campo con nombre 'contraseña' me lo meta por medio del metodo POST en la variable $contraseña

session_start(); #inicio la sesión

$_SESSION['codigoUser']=$codigousuario;#creo la variable: _SESSION y le digo que la info del formulario de login que ingresan en el campo codigoUser es igual al codigo usuario

$conexion=mysqli_connect('localhost','root','','rendit'); #me conecto a la BD

$consulta="SELECT*FROM tblusuario WHERE Codigo='$codigousuario' and Contraseña='$contraseña'"; #creo una variable llamada '$consulta' que va a almacenar la consulta a la BD y le digo que me consulte la clave y la contraseña ingresadas con las que tiene la BD

$resultado=mysqli_query($conexion,$consulta);#creo una variable llamada '$resultado' que me va a guardar la consulta de los dos datos de la BD

$filas=mysqli_fetch_array($resultado); ##Fetch_array me trae los datos de cada fila, Creo una variable llamada '$filas' que va a almacenar el resultado de la consulta

if($filas['Rol']==1){  #Si Rol==1 es administrador
    header("location:../admin/indexadmin.php"); #envialo al index de administrador
}
else
if($filas['Rol'==2]){ #si Rol==2 es operario
    header("location:../operario/indexope.php");#envialo al index del operario
}
else{ #si no es verdadero, las credenciales no están, por lo que la página te vuelve a direccionar a la pestaña de login
    header("location:../index.html");
    exit; #detiene la ejecución del script
}

mysqli_free_result($resultado); #obtengo el resultado y cuando no sea necesario lo elimino
mysqli_close($conexion); #cierro la conexión abierta a la bd




?>