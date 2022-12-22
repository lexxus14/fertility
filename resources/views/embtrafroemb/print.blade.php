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

  $pdf->Cell(0,4,'EMBRYO(S) TRANSFER WITH FROZEN EMBRYO DATA SHEET',0,1,'C');
  $DocDate="";
  foreach($docresults as $docresult)
  {
    $DocDate =$docresult->docdate;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',0);
    $pdf->Cell(100,6,'',0,0);
    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(0,6,$DocDate,'B',1);

    $pdf->Cell(35,6,"Patient's Name: ",0,0);
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
  $pdf->Ln();
  foreach($docresults as $docresult)
  {
    $pdf->WriteHTML("You had <b> $docresult->FrozenEmb </b> Embryos frozen on <b> $docresult->FrozenDate</b>.");
    $pdf->Ln();
    $pdf->WriteHTML("You had <b> $docresult->ThaEmby </b> Embryos thaawed on <b> $docresult->EmbyDate </b>.");
    $pdf->Ln();
    $pdf->WriteHTML("You had <b> $docresult->EmbyRem </b> Embryos remaining.");
    $pdf->Ln();
    $pdf->WriteHTML("You had <b> $docresult->EmbyTran </b> Embryos transferred on Date <b> $docresult->TranDate </b>.");
    $pdf->Ln();
    $pdf->Cell(35,6,'Assisted Hatching: ',0,0);
    if($docresult->IsAssHatchYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'YES',0,0);
    }
    if($docresult->IsAssHatchNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'NO',0,0);
    }
    
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Patient Initials: ',0,0);
    $pdf->Write(6,$docresult->PatientInit);

    $pdf->Cell(20,6,'Day of ET:',0,0);
    $pdf->Cell(20,6,$docresult->ET3,'B',0,'C');
    $pdf->Cell(10,6,'3/5',0,0,'C');
    $pdf->Cell(20,6,$docresult->ET5,'B',1,'C');

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(15,6,'Notes: ',0,0);
    $pdf->Write(6,$docresult->Notes);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Patient Signature: ',0,0);
    $pdf->Cell(80,6,'','B',0);
    $pdf->Cell(15,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Husband Signature: ',0,0);
    $pdf->Cell(80,6,'','B',0);
    $pdf->Cell(15,6,'Date',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Embryologist: ',0,0);
    $pdf->Cell(80,6,$docresult->EmbryologistName,'B',1);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'MD: ',0,0);
    $pdf->Cell(80,6,$docresult->MDName,'B',1);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Nurse: ',0,0);
    $pdf->Cell(80,6,$docresult->NurseName,'B',1);
  }
  $pdf->Output();
  exit;
?>