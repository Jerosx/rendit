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

// Obtener la fecha seleccionada del formulario
$selectedDate = isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');
$selectedEmpacador = isset($_POST['empacador']) ? $_POST['empacador'] : '';

// Obtener la lista de empacadores para el filtro
$empacadoresList = [];
$empacadoresSql = "SELECT DISTINCT tu.Nombre FROM tblusuario tu JOIN tblturno tt ON tu.Codigo = tt.Empacador";
$resultEmpacadores = $con->query($empacadoresSql);

if ($resultEmpacadores->num_rows > 0) {
    while ($row = $resultEmpacadores->fetch_assoc()) {
        $empacadoresList[] = $row['Nombre'];
    }
}

// Verificar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

// Consulta con filtro por fecha seleccionada por el usuario y empacador si está seleccionado
$sql = "SELECT tu.Nombre, trp.HoraInicioPare, trp.HoraFinPare, rp.Nombre AS RazonPare, tt.HoraInicio, tt.HoraFin
        FROM tblturno tt
        JOIN tblusuario tu ON tt.Empacador = tu.Codigo
        JOIN tblturnorazonpare trp ON tt.Codigo = trp.CodTurno
        JOIN tblrazonparo rp ON trp.CodPare = rp.Codigo
        WHERE tt.Fecha = ?";
        
if ($selectedEmpacador) {
    $sql .= " AND tu.Nombre = ?";
}

// Se prepara el statement para la consulta a la BD.
$stmt = $con->prepare($sql);
if ($selectedEmpacador) {
    $stmt->bind_param('ss', $selectedDate, $selectedEmpacador);
} else {
    $stmt->bind_param('s', $selectedDate);
}
$stmt->execute();
// se obtiene el resultado de la consulta
$result = $stmt->get_result();

$empacadores = [];
$razonPares = [];
$tiemposParo = [];
$tiemposTurno = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['Nombre'];
        $razonPare = $row['RazonPare'];
        $horaInicioPare = DateTime::createFromFormat('H:i:s', $row['HoraInicioPare']);
        $horaFinPare = DateTime::createFromFormat('H:i:s', $row['HoraFinPare']);
        $horaInicioTurno = DateTime::createFromFormat('H:i:s', $row['HoraInicio']);
        $horaFinTurno = DateTime::createFromFormat('H:i:s', $row['HoraFin']);
        $intervalPare = $horaInicioPare->diff($horaFinPare);
        $intervalTurno = $horaInicioTurno->diff($horaFinTurno);
        $tiempoParo = ($intervalPare->h * 60) + $intervalPare->i + ($intervalPare->s / 60); // Convertimos el tiempo de paro a minutos
        $tiempoTurno = ($intervalTurno->h * 60) + $intervalTurno->i + ($intervalTurno->s / 60); // Convertimos el tiempo de turno a minutos

        if (!isset($empacadores[$nombre])) {
            $empacadores[$nombre] = $nombre;
            $razonPares[$nombre] = [];
            $tiemposParo[$nombre] = 0;
            $tiemposTurno[$nombre] = $tiempoTurno; // Asumimos que cada turno tiene un solo empacador
        }
        $razonPares[$nombre][] = $razonPare;
        $tiemposParo[$nombre] += $tiempoParo;
    }
} else {
    echo "";
}
$stmt->close();
$con->close();


// Ordenar empacadores por tiempo de paro
arsort($tiemposParo);

// Preparar datos para gráficos
$empacadoresJson = json_encode(array_values($empacadores));
$razonParesJson = json_encode(array_values($razonPares));
$tiemposParoJson = json_encode(array_values($tiemposParo));
$tiemposTurnoJson = json_encode(array_values($tiemposTurno));
$tiemposParoOrdenadoJson = json_encode(array_values($tiemposParo));
$empacadoresOrdenadosParoJson = json_encode(array_keys($tiemposParo));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Paros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="../sistema/js/hora.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<style>



    .navbar-nav .nav-link {
      transition: background-color 0.3s ease-in-out;
    }

    .navbar-nav .nav-link:hover {
      background-color: #ccc;
      /* Cambia el color de fondo al pasar el mouse */
      color: #333;
      /* Cambia el color del texto al pasar el mouse */
      border-radius: 5px;
      /* Agrega un borde redondeado */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Agrega una sombra */
    }
  </style>

