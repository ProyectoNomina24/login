<?php
ob_start();
session_start();

require '../Controler/database.php';

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario_id'])) {
    // Obtener los datos del usuario de la base de datos
    $records = $conn->prepare('SELECT identificacion, nombre, apellido, email FROM usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC);

    // Redireccionar si no se encuentra el usuario
    if (!$user) {
        header("Location: login.php");
        exit;
    }
} else {
    // Si no hay una sesión de usuario activa, redirige al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

$Cesantias = isset($_GET['Cesantias']) ? $_GET['Cesantias'] : 0;
$Interes = isset($_GET['Interes']) ? $_GET['Interes'] : 0;
$Prima = isset($_GET['Prima']) ? $_GET['Prima'] : 0;
$Vacaciones = isset($_GET['Vacaciones']) ? $_GET['Vacaciones'] : 0;
$Dias = isset($_GET['Dias']) ? $_GET['Dias'] : 0;
$resultadoTotal = isset($_GET['resultadoTotal']) ? $_GET['resultadoTotal'] : 0;

require_once('../tcpdf/tcpdf.php');

// Crear una clase PDF extendida de FPDF
class PDF extends TCPDF {
    function Header() {
        // Cabecera
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Comprobante de Pago de Liquidacion', 0, 1, 'C');
        $this->Cell(0, 10, 'Usuario', 0, 1, 'C');
        $this->Ln(10);
        $this->Ln(10);
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
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
$pdf->Cell(40, 10, "Identificacion", 1, 0 , "C");
$pdf->Cell(40, 10, "Nombre", 1, 0 , "C");
$pdf->Cell(40, 10, "Apellido", 1, 0 , "C");
$pdf->Cell(70, 10, "Correo", 1, 1 , "C");

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 7, $user['identificacion'], 1, 0, "C");
$pdf->Cell(40, 7, $user['nombre'], 1, 0, "C");
$pdf->Cell(40, 7, $user['apellido'], 1, 0, "C");
$pdf->Cell(70, 7, $user['email'], 1, 1, "C");
$pdf->Ln(10);
$pdf->Ln(10);


// Muestra el salario total obtenido de la URL
$pdf->Cell(0, 10, "Cesantias: $Cesantias", 0, 1);
$pdf->Cell(0, 10, "Intereses de Cesantias: $Interes", 0, 1);
$pdf->Cell(0, 10, "Prima de Servicios: $Prima", 0, 1);
$pdf->Cell(0, 10, "Vacaciones: $Vacaciones", 0, 1);
$pdf->Cell(0, 10, "Dias de Vacaciones: $Dias", 0, 1);
$pdf->Cell(0, 10, "Salario Total: $resultadoTotal", 0, 1);

$pdf->SetProtection(array(), $user['identificacion'], null, null, 'UserPassword');
// Obtener el contenido del búfer de salida y limpiar el búfer
$pdf_content = ob_get_clean();
// Generar el PDF
$pdf->Output('comprobante_liquidacion.pdf', 'D');

?>
