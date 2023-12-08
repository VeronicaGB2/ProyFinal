<?php
require_once '../config/connection.php';

class VentaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function insertVenta($clienteID, $total, $id_recibo)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO ventas (ClienteID, TotalVenta, pago) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $clienteID);
        $stmt->bindParam(2, $total);
        $stmt->bindParam(3, $id_recibo);
        $stmt->execute();
        $lastInsertId = $conn->lastInsertId();
        $stmt->closeCursor();

        return $lastInsertId;
    }


    public function insertDetalleVenta($ventaId, $productoId, $cantidad, $precioUnitario, $total)
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO detalles_venta (VentaID, ProductoID, Cantidad, PrecioUnitario, Subtotal) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $ventaId);
            $stmt->bindParam(2, $productoId);
            $stmt->bindParam(3, $cantidad);
            $stmt->bindParam(4, $precioUnitario);
            $stmt->bindParam(5, $total);
            $stmt->execute();
            $stmt->closeCursor();

            // Verifica si la inserción fue exitosa
            if ($stmt->rowCount() > 0) {
                echo "Inserción exitosa";
            } else {
                echo "No se insertaron filas";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserVentas($userId)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT *
                                FROM ventas 
                                
                                WHERE ClienteID = ?");
        $stmt->execute([$userId]);
        $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ventas;
    }

    public function getPDFVenta($ventaId)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT *
                                FROM ventas 
                                INNER JOIN detalles_venta ON ventas.VentaID = detalles_venta.VentaID
                                INNER JOIN productos ON detalles_venta.ProductoID = productos.id
                                WHERE ventas.VentaID = ?");
        $stmt->execute([$ventaId]);
        $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ventas;
    }   
}
