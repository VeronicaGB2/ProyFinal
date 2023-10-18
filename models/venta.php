<?php
require_once '../config/connection.php';

class VentaModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function insertVenta($productoId, $cantidad, $precioUnitario, $total) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO ventas (producto_id, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $productoId, $cantidad, $precioUnitario, $total);
        $stmt->execute();
        $stmt->close();
    }
}
?>
