<?php
    session_start();
    require_once '../models/product.php';
    require_once '../models/venta.php';

    if(isset($_POST['action'])){
        if ($_POST['action'] == "updateProduct") { updateProduct(); }
        if ($_POST['action'] == "finCompra") { finCompra(); }
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

    function finCompra(){
        try {
            $cartItems = json_decode($_POST['cartItems'], true);
    
            $model = new VentaModel();
    
            foreach ($cartItems as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $total = $quantity * $price;
    
                // Inserta la venta en la base de datos
                $model->insertVenta($productId, $quantity, $price, $total);
    
                // Restablece las unidades comprometidas en el modelo de producto (puedes ajustar esto según tu lógica)
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