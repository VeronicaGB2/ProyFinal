<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./assets/css/styless.css">
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
    <?php include("header.php"); ?>
    <div id="nav-bg"></div>

    <div class="contenedor" id="secAreas">
        <h3>RICAS Y DELICIOSAS GOMITAS</h3>
        <div class="productos">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box card">
                    <div class="box cardImg">
                        <img src="../assets/imagenes/Mangos.png" alt="Manguitos enchilados">
                    </div>
                    <div class="info">
                        <h3>Manguitos</h3>
                        <p><span>150</span> USD</p>
                        <button class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box card">
                    <div class="box cardImg">
                        <img src="../assets/imagenes/Panditas.png" alt="Panditas">
                    </div>
                    <div class="info">
                        <h3>Panditas</h3>
                        <p><span>150</span> USD</p>
                        <button class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box card">
                    <div class="box cardImg">
                        <img src="../assets/imagenes/Viboritas.png" alt="Panditas">
                    </div>
                    <div class="info">
                        <h3>Viboritas</h3>
                        <p><span>150</span> USD</p>
                        <button class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            </div>

        </div>


        <?php include("footer.php"); ?>

</body>

</html>