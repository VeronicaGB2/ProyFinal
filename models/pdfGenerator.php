<?php
ob_start(); // Almacena en búfer la salida
require_once '../vendor/autoload.php';
require_once '../models/venta.php';
use TCPDF;

class PDFGenerator {
    public function generatePDF($ventaId) {
        // Obtén los datos de la venta
        $ventasModel = new VentaModel(); 
        $ventas = $ventasModel->getPDFVenta($ventaId);
   
        // Inicializa TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();

        // Establece el título del PDF
        $pdf->SetTitle("Detalles del pedido - #$ventaId");

        // Agrega contenido al PDF
        $html = '<h1>Detalles del pedido - #' . $ventaId . '</h1>';
        $html .= '<table border="1">
                    <tr>
                        
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>';

        foreach ($ventas as $venta) {
            $html .= '<tr>
                        
                        <td>' . $venta['FechaVenta'] . '</td>
                        <td>' . $venta['nombre'] . '</td>
                        <td>' . $venta['Cantidad'] . '</td>
                        <td>' . $venta['precio'] . '</td>
                        <td>' . $venta['Subtotal'] . '</td>
                    </tr>';
        }

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Guarda el PDF en el servidor o descárgalo al navegador
        $pdf->Output('detalles_pedido_' . $ventaId . '.pdf', 'D'); // 'D' para descargar, 'F' para guardar en el servidor
    }
}


?>
