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


    public function updateUnitsCommitted($productId, $quantity) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE productos SET unidades_comprometidas = unidades_comprometidas + ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
        $stmt->close();
    }

    public function updateStock($productId, $quantity) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE productos SET unidades_en_stock = unidades_en_stock - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $productId);
        $stmt->execute();
        $stmt->close();
    }

   
}
?>
