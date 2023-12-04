<?php
require_once '../config/connection.php';

class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAllProducts()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->query("SELECT * FROM productos");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function updateUnitsCommitted($productId, $quantity)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE productos SET unidades_comprometidas = unidades_comprometidas + ? WHERE id = ?");
        $stmt->execute([$quantity, $productId]);
    }

    public function updateStock($productId, $quantity)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("UPDATE productos SET unidades_en_stock = unidades_en_stock - ? WHERE id = ?");
        $stmt->execute([$quantity, $productId]);
    }

    public function getMostSellableProducts($fecha_inicio, $fecha_fin)
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT
                                    p.id AS id_producto,
                                    p.nombre AS nombre_producto,
                                    SUM(dv.Cantidad) AS total_vendido
                                FROM
                                    detalles_venta dv
                                JOIN
                                    ventas v ON dv.VentaID = v.VentaID
                                JOIN
                                    productos p ON dv.ProductoID = p.id
                                WHERE
                                    v.FechaVenta BETWEEN ? AND ?
                                GROUP BY
                                    p.id, p.nombre
                                ORDER BY
                                    total_vendido DESC;
            ");
            
            $stmt->execute([$fecha_inicio, $fecha_fin]);
            
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {

            throw new Exception("Error al obtener los productos más vendidos: " . $e->getMessage());
        }
    }
}
