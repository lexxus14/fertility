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

  $pdf->Cell(0,4,'POST-OP/POST PROCEDURE NOTES',0,1,'C');

  foreach($docresults as $docresult)
  {
  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',1);
    $pdf->Cell(35,6,'Wife Name: ',0,0);
    $pdf->Cell(70,6,$patient->WifeLastName.', '.$patient->WifeName,'B',0);
    $pdf->Cell(25,6,'Date of Birth: ',0,0);
    $pdf->Cell(25,6,$patient->WifeBirthDate,'B',0);

    $bday = new DateTime($patient->WifeBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(0,6,$diff->format('%y'),'B',1);

    $pdf->Cell(35,6,'Husband Name: ',0,0);
    $pdf->Cell(70,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',0);
    $pdf->Cell(25,6,'Date of Birth: ',0,0);
    $pdf->Cell(25,6,$patient->HusbandBirthDate,'B',0);

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(0,6,$diff->format('%y'),'B',1);
  }
  $pdf->Cell(0,4,'',0,1,'C');
  $pdf->Cell(0,6,'PRE-OP DIAGNOSIS: ','T',1);

  foreach($PreOpDiagnosis as $PreOpDiagnosi)
  {

        $pdf->Cell(100,6,'   '.$PreOpDiagnosi->description,0,1);


  }

  $pdf->Cell(0,6,'PROCEDURES: ','T',1);

  foreach($PreOpProcedures as $PreOpProcedure)
  {
        $pdf->Cell(100,6,'   '.$PreOpProcedure->description,0,1);

  }

  $pdf->Cell(0,6,'FINDINGS/POST-OP DIAGNOSIS: ','T',1);
  foreach($FindingPostOpDiags as $FindingPostOpDiag)
  {

        $pdf->Cell(100,6,'   '.$FindingPostOpDiag->description,0,1);
 
  }

  $pdf->Cell(0,6,'SURGEON/PERFORMING MD: ','T',1);
  $pdf->Cell(100,6,'    '.$docresult->SurgeonPerformingMD,0,1);
  $pdf->Cell(0,6,'ANESTHESIOLOGIST: ','T',1);
  $pdf->Cell(00,6,'   '.$docresult->Anesthesiologist,0,1);
  $pdf->Cell(0,6,'ANESTHESIA USED: ','T',1);
  $pdf->Cell(100,6,'   '.$docresult->AnesthesiaUsed,0,1);
  $pdf->Cell(0,6,'SPECIMEN(S): ','T',1);
  $pdf->Cell(100,6,'   '.$docresult->Specimens,0,1);
  $pdf->Cell(0,6,'DRAINS: ','T',1);
  $pdf->Cell(100,6,'   '.$docresult->Drains,0,1);
  $pdf->Cell(0,6,'ESTIMATED BLOOD LOSS: ','T',1);
  $pdf->Cell(100,6,'   '.$docresult->EstBloodLoss,0,1);
  $pdf->Cell(0,6,'COMPLICATIONS: ','T',1);
  $pdf->Cell(0,6,'   '.$docresult->Complications,0,1);

  $pdf->Cell(0,6,'CONDITIONS: ','T',1);

    if($docresult->IsConStable==1)
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'STABLE',0,1);
    }
    else
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'STABLE',0,1);
    }

    if($docresult->IsConGuarded==1)
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'GUARDED',0,1);
    }
    else
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'GUARDED',0,1);
    }

    if($docresult->IsConCritical==1)
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'CRITICAL',0,1);
    }
    else
    {
      $pdf->Cell(5,6,' ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'CRITICAL',0,1);
    }

    $pdf->Cell(0,6,'OTHER: ',0,1);
    $pdf->Write(6,$docresult->ConOthers);
  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(0,6,'','B',1);
  $pdf->SetFont('Arial','I',8);
  $pdf->Cell(0,6,'Full report must dictated/written immediately following after surgery.',0,1,'C');
  $pdf->SetFont('Arial','I',12);
  $pdf->SetFont('');
  $pdf->Cell(0,6,'Additional Notes: (DO NOT USE FOR PRESCRIPTION ORDERS)',0,0);
  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(100,6,'NOTES: ',0,1);
  $pdf->Write(6,$docresult->Notes);

  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(40,6,'Physician Signagure: ',0,0);
  $pdf->Cell(80,6,'','B',0);

  $pdf->Cell(30,6,'Dictation #: ',0,0);
  $pdf->Cell(0,6,'','B',1);
  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(0,6,'',0,1);
  $pdf->Cell(30,6,'Doctor Stamp: ',0,0);
  $pdf->Cell(70,6,'',0,0);

  $pdf->Cell(10,6,'Date: ',0,0);
  $pdf->Cell(30,6,'      /      /   ','B',0);

  $pdf->Cell(15,6,'  Time:',0,0);
  $pdf->Cell(0,6,'','B',0);

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