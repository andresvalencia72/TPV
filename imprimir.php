<?php
require_once("./librerias/fpdf/fpdf.php");
require_once("funciones.php");

// datos de las consumiciones
$consumiciones = unserialize($_POST['consumiciones']);

// generación pdf

$pdf = new FPDF('P','mm',array(80,210));
$pdf->AddPage();
$pdf->Image('./img/Logo.png',15,15,50);
$pdf->SetFont('arial','b',16);
$pdf->SetTextColor(82,86,89);
$pdf->SetFillColor(244, 208, 100);
$pdf->SetXY(6,50);

foreach($consumiciones as $indice  => $valor){
    $texto = "nombre: ".$valor['nombre'];
    $pdf->Cell(0,10,$texto,1,2,'L',true);
    $texto = "cantidad: ".$valor['cantidad'];
    $pdf->Cell(0,10,$texto,1,2,"L",true);
    $texto = "precio: ".$valor['precio'];
    $pdf->Cell(0,10,$texto,1,2,"L",true);
}
$pdf->Output()
?>