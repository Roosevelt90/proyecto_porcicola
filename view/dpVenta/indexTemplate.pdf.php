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
$pdf->Cell(20, 10, utf8_encode('fecha'), 1);
$pdf->Cell(20, 10, utf8_encode('usuario_id'), 1);
$pdf->Cell(42, 10, utf8_encode('numero_documento'), 1);
$pdf->Cell(30, 10, utf8_encode('peso_animal'), 1);
$pdf->Cell(30, 10, utf8_encode('precio_animal'), 1);
$pdf->Cell(30, 10, utf8_encode('animal_id'), 1);
$pdf->Ln();
foreach ($objdpVenta as $key) {
    $pdf->Cell(20, 10, utf8_encode($key->id), 1);
    $pdf->Cell(20, 10, utf8_encode($key->fecha), 1);
    $pdf->Cell(20, 10, utf8_encode($key->usuario_id), 1);
    $pdf->Cell(42, 10, utf8_encode($key->numero_documento), 1);
    $pdf->Cell(30, 10, utf8_encode($key->peso_animal), 1);
    $pdf->Cell(30, 10, utf8_encode($key->precio_animal), 1);
    $pdf->Cell(30, 10, utf8_encode($key->animal_id), 1);
    $pdf->Ln();
}

$pdf->Output();
