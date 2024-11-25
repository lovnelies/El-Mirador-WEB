<?php
session_start();
require('fpdf/fpdf.php');
require('inc/db_config.php');
require('inc/essentials.php');


// Datos de conexión a la base de datos
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'miradordb';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

// Función para insertar un pago en la base de datos
function insertarPago($nombre, $valor, $conn) {
    $sql = "INSERT INTO pagos (nombre, valor, fecha) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $nombre, $valor);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

// Procesar formulario de pago
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre']; // Nombre del pago o concepto
    $valor = $_POST['valor'];   // Valor del pago

    // Insertar el pago en la base de datos
    if (insertarPago($nombre, $valor, $con)) {
        // Generar el PDF con el comprobante de pago
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'El mirador - Comprobante de Pago', 0, 1, 'C');
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
        $pdf->Cell(0, 10, 'Pago realizado exitosamente!', 0, 1, 'C');
        $pdf->Ln(10); // Salto de línea

        // Detalles del pago
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'Nombre usuario:', 0, 0);
        $pdf->Cell(0, 10, $nombre, 0, 1);

        $pdf->Cell(50, 10, 'Valor Pagado:', 0, 0);
        $pdf->Cell(0, 10, '$' . number_format($valor, 2), 0, 1);

        $pdf->Cell(50, 10, 'Fecha de Pago:', 0, 0);
        $pdf->Cell(0, 10, date('Y-m-d H:i:s'), 0, 1);

        // Nombre del archivo PDF
        $nombreArchivo = 'comprobante_pago_' . date('Ymd_His') . '.pdf';

        // Forzar descarga del PDF
        $pdf->Output('D', $nombreArchivo);
        exit;
    } else {
        echo "Error al procesar el pago. Por favor, inténtalo de nuevo.";
    }
}
?>
