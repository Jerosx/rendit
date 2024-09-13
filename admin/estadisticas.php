<?php
// INICIO DE VALIDACIÓN DE SESION ACTIVA
include('../sistema/validar_sesion.php');
// FIN DE VALIDACIÓN DE SESION ACTIVA

// INICIO VALIDACIÓN DE ROL
include('../sistema/validar_rolad.php');
// FIN VALIDACIÓN DE ROL

// INICIO FECHA
include('../sistema/fecha.php');
// FIN FECHA

include('../sistema/conexion.php'); // Traigo la conexión a la bd

// Obtener la fecha seleccionada del formulario, si existe
$selectedDate = isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');

// Verificar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

// Consulta SQL con filtro por fecha seleccionada por el usuario
$sql = "SELECT tu.Nombre, tt.Cajas, tt.HoraInicio, tt.HoraFin
        FROM tblturno tt
        JOIN tblusuario tu ON tt.Empacador = tu.Codigo
        WHERE tt.Fecha = ?";

// Se prepara el statement para la consulta a la BD.
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $selectedDate);
$stmt->execute();
// se obtiene el resultado de la consulta
$result = $stmt->get_result();

$empacadores = [];
$numeroCajas = [];
$rendimientoPorHora = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['Nombre'];
        $cajas = $row['Cajas'];
        // se calculan las horas trabajadas de cada Empacador
        $horaInicio = DateTime::createFromFormat('H:i:s', $row['HoraInicio']);
        $horaFin = DateTime::createFromFormat('H:i:s', $row['HoraFin']);
        $interval = $horaInicio->diff($horaFin);
        $horasTrabajadas = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
        // Validamos que las horas laboradas sean mayor a 0
        if ($horasTrabajadas > 0) {
            $rendimiento = $cajas / $horasTrabajadas;

            if (!isset($empacadores[$nombre])) {
                $empacadores[$nombre] = $nombre;
                $numeroCajas[$nombre] = 0;
                $rendimientoPorHora[$nombre] = 0;
            }
            $numeroCajas[$nombre] += $cajas;
            $rendimientoPorHora[$nombre] += $rendimiento;
        } else {
            // Si las horas trabajadas son 0, no se puede calcular el rendimiento
            $rendimiento = 0;
            if (!isset($empacadores[$nombre])) {
                $empacadores[$nombre] = $nombre;
                $numeroCajas[$nombre] = 0;
                $rendimientoPorHora[$nombre] = 0;
            }
            $numeroCajas[$nombre] += $cajas;
            $rendimientoPorHora[$nombre] += $rendimiento;
        }
    }
} else {
    echo "";
}
$stmt->close();
$con->close();

// Convertir los datos a formato JSON para JavaScript
$empacadoresJson = json_encode(array_values($empacadores));
$numeroCajasJson = json_encode(array_values($numeroCajas));
$rendimientoPorHoraJson = json_encode(array_values($rendimientoPorHora));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> <!-- Plugin para etiquetas de datos -->
    <script src="../sistema/js/hora.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">

  <div class="container-fluid">
    <a class="navbar-brand" href="">RENDIT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <li class="nav-item">
          <a class="nav-link" href="estadisticasGeneral.php">ESTADÍTICAS GENERALES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="estadisticasParo.php">ESTADÍSTICAS DE PAROS</a>
        </li>
      </ul>
    <ul class="navbar-nav ">
      <li class="nav-item"><p class="text-uppercase fs-6 mt-3 text-light"> <?php echo "$nombreUsuario"." "."$apellidoUsuario"; ?> </p></li><!--SALUDO Y NOMBRE -->
      <li class="nav-item">
            <form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning m-2" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
    <div class="row">
       
        <div class="col">
            <a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
            <div class="container text-center mt-5">
                <h3 class="display-4">Estadísticas Operarios</h3>

                <!-- Formulario para seleccionar la fecha -->
                <form method="post" action="">
                    <div class="form-group">
                        <label for="fecha">Selecciona una fecha:</label>
                        <input type="date" id="fecha" name="fecha" value="<?php echo $selectedDate; ?>" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </form>

                <canvas id="myChart" width="400" height="100" class="mt-5"></canvas>
                <canvas id="myChartRendimiento" width="400" height="100" class="mt-5"></canvas>

                <script>
                    // Convertir los datos de PHP a formato JSON para JavaScript
                    var empacadores = <?php echo $empacadoresJson; ?>;
                    var numeroCajas = <?php echo $numeroCajasJson; ?>;
                    var rendimientoPorHora = <?php echo $rendimientoPorHoraJson; ?>;

                    // Crear el gráfico de número de cajas con Chart.js
                  
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: empacadores,
                            datasets: [{
                                label: 'Número de Cajas por Empacador',
                                data: numeroCajas,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'start',
                                    formatter: (value, ctx) => {
                                        return value + ' cajas';
                                    },
                                    font:{
                                        weight: 'bold',
                                    },
                                    color: 'black',
                                }
                            },
                            escales: {
                                y:{
                                    beginAtZero: true,
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });

                    // Crear el gráfico de rendimiento por hora con Chart.js
                    var ctxRendimiento = document.getElementById('myChartRendimiento').getContext('2d');
                    var myChartRendimiento = new Chart(ctxRendimiento, {
                        type: 'bar',
                        data: {
                            labels: empacadores,
                            datasets: [{
                                label: 'Rendimiento por Hora',
                                data: rendimientoPorHora,
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'start',
                                    formatter: (value, ctx) => {
                                        return value.toFixed(2) + ' cajas';
                                    },
                                    font: {
                                        weight: 'bold'
                                    },
                                    color: 'black'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>
