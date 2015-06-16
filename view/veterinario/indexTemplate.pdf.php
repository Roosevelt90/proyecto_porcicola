<?php
use mvc\routing\routingClass as routing;
class PDF extends FPDF {
// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
// Creación del objeto de la clase heredada
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
//     Salto de línea
$pdf->Ln(80);
//fondo
$pdf->Image(routing::getInstance()->getUrlImg('background.jpg'), 0, 0, 218, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(30, 10, $mensaje, 0, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Cell(20, 10, utf8_encode('Id'), 1);
$pdf->Cell(20, 10, utf8_encode('Peso'), 1);
$pdf->Cell(20, 10, utf8_encode('Edad'), 1);
$pdf->Cell(42, 10, utf8_encode('Fecha de nacimiento'), 1);
$pdf->Cell(30, 10, utf8_encode('Genero'), 1);
$pdf->Cell(30, 10, utf8_encode('Lote'), 1);
$pdf->Cell(30, 10, utf8_encode('Raza'), 1);
$pdf->Ln();
foreach ($objAnimal as $key) {
    $pdf->Cell(20, 10, utf8_encode($key->id), 1);
    $pdf->Cell(20, 10, utf8_encode($key->peso_animal), 1);
    $pdf->Cell(20, 10, utf8_encode($key->edad_animal), 1);
    $pdf->Cell(42, 10, utf8_encode($key->fecha_ingreso), 1);
    $pdf->Cell(30, 10, utf8_encode($key->nombre_genero), 1);
    $pdf->Cell(30, 10, utf8_encode($key->nombre_lote), 1);
    $pdf->Cell(30, 10, utf8_encode($key->nombre_raza), 1);
    $pdf->Ln();
}
$pdf->Output();
