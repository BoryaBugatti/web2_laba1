<?php
require 'fpdf/fpdf.php';
require "db.php";
$pdf = new FPDF('P', 'mm', array(350, 500));
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSans.php');
$pdf->SetFont('DejaVu',  '', 16);

$pdf->Cell(0, 10, 'Отчет по пользователям', 0, 1, 'C');

$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(80, 10, 'Имя', 1);
$pdf->Cell(90, 10, 'Email', 1);
$pdf->Cell(120, 10, 'Role', 1);
$pdf->Ln();
$sql = "SELECT * FROM users";
if ($result = $conn->query($sql)) {
    foreach($result as $row) {
        $pdf->Cell(20, 10, $row['user_id'], 1);
        $pdf->Cell(80, 10, $row['user_name'], 1);
        $pdf->Cell(90, 10, $row['user_email'], 1);
        $pdf->Cell(120, 10, $row['user_role'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Нет данных', 1, 1, 'C');
}

$pdf->Output('D', 'report.pdf');