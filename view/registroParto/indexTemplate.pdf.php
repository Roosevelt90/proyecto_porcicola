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
$pdf->Image(routing::getInstance()->getUrlImg('reporte_Vertical.jpg'), 0, 0, 318, 300);
// Arial bold 15
$pdf->SetFont('Arial', 'B', 25);
// Movernos a la derecha
$pdf->Cell(80);
// Título
$pdf->Cell(30, 10, $mensaje, 0, 0, 'C');

// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);//usuarios usuarios usuaruis
$pdf->Cell(30, 10, utf8_encode('Id'), 1);
$pdf->Cell(20, 10, utf8_encode('nacimiento'), 1);
$pdf->Cell(30, 10, utf8_encode('hembras_vivas'), 1);
$pdf->Cell(30, 10, utf8_encode('machos_vivos'), 1);
$pdf->Cell(20, 10, utf8_encode('muertos'), 1);
$pdf->Cell(20, 10, utf8_encode('animal'), 1);
$pdf->Cell(20, 10, utf8_encode('raza'), 1);

$pdf->Ln();
foreach ($objParto as $key) {
    $pdf->Cell(10);
    $pdf->Cell(30, 10, utf8_encode($key->id), 1);
    $pdf->Cell(20, 10, utf8_encode($key->fecha_nacimiento), 1);
    $pdf->Cell(30, 10, utf8_encode($key->hembras_nacidas_vivas), 1);
    $pdf->Cell(30, 10, utf8_encode($key->machos_nacidos_vivos), 1);
    $pdf->Cell(20, 10, utf8_encode($key->nacidos_muertos), 1);
    $pdf->Cell(20, 10, utf8_encode($key->animal_id), 1);
    $pdf->Cell(20, 10, utf8_encode($key->raza_id), 1);
    
    $pdf->Ln();
}

$pdf->Output();
