<?php use mvc\routing\routingClass as routing; 
$id = insumoTableClass::ID;
$nombre= insumoTableClass::NOMBRE;
$fabricacion= insumoTableClass::FECHA_FABRICACION;
$vencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$tipo = tipoInsumoTableClass::DESCRIPCION;
$valor = insumoTableClass::VALOR;
$cantidad = insumoTableClass::CANTIDAD;
$stock = insumoTableClass::STOCK_MINIMO;

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
$pdf->Cell(30, 10, utf8_decode('Tipo Insumo'), 1);
$pdf->Cell(43, 10, utf8_decode('Nombre'), 1);
$pdf->Cell(43, 10, utf8_decode('Fecha de Fabricación'), 1);
$pdf->Cell(45, 10, utf8_decode('Fecha de Vencimiento'), 1);
$pdf->Cell(25, 10, utf8_decode('Valor'), 1);
$pdf->Cell(25, 10, utf8_decode('Cantidad'), 1);
$pdf->Cell(30, 10, utf8_decode('Stock Minimo'), 1);

$pdf->Ln();
foreach ($objInsumo as $key) {
    $pdf->Cell(5);
    $pdf->Cell(30, 10, utf8_decode($key->$tipo), 1);
    $pdf->Cell(43, 10, utf8_decode($key->$nombre), 1);
    $pdf->Cell(43, 10, utf8_decode($key->$fabricacion), 1);
    $pdf->Cell(45, 10, utf8_decode($key->$vencimiento), 1);
    $pdf->Cell(25, 10, utf8_decode($key->$valor), 1);
    $pdf->Cell(25, 10, utf8_decode($key->$cantidad), 1);
    $pdf->Cell(30, 10, utf8_decode($key->$stock), 1);
    $pdf->Ln();
}
$pdf->Output();
