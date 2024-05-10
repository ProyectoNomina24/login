<?php
session_start();

require "../Controler/database.php";
require "../fpdf.php";

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario_id'])) {
    // Obtener información del usuario logueado
    $records = $conn->prepare('SELECT identificacion, nombre, apellido, idArea FROM usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $usuario = $records->fetch(PDO::FETCH_ASSOC);

    // Crear PDF
    $pdf = new FPDF("p", "mm", "letter");
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(190, 5, "Comprobante de Liquidacion", 0, 1, "C");

    $pdf->Ln(2);

    $pdf->SetFont("Arial", "B", 6);
    $pdf->Cell(20, 5, "Identificacion", 1, 0 ,  "C");
    $pdf->Cell(40, 5, "Nombre", 1, 0 ,  "C");
    $pdf->Cell(20, 5, "Apellido", 1, 0 , "C");
    $pdf->Cell(20, 5, "ID Area", 1, 0 , "C");
    
    $pdf->Cell(20, 5, "Cesantias", 1, 0 , "C");
    $pdf->Cell(20, 5, "interesesCesantias", 1, 0 , "C");
    $pdf->Cell(20, 5, "primaServicioss", 1, 0 , "C");
    $pdf->Cell(20, 5, "vacaciones", 1, 0 , "C");
    $pdf->Cell(20, 5, "salarioTotalGlobal", 1, 0 , "C");

    $pdf->SetFont("Arial", "", 6);

    $pdf->Ln(5);

    // Mostrar información del usuario logueado en el PDF
    $pdf->Cell(20, 5, $usuario['identificacion'], 1, 0 ,  "C");
    $pdf->Cell(40, 5, $usuario['nombre'], 1, 0 ,  "C");
    $pdf->Cell(20, 5, $usuario['apellido'], 1, 0 , "C");
    $pdf->Cell(20, 5, $usuario['idArea'], 1, 0 , "C");
    
    $pdf->Cell(20, 5, "Cesantias", 1, 0 , "C");
    $pdf->Cell(20, 5, "interesesCesantias", 1, 0 , "C");
    $pdf->Cell(20, 5, "primaServicioss", 1, 0 , "C");
    $pdf->Cell(20, 5, "vacaciones", 1, 0 , "C");
    $pdf->Cell(20, 5, "cesantiasTotalResult", 1, 0 , "C");
    
    $pdf->Ln(5);

   

    // Salida del PDF
    $pdf->Output();

} else {
    // Si el usuario no está logueado, redirigir a la página de login
    header("Location: ../Modelo/login.php");
    exit;
}
?>
 <?php
session_start();

require "../Controler/database.php";
require "../fpdf.php";

// Obtener los resultados de los cálculos enviados desde el cliente
$cesantiasTotal = $_POST["cesantiasTotal"];
$interesesCesantiasTotal = $_POST["interesesCesantiasTotal"];
$primaServiciosTotal = $_POST["primaServiciosTotal"];
$vacacionesTotal = $_POST["vacacionesTotal"];

// Tu código existente aquí...

// Agregar los resultados de los cálculos al PDF
$pdf->SetFont("Arial", "I", 10);
$pdf->Cell(0, 10, $cesantiasTotal, 0, 1);
$pdf->Cell(0, 10, $interesesCesantiasTotal, 0, 1);
$pdf->Cell(0, 10, $primaServiciosTotal, 0, 1);
$pdf->Cell(0, 10, $vacacionesTotal, 0, 1);

// Salida del PDF
$pdf->Output();
?>
