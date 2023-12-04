<?php
    session_start();
    
  
    require_once '../models/product.php';

    if(isset($_POST['action'])){
        if ($_POST['action'] == "prodMas") { getMasVendidos(); }
    }

    function getMasVendidos(){
        try {
            $model = new ProductModel();
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $productos = $model->getMostSellableProducts($fechaInicio, $fechaFin);

            echo json_encode($productos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }