<?php include("header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/styless.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function limpiarFormulario() {

            document.getElementById('txtNombre').value = '';
            document.getElementById('txtDesc').value = '';
            document.getElementById('txtPrecio').value = '';
            document.getElementById('txtUniS').value = '';
            document.getElementById('txtPuntoOrd').value = '';
            document.getElementById('txtUniComp').value = '';
            document.getElementById('txtCosto').value = '';

        }

        function editar(idMjs, nombre, descripcion, precio, unidades, punto, compr, costo, ImagenURL) {
            document.getElementById('hddId').value = idMjs;
            document.getElementById('txtNombre').value = nombre;
            document.getElementById('txtDesc').value = descripcion;
            document.getElementById('txtPrecio').value = precio;
            document.getElementById('txtUniS').value = unidades;
            document.getElementById('txtPuntoOrd').value = punto;
            document.getElementById('txtUniComp').value = compr;
            document.getElementById('txtCosto').value = costo;
            document.getElementById('url_imagen').value = ImagenURL;
            console.log("Función editar llamada con:", {
                idMjs,
                nombre,
                descripcion,
                precio,
                unidades,
                punto,
                compr,
                costo,
                ImagenURL
            });
            return;

        }

        function refreshTable() {
            $.ajax({
                type: "POST",
                data: {},
                url: "../controllers/funController.php?opc=4",
                success: function(data) {
                    $('#tbproductos').html(data);
                }
            })
        }

        function insertar() {
            var idMjs = document.getElementById('hddId').value;

            if (idMjs === '') {
                var formData = new FormData($('#frmMensaje')[0]);

                $.ajax({
                    type: "POST",
                    url: "../controllers/funController.php?opc=1",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        Swal.fire(
                            'Producto registrado con éxito!',
                            '',
                            'success'
                        ).then(() => {
                            refreshTable();
                            limpiarFormulario();
                        })

                    },
                });
            } else {
                var formData = new FormData($('#frmMensaje')[0]);
                $.ajax({
                    type: "POST",
                    url: "../controllers/funController.php?opc=2",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        Swal.fire(
                            'Producto actualizado con éxito!',
                            '',
                            'success'
                        ).then(() => {
                            refreshTable();
                            limpiarFormulario();
                        })
                    },
                });
            }
        }



        function eliminar(idMsj) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../controllers/funController.php?opc=3",
                        data: {
                            idMsj: idMsj
                        },
                        success: function(data) {
                            Swal.fire(
                               // '¡Eliminado!',
                                //'Producto eliminado con exito',
                                //'success'
                            ).then(() => {
                                refreshTable();
                            })

                        },
                    })

                }
            })

        }
    </script>
</head>

<body>
    <div id="nav-bg"></div>
    <main>
        <div class="container">
            <div class="row">
                <!-- Formulario -->
                <aside class="col-md-5">
                    <div class="contactus">
                        <h3>Ingresa Productos <div id="resAJAX"></div>
                        </h3>
                        <form id="frmMensaje" action="adminproducto.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="hddId" name="hddId">
                            <input type="hidden" id="url_imagen" name="url_imagen">
                            <div class="row">
                                <!-- Columna 1 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtNombre">Nombre</label>
                                        <input type="text" required id="txtNombre" name="txtNombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtDesc">Descripción</label>
                                        <input type="text" required id="txtDesc" name="txtDesc" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtPrecio">Precio</label>
                                        <input type="number" required min="1" id="txtPrecio" name="txtPrecio" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUniS">Unidades en Stock</label>
                                        <input type="number" required min="1" id="txtUniS" name="txtUniS" class="form-control">
                                    </div>
                                </div>

                                <!-- Columna 2 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtPuntoOrd">Punto reOrden</label>
                                        <input type="number" required min="1" id="txtPuntoOrd" name="txtPuntoOrd" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUniComp">Unidades comprometidas</label>
                                        <input id="txtUniComp" required min="1" type="number" name="txtUniComp" rows="txtUniComp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtCosto">Costo</label>
                                        <input id="txtCosto" required min="1" type="number" name="txtCosto" rows="txtCosto" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="fileImg">Imagen</label>
                                        <input type="file" id="fileImg" required name="fileImg" rows="fileImg" class="form-control" enctype="multipart/form-data">
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="insertar()" class="btn btn-success">Registrar</button>
                        </form>
                    </div>
                </aside>

                <!-- Tabla -->
                <div class="col-md-7">
                    <table class="table table-responsive">
                        <!-- Tabla de productos -->
                        <thead style="background-color:gray;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Unidades Stock</th>
                                <th scope="col">Punto reOrden</th>
                                <th scope="col">Unidades comprometidas</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbproductos">
                            <!-- Contenido de la tabla -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>




</html>
<script>
    $(document).ready(function() {
        //alert('holas');
        $.ajax({
            type: "POST",
            data: {},
            url: "../controllers/funController.php?opc=4",
            success: function(data) {
                $('#tbproductos').html(data);
            }
        })
    });
</script>