<nav class="navbar bg-primary fixed-left px-3 py-3">
  <div class="container-fluid">
    <div class="d-flex align-items-center">

      <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand p-2 " href="#">RENDIT</a>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="margin: 10px;">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RENDIT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body overflow-auto px-3 py-3">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3" style="max-heigth: 70vh;">
          <li class="d-flex align-items-center nav-item mb-2"><i class="fa-solid fa-user fa-2xl fa-beat-fade" style="color: #1346a0;"></i><span class="nav-link fw-bold mx-2">USUARIOS</span> </li>

          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="tablaoperarios.php">Operarios registrados</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="tablaadmin.php">Administradores registrados</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="formusuario.php">Nuevo usuario</a></li>

          <li class="d-flex align-items-center nav-item mb-3 mt-3 ml-2"><i class="fa-solid fa-chart-line fa-2xl fa-beat-fade" style="color: #3c73d3;"></i><span class="nav-link fw-bold mx-2">ESTADISTICAS</span></li>

          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticas.php">Estadísticas operarios</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticasParo.php">Estadísticas de paros</a></li>
          <li class="nav-item mb-3"><a class="nav-link p-3 border rounded d-block text-truncate" href="estadisticasGeneral.php">Estadística general</a></li>
          <ul class="navbar-nav">
            <li class="nav-item">
              <p class="  text-uppercase fs-6 mt-5 text-dark"> <?php echo "$nombreUsuario" . " " . "$apellidoUsuario"; ?> </p>
            </li><!--SALUDO Y NOMBRE -->
            <li class="nav-item">
              <form action="../sistema/cerrarsesion.php" method="post">
                <button class="btn btn-warning mt-4" type="submit" id="cerrarSesionBtn" name="cerrarSesionBtn">Cerrar Sesión</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <div class="row">
       
        <div class="col">
            <div class="container text-center mt-5">
                <h3 class="display-4">Estadísticas Generales</h3>

                <!-- Formulario para seleccionar la fecha y empacador -->
                <form method="post" action="">
                    <div class="form-group">
                        <label for="fecha">Selecciona una fecha:</label>
                        <input type="date" id="fecha" name="fecha" value="<?php echo $selectedDate; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="empacador">Selecciona un empacador:</label>
                        <select id="empacador" name="empacador" class="form-control">
                            <option value="">Todos</option>
                            <?php foreach ($empacadoresList as $empacador): ?>
                                <option value="<?php echo $empacador; ?>" <?php if ($selectedEmpacador == $empacador) echo 'selected'; ?>>
                                    <?php echo $empacador; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </form>


                <h2 class="display-4">Tiempo de Pare por Empacador</h2>
                <canvas id="pareEmpacadores" width="400" height="100" class="mt-5"></canvas>

                <h2 class="display-4">Tiempo Productivo vs Tiempo Improductivo</h2>
                <div class="container text-center pt-5" style="width: 550px;">
                <canvas id="tiempoproductivo" style="width: 100px;"></canvas>

                <script>
                    // Convertir los datos de PHP a formato JSON para JavaScript
                    var empacadores = <?php echo $empacadoresJson; ?>;
                    var razonPares = <?php echo $razonParesJson; ?>;
                    var tiemposParo = <?php echo $tiemposParoJson; ?>;
                    var tiemposTurno = <?php echo $tiemposTurnoJson; ?>;
                    var tiemposParoOrdenado = <?php echo $tiemposParoOrdenadoJson; ?>;
                    var empacadoresOrdenadosParo = <?php echo $empacadoresOrdenadosParoJson; ?>;

                    // Colores para los gráficos
                    var colors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];



                    // Gráfico de Empacadores por Tiempo de Pare
                    var pareCtx = document.getElementById('pareEmpacadores').getContext('2d');
                    var pareEmpacadoresChart = new Chart(pareCtx, {
                        type: 'bar',
                        data: {
                            labels: empacadoresOrdenadosParo,
                            datasets: [{
                                label: 'Tiempo de Pare (minutos)',
                                data: tiemposParoOrdenado,
                                backgroundColor: colors,
                                borderColor: colors.map(color => color.replace('0.2', '1')),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Tiempo de Pare (minutos)'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return context.label + ': ' + context.raw.toFixed(2) + ' minutos';
                                        }
                                    }
                                },
                                // Añadir los datos dentro de las barras
                                datalabels: {
                                    anchor: 'end',
                                    align: 'start',
                                    color: 'black',
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function(value, context) {
                                        return value.toFixed(2) + ' min'; // Para mostrar los valores con dos decimales
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels] // Añadimos el plugin de datalabels
                    });


                   // Gráfico de Torta para Tiempo Productivo vs Improductivo
                    var productiveTimeCtx = document.getElementById('tiempoproductivo').getContext('2d');
                    var totalProductivo = Object.values(tiemposTurno).reduce((a, b) => a + b, 0) - Object.values(tiemposParo).reduce((a, b) => a + b, 0);
                    var totalImproductivo = Object.values(tiemposParo).reduce((a, b) => a + b, 0);
                    var productiveTimeChart = new Chart(productiveTimeCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Tiempo Productivo', 'Tiempo Improductivo'],
                            datasets: [{
                                label: 'Tiempo',
                                data: [totalProductivo, totalImproductivo],
                                backgroundColor: ['rgb(31, 51, 97)', 'rgb(255, 212, 10)'],
                                borderColor: ['rgb(31, 51, 97)', 'rgb(31, 51, 97)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            var label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += context.raw.toFixed(2) + ' min';
                                            return label;
                                        }
                                    }
                                },
                                // Añadir los datos dentro de la torta
                                datalabels: {
                                    color: 'white',
                                    formatter: function(value, context) {
                                        return value.toFixed(2) + ' min'; // Para mostrar los minutos
                                    },
                                    font: {
                                        weight: 'bold',
                                        size: 16
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels] // Añadimos el plugin de datalabels
                    });


                </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
