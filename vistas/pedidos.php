<?php
session_start();

require_once '../models/venta.php';

// Obtén los datos de las ventas desde tu controlador
$user = $_SESSION['user'];
$model = new VentaModel();
$ventas = $model->getUserVentas($user['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezQhTlVC0vZdVyZ1M6tC5NYYU5lYZl0AMleRJuCkWBvQ+8mHT5n9e5StbDEg8L45" crossorigin="anonymous">

</head>

<body>
    <?php include("header.php"); ?>
    <div class="container">
        <h1>Historial de mis pedidos</h1>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th>Fecha del pedido</th>
                    <th>Total del pedido</th>
                    <th>Recibo</th>
                    <!-- Agrega más encabezados según tus necesidades -->
                </tr>
            </thead>
            <tbody>
                <!-- Llena la tabla con los datos obtenidos del controlador -->
                <?php foreach ($ventas as $venta) : ?>
                    <tr>
                        <td><?= $venta['FechaVenta'] ?></td>
                        <td><?= $venta['TotalVenta'] ?></td>
                        <td>
                            <a href="../controllers/pedidoController.php?id=<?= $venta['VentaID'] ?>" target="_blank" class="btn btn-primary">
                                <i class="fas fa-file-pdf"></i> Generar PDF
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>