<?php

use mvc\routing\routingClass as routing;
$ciudad = datosUsuarioTableClass::CIUDAD_ID;

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
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 318, 300);
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
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);//usuarios usuarios usuaruis
$pdf->Cell(20, 10, utf8_encode('Id'), 1);
//$pdf->Cell(20, 10, utf8_encode('ciudad'), 1);
$pdf->Cell(30, 10, utf8_encode('nombre'), 1);
$pdf->Cell(30, 10, utf8_encode('apellido '), 1);
$pdf->Cell(30, 10, utf8_encode('identificacion '), 1);
$pdf->Cell(20, 10, utf8_encode('ciudad '), 1);
$pdf->Cell(20, 10, utf8_encode('telefono '), 1);
$pdf->Cell(42, 10, utf8_encode('direccion '), 1);
$pdf->Ln();
foreach ($objDatos as $key) {
    $pdf->Cell(20, 10, utf8_encode($key->id), 1);
//    $pdf->Cell(20, 10, utf8_encode($key->ciudad_id), 1);
    $pdf->Cell(30, 10, utf8_encode($key->nombre), 1);
    $pdf->Cell(30, 10, utf8_encode($key->apellidos), 1);
    $pdf->Cell(30, 10, utf8_encode($key->numero_documento), 1);
    $pdf->Cell(20, 10, utf8_encode($key->ciudad_id), 1);
    $pdf->Cell(20, 10, utf8_encode($key->telefono), 1);
    $pdf->Cell(42, 10, utf8_encode($key->direccion), 1);
    ciudadTableClass::getNameCiudad($key->$ciudad);
    $pdf->Ln();
}

$pdf->Output();
