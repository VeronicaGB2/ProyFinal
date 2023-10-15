<?php
require_once '../config/connection.php';

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

   
    public function getAllProducts() {
        $conn = $this->db->getConnection();
        $result = $conn->query("SELECT * FROM productos");
        $products = [];

        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }

    
}
?>
