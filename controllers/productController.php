<?php
require_once '../models/product.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

  
    public function getAllProducts() {
        return $this->model->getAllProducts();
    }
}


?>
