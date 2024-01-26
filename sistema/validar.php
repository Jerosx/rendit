<?php

$codigousuario=$_POST['codigoUser'];
$contraseña=$_POST['contraseña'];

session_start();

$_SESSION['codigoUser']=$codigousuario;

$conexion=mysqli_connect('localhost','root','','rendit');

$consulta="SELECT*FROM tblusuario WHERE Codigo='$codigousuario' and Contraseña='$contraseña'";

$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:../indexadmin.php");
}else{
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