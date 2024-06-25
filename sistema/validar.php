<?php
#-----------------------------------CONEXIÓN A LA BD----------------------------------------
    include ('conexion.php'); #me conecto a la BD

        # Verifico la conexión
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);

        }
#-----------------------------------CONEXIÓN A LA BD----------------------------------------

$codigousuario=$_POST['codigoUser']; #le digo que el campo con nombre 'codigoUser' me lo meta por medio del metodo POST en la variable $codigousuario 
$contrasena=$_POST['contrasena']; #le digo que el campo con nombre 'contraseña' me lo meta por medio del metodo POST en la variable $contraseña

session_start(); #inicio la sesión

$_SESSION['codigoUser']=$codigousuario;#creo la variable: _SESSION y le digo que la info del formulario de login que ingresan en el campo codigoUser es igual al codigo usuario

$consulta="SELECT*FROM tblusuario WHERE Codigo='$codigousuario' and Contrasena='$contrasena'"; #creo una variable llamada '$consulta' que va a almacenar la consulta a la BD y le digo que me consulte la clave y la contraseña ingresadas con las que tiene la BD

$resultado=mysqli_query($con,$consulta);#creo una variable llamada '$resultado' que me va a guardar la consulta de los dos datos de la BD

$filas=mysqli_fetch_array($resultado); ##Fetch_array me trae los datos de cada fila, Creo una variable llamada '$filas' que va a almacenar el resultado de la consulta

if($resultado->num_rows > 0) #En este punto valido que la varibale $resultado contenga al menos 1 dato usando la propiedad 'num_rows', que cuenta cuantas filas de datos arrojo la consulta
{
    if($filas['Estado']==1) #La variable 'filas' contiene los datos que trajo 'resultado' pero en un array, por el uso de 'mysqli_fetch_array', si el estado de la persona es 1, está activo y puede ingresar
    {
        if($filas['Rol']==1){  #Si Rol==1 es administrador

            header("location:../admin/indexadmin.php"); #envialo al index de administrador

        }

        else if($filas['Rol'==2]){ #si Rol==2 es operario

            header("location:../operario/indexIniciarTurno.php");#envialo al index del operario

        }

    }else{ #si el estado es diferente a 1, está inactivo, por lo que no debe pasar

        $_SESSION["estado"]=false;
        header("location:../index.php");#envialo al index del operario

       /*  echo "<script> alert('ESTE USUARIO SE ENCUENTRA INHABILITADO COMUNIQUESE CON SU SUPERVISOR MÁS CERCANO');
                            window.location.href='../index.html';
            </script>";
            exit;
 */
    }
}
else #si no es verdadero, las credenciales no están, por lo que la página te vuelve a direccionar a la pestaña de login
{


    $_SESSION["validar"]=false;
    header("location:../index.php");#envialo al index del operario

    /* echo "<script> alert('CREDENCIALES INCORRECTAS');
                    window.location.href='../index.html';
    </script>";
    exit; */
}
mysqli_free_result($resultado); #obtengo el resultado y cuando no sea necesario lo elimino
mysqli_close($conexion); #cierro la conexión abierta a la bd
?>