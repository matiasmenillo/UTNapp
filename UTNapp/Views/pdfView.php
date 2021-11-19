<?php
    ob_start();
    require_once('Fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);

    $pdf->Cell(40,10, $jobOffer->getCompany()->getName()); 
    $pdf->Ln();
    $pdf->Cell(40,10, $jobOffer->getJobPosition()->getDescription());
    $pdf->Ln();

    if (count($postulationList) > 0)
    {
        foreach($postulationList as $postulation)
        {
            $pdf->Cell(40,10, 'Alumno:', 1, 0, 'C', 0);
            $pdf->Cell(40,10, $postulation->getStudent()->getFirstName(), 1, 0, 'C', 0); 
            $pdf->Cell(40,10, $postulation->getStudent()->getLastName(), 1, 0, 'C', 0); 
            $pdf->Cell(40,10, 'Fecha:', 1, 0, 'C', 0);
            $pdf->Cell(40,10, $postulation->getPostulationDate(), 1, 0, 'C', 0); 
            $pdf->Ln();
        }
    }
    else
    {
        $pdf->Cell(40,10, 'Aun no hay estudiantes postulados.');
    }

    $pdf->Output('I');
    ob_end_flush(); 
?>