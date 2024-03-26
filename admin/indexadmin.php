<?php
#INICIO DE VALIDACIÓN DE SESION ACTIVA
    include ('../sistema/validar_sesion.php');
# FIN DE VALIDACIÓN DE SESION ACTIVA

#INICIO VALIDACIÓN DE ROL
    include ('../sistema/validar_rolad.php');
#FIN VALIDACIÓN DE ROL

# INICIO FECHA
    include ('../sistema/fecha.php');
#FIN FECHA
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal administrador</title>
    <link rel="stylesheet" href="../diseño/style.css">

    <script src="../sistema/hora.js"></script>


</head>
<body class="body-admin">
    <header class="header-index-admin">
        <div class="user-name">
            <p> <?php echo "Bienvenid@ <br> $nombreUsuario" ?> </p> <!--SALUDO Y NOMBRE -->
        </div>
        <div class="time-config">
                <p> <span id="hora"></span></p> <!-- HORA -->
        
            <p> <?php echo "$fecha_actual" ?></p><!-- FECHA -->
            
            <!-- Llama a la función actualizarHora al cargar la página -->
            <script>
                window.onload = function() {
                    actualizarHora();
                };
            </script>
        </div>
    </header>
    <div class="main-admin">
        <!--CREACION LISTA DE OPERARIOS EN LA BASE DE DATOS-->
        <?php
            include('../sistema/conexion.php'); #Traigo la conexión a la bd
        ?>
        <div class="tabla-usuarios">
             <h1>OPERARIOS REGISTRADOS</h1>
            <table class="customers" border="1" align="left"> <!--Creo una tabbla -->
                            <tr> 
                
                                <th>Nombre</th> <!--Creo el campo Nombre en la cabecera-->
                                <th>Apellidos</th><!--Creo el campo Apellidos en la cabecera-->
                                <th>Codigo</th><!--Creo el campo Codigo en la cabecera-->
                                <th>Actualizar datos</th><!--Creo el campo Actualizar datos Operario en la cabecera-->

                            </tr>
                    <?php
                        $consulta=$con->query("SELECT * FROM tblusuario WHERE Rol=2 AND Estado=1");#Creo una variable llamada 'conuslta' para almacenar la consulta a la Bd, le digo que traiga todos los usuarios con rol=2 (OPERARIOS) y estado = 1 (ACTIVO)
                            while($fila=$consulta->fetch_assoc()){ //while queda bierto para repetir hasta acabar la impresión de la consulta
                    ?>
                        <tr><td><?php echo $fila['Nombre']?></td> <!--Comienza a escribir en bucle los nombres, apellidos y codigos que se encuentra con la consulta hasta finalizar el while -->
                            <td><?php echo $fila['Apellido']?></td>
                            <td><?php echo $fila['Codigo']?></td>
                            <td><a href="actualizar_usuario.php?id=<?php echo $fila['Codigo']?>">Editar</a></td>

                        </tr>
                    <?php
                        } //cierro el while
                    ?>
            </table>
            <!--FIN LISTA DE OPERARIOS EN LA BASE DE DATOS-->
        </div>

        <div class="links-con">
            <ul>
                <li class="but-new"><a href="#">Estadisticas</a></li>
                <li class="but-new"><a href="formusuario.php">Nuevo operario</a></li>
            </ul>
            <!--<a href="#">Actualizar datos operario</a>-->
            <!-- a href="intermedio_comer_var.php">gestión comercializadora o variedades</a> -->
        


            <!--BOTÓN CIERRE DE SESIÓN -->
            <form action="../sistema/cerrarsesion.php" method="post">
            <button class="admin-but" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
            <!--BOTÓN CIERRE DE SESIÓN -->
        </div>
    </div>
</body>
</html>