<?php

use mvc\routing\routingClass as routing;
$nombreVacuna = vacunaTableClass::NOMBRE_VACUNA;
$nombreVeterinario = veterinarioTableClass::NOMBRE;
$num_animal = animalTableClass::NUMERO;
class PDf extends FPDF {

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF('L', 'mm', 'letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$image = $pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 280, 215);


$pdf->Ln(30);
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(70);
$pdf->Cell(130, 10, $mensajeDetalle, 0, 0, 'C');


$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(70);
$pdf->Cell(20, 10, utf8_encode('N.'), 1, 0, 'C');
$pdf->Cell(60, 10, utf8_encode('Fecha'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_encode('Animal'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_encode('Veterinario'), 1, 0, 'C');
$pdf->Ln();
foreach ($objVacunacion as $key) {
    $pdf->Cell(70);
    $pdf->Cell(20, 10, utf8_encode($key->id), 1, 0, 'C');
    $pdf->Cell(60, 10, utf8_encode($key->fecha_registro), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_encode($key->$num_animal), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_encode($key->$nombreVeterinario), 1, 0, 'C');
    $pdf->Ln();
}//close foreach
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(50);
$pdf->Cell(20, 10, utf8_encode('Item'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_encode('N.Vacunacion'), 1, 0, 'C');
$pdf->Cell(55, 10, utf8_encode('Fecha Vacunacion'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_encode('Vacuna'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_encode('Dosis'), 1, 0, 'C');
//$pdf->Cell(30, 10, utf8_encode('Accion'), 1, 0, 'C');
$pdf->Ln();
foreach ($objDetalleVacunacion as $key) {
    $pdf->Cell(50);
    $pdf->Cell(20, 10, utf8_encode($key->id), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_encode($key->id_registro), 1, 0, 'C');
    $pdf->Cell(55, 10, date("Y-M-d", strtotime($key->fecha_vacunacion)), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_encode($key->$nombreVacuna), 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_encode($key->dosis_vacuna), 1, 0, 'C');
//    $pdf->Cell(30, 10, utf8_encode($key->id), 1,0,'C');
    $pdf->Ln();
}//close foreach
$pdf->Output();


