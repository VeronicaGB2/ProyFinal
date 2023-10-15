<?php include("header.php"); ?>

<body>

  <!--seccion de mostrado de lo nuevo-->
  <div class="contenedor" id="secAreas">
    <h3>Más productos de la tienda</h3>
    <div class="productos">
      <?php
      // Incluir la clase del modelo y el controlador
      require_once '../models/product.php';
      require_once '../controllers/productController.php';



      $controller = new ProductController();

      // Obtener todos los productos
      $products = $controller->getAllProducts();


      echo '<div class="row d-flex justify-content-center container">'; // Open a Bootstrap row

      // Mostrar cada producto
      foreach ($products as $index => $product) {
        echo '
            <div class="col-lg-4 col-md-3 col-sm-4 ">
                <div class="box card">
                    <div class="box cardImg">
                        <img src="../assets' . $product['url_imagen'] . '" alt="' . $product['nombre'] . '">
                        <div class="form-container"> 
                            <form method="post" action="" id="productForm_' . $index . '">
                            <div class="row">
                            <input type="hidden" name="id" value="' . $product['id'] . '">
                            <input type="hidden" name="nombre" value="' . $product['nombre'] . '">
                            <input type="hidden" name="precio" value="' . $product['precio'] . '">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" value="0" min="1">
                            <button type="submit" name="agregar_al_carrito" class="btn btn-primary add"><i class="bi bi-cart"></i></button>
                        </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="info">
                      <h3>' . $product['nombre'] . '</h3>
                      <p><span>' . $product['precio'] . '</span> USD</p>
                    </div>
                </div>
            </div>
        ';
      }

      echo '</div>'; // Close the Bootstrap row


      ?>

    </div>
  </div>



  <?php include("footer.php"); ?>

</body>

</html>