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
    <script src="../sistema/js/hora.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">RENDIT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <p class="text-uppercase fs-6 mt-3 text-light"><?php echo "$nombreUsuario $apellidoUsuario"; ?></p>
                </li>
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
        <div class="col-md-2 bg-light">
            <h4 class="mt-4">Menú</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="estadisticas.php">Estadísticas Operarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estadisticasParo.php">Estadísticas Paro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="estadisticasGeneral">Estadísticas Generales</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <a class="btn btn-warning m-4" href="../admin/indexadmin.php" role="button">REGRESAR</a>
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


                <h2>Tiempo de Pare por Empacador</h2>
                <canvas id="pareEmpacadores" width="400" height="100" class="mt-5"></canvas>

                <h2>Tiempo Productivo vs Tiempo Improductivo</h2>
                <canvas id="tiempoproductivo" width="400" height="100" class="mt-5"></canvas>

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
                                }
                            }
                        }
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
                                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
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
                                            label += context.raw.toFixed(2) + ' minutos';
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>
