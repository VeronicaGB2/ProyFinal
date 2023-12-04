<?php

define('BASE_URL', 'http://localhost/ProyFinal');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/styless.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/estilos.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</head>
<header>
    <nav>
        <div class="container1">
            <div class="fontawesome-cog" id="icon"></div>
            <ul>
                <li>
                    <a href="<?php echo BASE_URL; ?>/vistas/admin/index.php">Inicio</a>
                </li>

                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == 1) {
                    echo '<li><a href="' . BASE_URL . '/vistas/adminproducto.php">Agregar Productos</a></li>';
                }
                ?>

                <li>
                    <?php
                    if (isset($_SESSION['user'])) {
                        // Si hay una sesión, muestra el botón de logout
                        echo '<a href="' . BASE_URL . '/vistas/logout.php">Logout</a>';
                    } else {
                        // Si no hay una sesión, muestra el enlace de login
                        echo '<a href="' . BASE_URL . '/vistas/login.php">Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container1">
        <h1 class="titulo">Tienda de Vero</h1>
    </div>
</header>