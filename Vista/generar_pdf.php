<?php
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


require('../fpdf/fpdf.php');

// Crear una clase PDF extendida de FPDF
class PDF extends FPDF {
    function Header() {
        // Cabecera
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Comprobante de Pago', 0, 1, 'C');
        $this->Cell(0, 10, 'Usuario', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear un nuevo objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Agregar la imagen en el centro
$pdf->Image('../imagenes/moneda.png', 40, 40, 120);

// Agregar el contenido al PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, "Identificacion", 1, 0 , "C");
$pdf->Cell(40, 10, "Nombre", 1, 0 , "C");
$pdf->Cell(40, 10, "Apellido", 1, 0 , "C");
$pdf->Cell(70, 10, "Correo", 1, 1 , "C");

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 7, $user['identificacion'], 1, 0, "C");
$pdf->Cell(40, 7, $user['nombre'], 1, 0, "C");
$pdf->Cell(40, 7, $user['apellido'], 1, 0, "C");
$pdf->Cell(70, 7, $user['email'], 1, 1, "C");
$pdf->Cell(0, 10, "Salario: $Salario", 0, 1);
$pdf->Cell(0, 10, "Auxilio de Transporte: $Auxiliot", 0, 1);
$pdf->Cell(0, 10, "Extras: $Extra", 0, 1);
$pdf->Cell(0, 10, "Otras Deducciones: $Deduccion", 0, 1);
$pdf->Cell(0, 10, "Total a Pagar: $totalAPagar", 0, 1);

// Generar el PDF
$pdf->Output('comprobante_pago.pdf', 'D');

?>
