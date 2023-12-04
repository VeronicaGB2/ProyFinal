<?php
    session_start();
    
    require_once '../models/product.php';
    require_once '../models/venta.php';
    require_once '../models/mailer.php';
    if(isset($_POST['action'])){
        if ($_POST['action'] == "updateProduct") { updateProduct(); }
        if ($_POST['action'] == "finCompra") { finCompra(); }
        if ($_POST['action'] == "getCompras") { getCompras(); }
    }

    function updateProduct(){
        try {
                $data= $_POST["data"];
                parse_str($data, $productoArray);
  
                $model = new ProductModel();
                $productId = $productoArray["id"];
                $compromisedQty = $productoArray["cantidad"];
    
                // Agrega información de depuración
                echo "Product ID: $productId, Compromised Quantity: $compromisedQty";
    
                $model->updateUnitsCommitted($productId, $compromisedQty);
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getCompras(){
        try {
            $model = new VentaModel();
            $user = $_SESSION['user'];
            $ventas = $model->getUserVentas($user['id']);
            $ventasArray = array();
    
            foreach ($ventas as $venta) {
                $ventaId = $venta['VentaID'];
    
                // Si el ID de la venta no existe en el array, crea un nuevo elemento
                if (!array_key_exists($ventaId, $ventasArray)) {
                    $ventasArray[$ventaId] = array(
                        'id' => $ventaId,
                        'fecha' => $venta['FechaVenta'],
                        'cliente' => $venta['ClienteID'],
                        'total' => $venta['TotalVenta'],
                        'detalles' => array()
                    );
                }
    
                // Agrega los detalles de la venta al array
                $ventasArray[$ventaId]['detalles'][] = array(
                    'id' => $venta['DetalleID'],
                    'producto' => $venta['producto'],
                    'descripcion' => $venta['descProdcuto'],
                    'cantidad' => $venta['Cantidad'],
                    'precio' => $venta['PrecioUnitario'],
                    'subtotal' => $venta['Subtotal'],
                    'url_imagen' => $venta['url_imagen']
                );
            }
    
            return $ventasArray;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function finCompra(){
        try {
            $cartItems = json_decode($_POST['cartItems'], true);
            $user = $_SESSION['user'];
            $model = new VentaModel();
            $mailer = new MailerModel();
    
            // Inicia el total en 0
            $totalVenta = 0;
    
            foreach ($cartItems as $item) {
                $quantity = $item['quantity'];
                $price = $item['price'];
                $total = $quantity * $price;
    
                // Suma el total de cada ítem al total general de la venta
                $totalVenta += $total;
            }
    
            // Inserta la venta en la base de datos y obtén el ID
            $idVenta = $model->insertVenta($user['id'], $totalVenta);
            // Obtén los detalles del pedido en formato HTML
            $detallePedidoHTML = '<table border="1">
            <tr>
                <th>ID</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>';
            foreach ($cartItems as $item) {
            $detallePedidoHTML .= '<tr>
                <td>' . $item['id'] . '</td>
                <td>' . $item['quantity'] . '</td>
                <td>' . $item['price'] . '</td>
            </tr>';
            }
            $detallePedidoHTML .= '</table>';

            // Envía el correo electrónico de confirmación
            $mailer->sendMail(
            $user['correo'],
            "Confirmacion de pedido #" . $idVenta,
            "Su pedido ha sido confirmado con los siguientes detalles: " . $detallePedidoHTML
            );

           
            // Inserta los detalles de la venta en la base de datos
            foreach ($cartItems as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $total = $quantity * $price;
    
                $model->insertDetalleVenta($idVenta, $productId, $quantity, $price, $total);
    
                // Restablece las unidades comprometidas en el modelo de producto (ajusta según tu lógica)
                $productModel = new ProductModel();
                $productModel->updateUnitsCommitted($productId, -$quantity);
                // Actualiza el stock del producto
                $productModel->updateStock($productId, $quantity);
            }
    
            unset($_SESSION['cart']);
    
            echo "Compra finalizada exitosamente";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    


?>