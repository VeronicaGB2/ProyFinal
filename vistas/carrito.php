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
                            <td><?php echo $value['precio']; ?></td>
                            <td><?php echo $value['cantidad']; ?></td>
                            <td>
                                <button class="btn btn-danger remove" id="<?php echo $value['id']; ?>">Eliminar</button>
                            </td>
                        </tr>

                        <?php $total_price = $total_price + $value['cantidad'] * $value['precio']; ?>



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
                    <td><?php echo number_format($total_price, 2); ?></td>
                    <td>
                        <button class="btn btn-warning clearall">Borrar todo</button>
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

            updateCartCount();

            $(".remove").click(function() {
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


            $(".clearall").click(function() {

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
        });
    </script>
    <?php include("footer.php"); ?>
</body>

</html>