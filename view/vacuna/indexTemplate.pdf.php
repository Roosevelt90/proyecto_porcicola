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
$pdf->Ln(40);
//fondo
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 218, 280);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(90);
// Título
$pdf->Cell(30, 10, $mensaje, 0, 0, 'C');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Cell(-8);

$pdf->Cell(40, 10, utf8_decode('Vacuna'), 1);
$pdf->Cell(20, 10, utf8_decode('Lote'), 1);
$pdf->Cell(38, 10, utf8_decode('Fecha Fabricación'), 1);
$pdf->Cell(38, 10, utf8_decode('Fecha Vencimiento'), 1);
$pdf->Cell(28, 10, utf8_decode('Valor'), 1);
$pdf->Cell(20, 10, utf8_decode('Cantidad'), 1);
$pdf->Cell(28, 10, utf8_decode('Stock Minimo'), 1);
$pdf->Ln();
foreach ($objVacuna as $key) {
    $pdf->Cell(-8);
 
    $pdf->Cell(40, 10, utf8_decode($key->nombre_vacuna), 1);
    $pdf->Cell(20, 10, utf8_decode($key->lote_vacuna), 1);
    $pdf->Cell(38, 10, utf8_decode($key->fecha_fabricacion_vacuna), 1);
    $pdf->Cell(38, 10, utf8_decode($key->fecha_vencimiento_vacuna), 1);
    $pdf->Cell(28, 10, utf8_decode($key->valor_vacuna), 1);
    $pdf->Cell(20, 10, utf8_decode($key->cantidad), 1);
    $pdf->Cell(28, 10, utf8_decode($key->stock_minimo), 1);
    $pdf->Ln();
}//close foreach

$pdf->Output();
