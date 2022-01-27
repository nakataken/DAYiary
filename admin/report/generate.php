<?php
    session_start();
    require('fpdf.php');

    class PDF extends FPDF {
        function Header()
        {
            // Logo
            $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',20);
            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(40,20,'DAYiary Report',0,0,'C');
            // Line break
            $this->Ln(20);
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(180,10,"Date:".date("Y/m/d"),0,0,"R");
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(90,20,"Total Users: ".$_SESSION['totalUsers'],1,0,"C");
    $pdf->Cell(90,20,"Total Diary Entries: ".$_SESSION['totalDiaries'],1,0,"C");
    $pdf->Ln();
    $pdf->Ln();
    $i = 0;
    $totalDay = array_reverse($_SESSION['totalDay']);
    $dayLabel = array_reverse($_SESSION['dayLabel']);
    $pdf->Cell(180,15,"DAILY DIARY ENTRIES IN A WEEK",1,0,"C");
    $pdf->Ln(); 
    $pdf->Cell(90,15,"Day",1,0,"C");
    $pdf->Cell(90,15,"Total Entries",1,0,"C");
    $pdf->Ln(); 
    while ($i < count($totalDay)){
        $pdf->Cell(90,20,$dayLabel[$i],1,0,"C");
        $pdf->Cell(90,20,$totalDay[$i],1,0,"C");
        $pdf->Ln();
        $i++;
    }
    $pdf->Output();
?>
