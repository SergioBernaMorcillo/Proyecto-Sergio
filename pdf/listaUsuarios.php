<?php
require('fpdf/fpdf.php');

require_once("../Clases/Usuario.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 23);
$pdf->Cell(0, 15, "Usuarios registrados en MemeLon", 'B', 0, 'C', false);
$pdf->Ln(35);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(241, 196, 53);
$pdf->Cell(10, 6, "ID", 'B', 0, 'C', true);
$pdf->Cell(55, 6, "Nombre y apellidos", 'B', 0, 'C', true);
$pdf->Cell(75, 6, "Email", 'B', 0, 'C', true);
$pdf->Cell(30, 6, utf8_decode("Contraseña"), 'B', 0, 'C', true);
$pdf->Cell(20, 6, "Tipo", 'B', 0, 'C', true);
$pdf->Ln();

$numero=0;
$usu = new Usuario();
$usuarios = $usu->get_todos(); //cojo todas las publicaciones
foreach ($usuarios as $key => $value) {
   
    if($numero%2==0){
        $pdf->SetFillColor(255, 255, 255);
    }else{
        $pdf->SetFillColor(224, 224, 218);
    }
    $numero++;
    $pdf->Cell(10, 10, utf8_decode($value['id_usuario']), 'B', 0, 'C', true);
    $pdf->Cell(55, 10,  utf8_decode($value['nombre'])." " .utf8_decode($value['apellidos']), 'B', 0, 'C', true);
    $pdf->Cell(75, 10,  utf8_decode($value['email']), 'B', 0, 'C', true);
    $pdf->Cell(30, 10,  utf8_decode($value['pas']), 'B', 0, 'C', true);
    if($value['tipoUsr'] == "admin"){
        $pdf->SetTextColor(13, 140, 15);
    }else{
        $pdf->SetTextColor(0, 0, 255);
    }
    $pdf->Cell(20, 10,  utf8_decode($value['tipoUsr']), 'B', 0, 'C', true);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln();
}
    $pdf->Output('D','Lista de usuarios.pdf');
 ?>