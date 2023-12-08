<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    if ($_SESSION['user']['rol'] != 1) {
        header('Location: ../login.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styless.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</head>

<body>
    <?php include("../admin_header.php"); ?>
    <div class="container">
    <h1>Productos Más Vendidos</h1>
        <div class="row">
            <div class="col">
                <form id="periodForm">
                    <div class="form-group">
                        <label for="startDate">Fecha de inicio:</label>
                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    </div>

                    <div class="form-group">
                        <label for="endDate">Fecha final:</label>
                        <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                    </div>

                    <div class="form-group ">
                        <button type="button" class="btn btn-success" onclick="getChartData()">Generar Gráfica</button>
                    </div>
                </form>
            </div>
            <div class="col rounded" style="background-color:white">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    <script>
    function getChartData() {
        var fechaInicio = $("#fechaInicio").val();
        var fechaFin = $("#fechaFin").val();

        $.ajax({
            url: "../../controllers/adminController.php", // Nombre del archivo PHP que manejará la solicitud
            method: "POST",
            data: {
                action: 'prodMas',
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            success: function(data) {
                // Lógica para manejar la respuesta del servidor y generar la gráfica
                generateChart(data);
            },
            error: function(error) {
                console.error("Error al obtener datos: ", error);
            }
        });
    }

    function generateChart(data) {
        console.log("ENTRE AQUI", data);
        var chartData = JSON.parse(data);

        // Extraer etiquetas y datos de tu conjunto de datos
        var labels = chartData.map(item => item.nombre_producto);
        var dataValues = chartData.map(item => item.total_vendido);

        var ctx = document.getElementById("salesChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Productos Más Vendidos",
                    data: dataValues,
                    backgroundColor: "rgba(3, 138, 255, 255)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    </script>
    </div>

    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>

</html>