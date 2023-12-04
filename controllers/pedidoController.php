<?php
session_start();
require_once '../models/pdfGenerator.php';

// Verifica si se proporciona un ID de venta en la URL
if (isset($_GET['id'])) {
    $ventaId = $_GET['id'];

    // Uso del generador de PDF
    $pdfGenerator = new PDFGenerator();
    $pdfGenerator->generatePDF($ventaId);
} else {
    echo "ID de venta no proporcionado.";
}
