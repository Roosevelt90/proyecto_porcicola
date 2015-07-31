<?php use mvc\routing\routingClass as routing; 
$id = insumoTableClass::ID;
$nombre= insumoTableClass::NOMBRE;
$fabricacion= insumoTableClass::FECHA_FABRICACION;
$vencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$tipo = tipoInsumoTableClass::DESCRIPCION;
$valor = insumoTableClass::VALOR;


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
$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
//     Salto de línea
$pdf->Ln(40);
//fondo
$pdf->Image(routing::getInstance()->getUrlImg('reporte_horizontal.jpg'), 0, 0, 218, 300);
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
$pdf->Cell(5);
$pdf->Cell(35, 10, utf8_encode('Tipo Insumo'), 1);
$pdf->Cell(43, 10, utf8_encode('Nombre'), 1);
$pdf->Cell(43, 10, utf8_encode('Fecha de Fabricacion'), 1);
$pdf->Cell(45, 10, utf8_encode('Fecha de Vencimiento'), 1);
$pdf->Cell(42, 10, utf8_encode('Valor'), 1);

$pdf->Ln();
foreach ($objInsumo as $key) {
    $pdf->Cell(5);
    $pdf->Cell(35, 10, utf8_encode($key->$tipo), 1);
    $pdf->Cell(43, 10, utf8_encode($key->$nombre), 1);
    $pdf->Cell(43, 10, utf8_encode($key->$fabricacion), 1);
    $pdf->Cell(45, 10, utf8_encode($key->$vencimiento), 1);
    $pdf->Cell(42, 10, utf8_encode($key->$valor), 1);
    $pdf->Ln();
}
$pdf->Output();
