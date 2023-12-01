<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../assets/css/styless.css">
  <link rel="stylesheet" href="../assets/css/estilos.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<header>
  <nav>
    <div class="container1">
      <div class="fontawesome-cog" id="icon"></div>
      <ul>
        <li>
          <a href="../index.php">Inicio</a>
        </li>
        <li>
          <a href="productos.php">Productos</a>
        </li>
          <a href="about.php">Acerca de</a>
        </li>
        <li>
          <a href="ubicacion.php">Ubicacion</a>
        </li>
        <li>
          <a href="carrito.php">
            <i class="fa fa-shopping-cart"></i>
            <span class="cart-count">
              <?php
              echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
              ?>
            </span>
          </a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container1">
    <h1 class="titulo">Tienda de Vero</h1>
  </div>
</header>