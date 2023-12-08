<?php
session_start();
?>
<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/styless.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
    
    <div id="nav-bg"></div><!--Solo es una division en la página-->

    <div class="About">
        <div class="contenedor__about"><br>
        <br>
            <img src="../assets/imagenes/mis.png" alt="mision">
            <h1>Mision</h1>
            <p>Llevar la felicidad y dulzura al día de nuestros clientes a través de una experiencia extraordinaria.</p><br>
        </div>
        <div class="contenedor__about"><br>
        <br>
            <img src="../assets/imagenes/vision.png" alt="vision">
            <h1>Vision</h1>
            <p>Crear un mejor día dulce y colorido para todos los estudiantes del TecNM en Celaya. Buscando ser el
                destino de varios con experiencia única y deliciosa al satisfacer con las golosinas. </p><br>
        </div>
        <div class="contenedor__about"><br>
        <br>
            <img src="../assets/imagenes/valores.png" alt="valores">
            <h1>Valores</h1>
            <p class="text">Compromiso con la Diversidad: Valoramos la diversidad y la inclusión en todos los aspectos
                de nuestro negocio, promoviendo un ambiente acogedor para todos..</p><br>
        </div>

    </div>
    <?php include("footer.php"); ?>
</body>

</html>