<?php

class CarritoModel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function agregarAlCarrito($productoId, $cantidad, $precioUnitario)
    {
        $subtotal = $cantidad * $precioUnitario;

        $sql = "INSERT INTO carrito_compras (producto_id, cantidad, precio_unitario, subtotal)
                VALUES (:producto_id, :cantidad, :precio_unitario, :subtotal)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':producto_id', $productoId);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio_unitario', $precioUnitario);
        $stmt->bindParam(':subtotal', $subtotal);

        return $stmt->execute();
    }

   
}

?>