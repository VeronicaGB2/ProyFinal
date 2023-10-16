<?php
error_reporting(E_ALL);
require_once '../models/product.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

  
    public function getAllProducts() {
        return $this->model->getAllProducts();
    }

    public function updateProduct() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $productId = $_POST["id"];
                $compromisedQty = $_POST["cantidad"];
    
                // Agrega información de depuración
                echo "Product ID: $productId, Compromised Quantity: $compromisedQty";
    
                $this->model->updateUnitsCommitted($productId, $compromisedQty);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    




}


?>
