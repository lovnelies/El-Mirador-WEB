<?php
require('fpdf/fpdf.php');
require('inc/db_config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener datos del pago según el ID
    $query = "SELECT * FROM pagos WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pago = $result->fetch_assoc();

        // Generar el PDF
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'HOTELES Veranum - Informe de Pago', 0, 1, 'C');
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, '----------------------------------------------------------', 0, 1, 'C');
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Detalles del Pago', 0, 1, 'C');
        $pdf->Ln(10); // Salto de línea

        // Información del pago
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'ID del Pago:', 0, 0);
        $pdf->Cell(0, 10, $pago['id'], 0, 1);

        $pdf->Cell(50, 10, 'Concepto del Pago:', 0, 0);
        $pdf->Cell(0, 10, $pago['nombre'], 0, 1);

        $pdf->Cell(50, 10, 'Valor Pagado:', 0, 0);
        $pdf->Cell(0, 10, '$' . number_format($pago['valor'], 2), 0, 1);

        $pdf->Cell(50, 10, 'Fecha de Pago:', 0, 0);
        $pdf->Cell(0, 10, $pago['fecha'], 0, 1);

        // Nombre del archivo PDF
        $nombreArchivo = 'informe_pago_' . $pago['id'] . '.pdf';

        // Forzar descarga del PDF
        $pdf->Output('D', $nombreArchivo);
    } else {
        echo "Pago no encontrado.";
    }

    $stmt->close();
} else {
    echo "ID de pago no proporcionado.";
}
?>
