<?php

session_start();
?>


<?php include("header.php"); ?>

<body>




    <div class="container">
        <div class="col-md-12">
            <table class="table table-bordered my-5">
                <tr>
                    <th>ITEM ID</th>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>OPCIONES</th>
                </tr>

                <?php

                $total_price = 0;

                if (!empty($_SESSION['cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['nombre']; ?></td>
                            <td id="price_<?php echo $value['id']; ?>"><?php echo $value['precio']; ?></td>

                            <td>
                                <input type="number" class="quantity" id="quantity" value="<?php echo $value['cantidad']; ?>" data-id="<?php echo $value['id']; ?>">
                            </td>
                            <td>
                                <button class="btn btn-danger remove" id="<?php echo $value['id']; ?>">Eliminar</button>
                            </td>
                        </tr>
                        <?php
                        // Convertir a números antes de la operación aritmética
                        $total_price = $total_price + (floatval($value['cantidad']) * floatval($value['precio']));
                        ?>



                    <?php }
                } else { ?>
                    <tr>
                        <td class="text-center" colspan="5">No se ha agregado ningun producto al carrito</td>
                    </tr>
                <?php }
                ?>

                <tr>
                    <td colspan="2"></td>
                    <td>Total</td>
                    <td class="total-price" id="total-price"><?php echo number_format($total_price, 2); ?></td>

                    <td>
                        <button class="btn btn-warning clearall">Borrar todo</button>
                        <button class="btn btn-success finalizarCompra" id="finalizarCompraBtn">Finalizar compra</button>
                    </td>

                </tr>
            </table>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>



    <script type="text/javascript">
        $(document).ready(function() {

            function updateCartCount() {
                $.ajax({
                    type: "GET",
                    url: "../controllers/carritoController_aux.php",
                    success: function(response) {
                        console.log(response);
                        $(".cart-count").text(response);
                    }
                });
            }

            function updateTotalPrice() {
                var newTotalPrice = 0;

                $(".quantity").each(function() {
                    var id = $(this).data("id");
                    var quantity = $(this).val();
                    var price = parseFloat($("#price_" + id).text());

                    // Verifica si el precio es un número válido antes de sumarlo
                    if (!isNaN(price)) {
                        newTotalPrice += quantity * price;
                    }
                });

                // Update the displayed total
                $(".total-price").text(newTotalPrice.toFixed(2));
            }



            updateCartCount();

            $(".remove").click(function() {
                event.preventDefault();
                var id = $(this).attr("id");

                var action = "remove";

                Swal.fire({
                    title: '¿Seguro de que desea eliminar?',
                    text: "Tendras que buscar el producto y agregarlo nuevamente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: "../controllers/carritoController.php",
                            data: {
                                action: action,
                                id: id
                            },
                            success: function(data) {
                                updateCartCount();

                                Swal.fire(
                                    'Eliminado!',
                                    '',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                })
                            }
                        })

                    }
                })
            });


            $(".quantity").on("change", function() {
                var id = $(this).data("id");
                var newQuantity = $(this).val();

                // Envía una solicitud para actualizar la cantidad en el carrito
                $.ajax({
                    method: "POST",
                    url: "../controllers/carritoController.php",
                    data: {
                        action: "updateQuantity",
                        id: id,
                        quantity: newQuantity
                    },
                    success: function(data) {
                        updateCartCount();
                        updateTotalPrice();
                    }
                });
            });


            $(".clearall").click(function() {

                event.preventDefault()
                var action = "clear";

                Swal.fire({
                    title: '¿Seguro de que desea limpiar el carrito?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: "../controllers/carritoController.php",
                            data: {
                                action: action
                            },
                            success: function(data) {
                                updateCartCount();

                                Swal.fire(
                                    'Eliminado!',
                                    '',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                })
                            }
                        });

                    }
                })


            });

            $(".finalizarCompra").click(function() {
                event.preventDefault();
                console.log("Entre");

                // Obtén la información del carrito
                var cartItems = [];
                $(".quantity").each(function() {
                    var id = $(this).data("id");
                    var quantity = $(this).val();
                    var price = parseFloat($("#price_" + id).text());

                    cartItems.push({
                        id: id,
                        quantity: quantity,
                        price: price
                    });
                });

                // Envía la información al controlador para finalizar la compra
                $.ajax({
                    method: "POST",
                    url: "../controllers/mainController.php",
                    data: {
                        action: "finCompra",
                        cartItems: JSON.stringify(cartItems)
                    },
                    success: function(data) {

                        Swal.fire(
                            'Compra finalizada!',
                            '',
                            'success'
                        ).then(() => {
                            updateCartCount(); // Actualiza el contador de carrito
                            updateTotalPrice(); // Actualiza el precio total
                            location.reload();
                        });



                    }
                });
            });

        });
    </script>
    <?php include("footer.php"); ?>
</body>

</html>