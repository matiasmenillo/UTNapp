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
    $founded = false;
    foreach($postulationList as $postulation){

        if($postulation->getJobOffer()->getJobOfferId() == $jobOfferId){
          
            foreach($studentList as $student){

                if($postulation->getStudent()->getStudentId() == $student->getStudentId()){
                
                    $founded = true;
                    $pdf->Cell(40,10, 'Alumno:', 1, 0, 'C', 0);
                    $pdf->Cell(40,10, $student->getFirstName(), 1, 0, 'C', 0); 
                    $pdf->Cell(40,10, $student->getLastName(), 1, 0, 'C', 0); 
                    $pdf->Cell(40,10, 'Fecha:', 1, 0, 'C', 0);
                    $pdf->Cell(40,10, $postulation->getPostulationDate(), 1, 0, 'C', 0); 
                }
               
            }
        }
    }
    if(!$founded){
        $pdf->Cell(40,10, 'Aun no hay estudiantes postulados.');
    }
    
   

    
    $pdf->Output();
    ob_end_flush(); 



?>