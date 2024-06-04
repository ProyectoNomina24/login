<?php
ob_start();
session_start();

require '../Controler/database.php';

if (isset($_SESSION['usuario_id'])) {
    
    $records = $conn->prepare('SELECT identificacion, nombre, apellido, email FROM usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Si no se encuentra ningún usuario con el ID de sesión, redirige al usuario a la página de inicio de sesión
        header("Location: login.php");
        exit;
    }
    
} else {
    // Si no hay una sesión de usuario activa, redirige al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

// Verificar si los valores están definidos en la URL y asignarles un valor predeterminado si no lo están
$totalAPagar = isset($_GET['totalAPagar']) ? $_GET['totalAPagar'] : 0;
$Salario = isset($_GET['Salario']) ? $_GET['Salario'] : 0;
$Auxiliot = isset($_GET['Auxiliot']) ? $_GET['Auxiliot'] : 0;
$Extra = isset($_GET['Extra']) ? $_GET['Extra'] : 0;
$Deduccion = isset($_GET['Deduccion']) ? $_GET['Deduccion'] : 0;


require_once('../tcpdf/tcpdf.php');

// Crear una clase PDF extendida de FPDF
class PDF extends TCPDF {
    function Header() {
        // Cabecera
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Comprobante de Pago de Nomina', 0, 1, 'C');
        $this->Cell(0, 10, 'Usuario', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'My Nomina 2024 ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AddPage();

$pdf->Ln(10);
$pdf->Ln(10);
$pdf->Ln(10);


// Agregar el contenido al PDF
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, '', 0, 1, 'C'); // Celda vacía para centrar
$pdf->Cell(40, 10, "Identificacion", 1, 0 , "C");
$pdf->Cell(50, 10, "Nombre", 1, 0 , "C");
$pdf->Cell(50, 10, "Apellido", 1, 0 , "C");
$pdf->Cell(55, 10, "Correo", 1, 1 , "C");

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 7, $user['identificacion'], 1, 0, "C");
$pdf->Cell(50, 7, $user['nombre'], 1, 0, "C");
$pdf->Cell(50, 7, $user['apellido'], 1, 0, "C");
$pdf->Cell(55, 7, $user['email'], 1, 1, "C");
$pdf->Ln(10);
$pdf->Ln(10);
$pdf->Cell(0, 10, "Salario: $Salario", 0, 1);
$pdf->Cell(0, 10, "Auxilio de Transporte: $Auxiliot", 0, 1);
$pdf->Cell(0, 10, "Extras: $Extra", 0, 1);
$pdf->Cell(0, 10, "Otras Deducciones: $Deduccion", 0, 1);
$pdf->Cell(0, 10, "Total a Pagar: $totalAPagar", 0, 1);

$pdf->SetProtection(array(), $user['identificacion'], null, null, 'UserPassword');

$pdf_content = ob_get_clean();
// Generar el PDF
$pdf->Output('comprobante_pago.pdf', 'D');

?>
