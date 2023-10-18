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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    function editar(idMjs, nombre, descripcion, precio, unidades, punto, compr, costo, ImagenURL) {
        document.getElementById('hddId').value = idMjs;
        document.getElementById('txtNombre').value = nombre;
        document.getElementById('txtDesc').value = descripcion;
        document.getElementById('txtPrecio').value = precio;
        document.getElementById('txtUniS').value = unidades;
        document.getElementById('txtPuntoOrd').value = punto;
        document.getElementById('txtUniComp').value = compr;
        document.getElementById('txtCosto').value = costo;
        // Lógica adicional para manejar la URL de la imagen si es necesario.
        // document.getElementById('imgPreview').src = ImagenURL;
        var formData = $('#frmMensaje').serialize();
        $.ajax({
            type: "POST",
            url: "../controllers/funController.php?opc=2",
            data: formData,
            success: function(data) {
                $('#tbproductos').html(data);
            },
        })
    }

    function insertar() {
        var formData = $('#frmMensaje').serialize();
        $.ajax({
            type: "POST",
            url: "../controllers/funController.php?opc=1",
            data: formData,
            success: function(data) {
                $('#tbproductos').html(data);
            },
        })
    }

    function eliminar(idMsj) {
        $.ajax({
            type: "POST",
            url: "../controllers/funController.php?opc=3",
            data: {
                idMsj: idMsj
            },
            success: function(data) {
                $('#resAJAX').html(data);
            },
        })
    }
    </script>
</head>

<body>
    <div id="nav-bg"></div>
    <main>
        <main>
            <div class="contactus container">
                <h3>Ingresa Productos <div id="resAJAX"></div>
                </h3>
                <form id="frmMensaje" action="adminproducto.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="hddId" name="hddId">
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtDesc">Descripción</label>
                        <input type="text" id="txtDesc" name="txtDesc" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtPrecio">Precio</label>
                        <input type="text" id="txtPrecio" name="txtPrecio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtUniS">Unidades en Stock</label>
                        <input type="text" id="txtUniS" name="txtUniS" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtPuntoOrd">Punto reOrden</label>
                        <input type="text" id="txtPuntoOrd" name="txtPuntoOrd" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtUniComp">Unidades comprometidas</label>
                        <input id="txtUniComp" name="txtUniComp" rows="txtUniComp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtCosto">Costo</label>
                        <input id="txtCosto" name="txtCosto" rows="txtCosto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fileImg">Imagen</label>
                        <input type="file" id="fileImg" name="fileImg" rows="fileImg" class="form-control"
                            enctype="multipart/form-data">
                    </div>
                    <button type="button" onclick="insertar()" class="btn btn-secondary">Registrar</button>
                </form>

                <table class="table table-responsive">
                    <!--Es una tabla que va ingresar los datos de la tabla de la bd-->
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
                        </tr>
                    </thead>
                    <tbody id="tbproductos">

                    </tbody>
                </table>
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