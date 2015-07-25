<?php
use mvc\routing\routingClass as routing;
$tipo_doc= tipoDocumentoTableClass::DESCRIPCION;
$numero_documento= empleadoTableClass::NUMERO_DOC;
$nombre = empleadoTableClass::NOMBRE;
$cargo_id = cargoTableClass::DESCRIPCION;
$telefono = empleadoBaseTableClass::TEL;
$direccion = empleadoTableClass::DIRECCION;
$ciudad = ciudadTableClass::NOMBRE;

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
$pdf->Cell(35, 10, utf8_encode('Tipo Documento'), 1);
$pdf->Cell(43, 10, utf8_encode('Numero Documento'), 1);
$pdf->Cell(43, 10, utf8_encode('Nombre Completo'), 1);
$pdf->Cell(30, 10, utf8_encode('cargo'), 1);
$pdf->Cell(35, 10, utf8_encode('Telefono'), 1);
$pdf->Cell(42, 10, utf8_encode('Direccion'), 1);
$pdf->Cell(30, 10, utf8_encode('Ciudad'), 1);
$pdf->Ln();
foreach ($objEmpleado as $key) {
    $pdf->Cell(5);
    $pdf->Cell(35, 10, utf8_encode($key->$tipo_doc), 1);
    $pdf->Cell(43, 10, utf8_encode($key->$numero_documento), 1);
    $pdf->Cell(43, 10, utf8_encode($key->$nombre), 1);
    $pdf->Cell(30, 10, utf8_encode($key->$cargo_id), 1);
    $pdf->Cell(35, 10, utf8_encode($key->$telefono), 1);
    $pdf->Cell(42, 10, utf8_encode($key->$direccion), 1);
    $pdf->Cell(30, 10, utf8_encode($key->$ciudad), 1);
    $pdf->Ln();
}
$pdf->Output();
