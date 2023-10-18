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
            <div class="col-lg-4 h-100 col-md-3 col-sm-4 ">
                <div class="box card ">
                <div class="info">
                <h3>' . $product['nombre'] . '</h3>
                <p><span>' . $product['precio'] . '</span> MXN</p>
              </div>
                    <div class="box cardImg">
                        <img src="../assets' . $product['url_imagen'] . '" alt="' . $product['nombre'] . '">
                        <br>
                        <div class="form-container"> 
                          <div class="row">
                            <form method="post" action="" id="productForm_' . $index . '">
                              <input type="hidden" name="id" value="' . $product['id'] . '">
                              <input type="hidden" name="nombre" value="' . $product['nombre'] . '">
                              <input type="hidden" name="precio" value="' . $product['precio'] . '">
                              <label for="cantidad">Cantidad:</label>
                              <input type="number" name="cantidad" value="0" min="1" >
                              <button type="submit" name="agregar_al_carrito" class="btn btn-primary add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                              </button>
                            </form>
                          </div> 
                        </div>
                        
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