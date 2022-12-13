<?php
  $pdf = new App\PDF('P','mm','A4');
  //cel (w,h,text,border(01LRBT),ln(012),align(LCR),fill,link)
  //the total default width is 180
  function checkbox( $pdf, $checked = TRUE, $checkbox_size = 5 , $ori_font_family = 'Arial', $ori_font_size = '10', $ori_font_style = '' )
    {
        if($checked == TRUE)
        $check = "4";
        else
        $check = "";

        $pdf->SetFont('ZapfDingbats','', $ori_font_size);
        $pdf->Cell($checkbox_size, $checkbox_size, $check, 1, 0);
        $pdf->SetFont( $ori_font_family, $ori_font_style, $ori_font_size);
    }
?>

<?php

$pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',12);
  $strPatientName="";
  foreach($patients as $patient){
    if($patient->IsHusbandPatient==1)
          {
            $strPatientName=$patient->HusbandName.' '.$patient->HusbandLastName;
          }
          else
          {
            $strPatientName= $patient->WifeName.' '.$patient->WifeLastName; 
          }
    }

  foreach($docresults as $docresult)
  {
    $pdf->Cell(0,4,'OPERATIVE REPORT',0,1,'C');
    $pdf->SetFont('');
    $pdf->Cell( 40, 6, 'Date:  '.$docresult->docdate, 'B', 1); 

    $pdf->Cell(0,6,'',0,1,'C');
    $pdf->Cell(40,6,'Name of Patient: ',0,0);
    $pdf->Cell(0,6,$strPatientName,'B',1);

    $pdf->Cell(40,6,'Pre-op Diagnosis: ',0,0);
    $pdf->Cell(0,6,$docresult->PreOpDiagnosis,'B',1);
    $pdf->Cell(40,6,'Post-op Diagnosis: ',0,0);
    $pdf->Cell(0,6,$docresult->PostOpDiagnosis,'B',1);
    $pdf->Cell(40,6,'Procedure: ',0,0);
    $pdf->Cell(0,6,$docresult->Procedure,'B',1);
    $pdf->Cell(0,6,'',0,1,'C');
    $pdf->Cell(40,6,'Surgeon: ',0,0);
    $pdf->Cell(0,6,$docresult->StaffName,'B',1);

    $pdf->Cell(0,6,'',0,1,'C');
    $pdf->Write(6,$docresult->OperativeNote);
    $pdf->Cell(0,12,'',0,1,'C');
    $pdf->Cell(25,6,'Anesthesia: ',0,0);
    $pdf->Cell(35,6,$docresult->Anesthesia,'B',0);
    $pdf->Cell(40,6,'Number of Oocytes: ',0,0);
    $pdf->Cell(30,6,$docresult->NumOfOocytes,'B',0);
    $pdf->Cell(35,6,'Time of Retrieval: ',0,0);
    $pdf->Cell(0,6,$docresult->RetrievalTime,'B',1);

    $pdf->Cell(0,6,'',0,1,'C');
    $pdf->Cell(35,6,'Addition Notes: ',0,1);
    $pdf->Write(6,$docresult->AddNotes);

    $pdf->Cell(0,12,'',0,1,'C');
    $pdf->Cell(35,6,'Complications: ',0,1);
    $pdf->Write(6,$docresult->Complication);

    $pdf->Cell(0,18,'',0,1,'C');
    $pdf->Cell(45,6,'Signature of Physician','T',0);
    $pdf->Cell(90,6,'            ',0,0);
    $pdf->Cell(50,6,'Nurse Name and Signature','T',0);

    if(is_file(public_path($docresult->filelink)))                   
      {
        $file= asset($docresult->filelink);
        $pdf->Cell(40,6,'',0,1);
        $pdf->Cell(30,6,'Attached File: ',0,0);
        $html='<a href="'.$file.'" target="_blank">Existing File</a>';
        $pdf->WriteHTML($html);
      }

  }
  $pdf->Output();
  exit;
?>