<?php

$codigousuario=$_POST['codigoUser']; #le digo que el campo con nombre 'codigoUser' me lo meta por medio del metodo POST en la variable $codigousuario 
$contraseña=$_POST['contraseña']; #le digo que el campo con nombre 'contraseña' me lo meta por medio del metodo POST en la variable $contraseña

session_start(); #inicio la sesión

$_SESSION['codigoUser']=$codigousuario;#creo la variable: _SESSION y le digo que la info del formulario de login que ingresan en el campo codigoUser es igual al codigo usuario

$conexion=mysqli_connect('localhost','root','','rendit'); #me conecto a la BD

$consulta="SELECT*FROM tblusuario WHERE Codigo='$codigousuario' and Contraseña='$contraseña'"; #creo una variable llamada '$consulta' que va a almacenar la consulta a la BD y le digo que me consulte la clave y la contraseña ingresadas con las que tiene la BD

$resultado=mysqli_query($conexion,$consulta);#creo una variable llamada '$resultado' que me va a guardar la consulta de los dos datos de la BD

$filas=mysqli_num_rows($resultado); #Creo una variable llamada '$filas' que va a almacenar el resultado 

if($filas){  #si filas es true va a mandar al usuario a la página de index
    header("location:../admin/indexadmin.php");
}else{       #si no es verdadero, las credenciales no están, por lo que la página te vuelve a direccionar a la pestaña de login
    ?>
    <?php
    header("location:../login.html");
    
    ?>
    <h1>ERROR EN LA AUTENTIFICACIÓN</h1>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);




?>