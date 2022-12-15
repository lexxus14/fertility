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

  $DocDate =0;

    $pdf->Cell(0,4,'IVF/EMBRYO TRANSFER DATA SHEET',0,1,'C');

  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();

  foreach($docresults as $docresult)
  {
    $DocDate =$docresult->docdate;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(25,6,$DocDate,'B',1);
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
    $pdf->Cell(25,6,$patient->WifeBirthDate,'B',0);

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(0,6,$diff->format('%y'),'B',1);
  }

  $pdf->Ln();
  $pdf->Ln();

  foreach($docresults as $docresult)
  {
    $pdf->Cell(20,6,'You had ',0,0);
    $pdf->Cell(10,6,$docresult->EggsRetrieved,'B',0);
    $pdf->Cell(30,6,' eggs retrieved on ',0,0);
    $pdf->Cell(30,6,$docresult->EggsRetrievedDate,'B',1);

    $pdf->Cell(20,6,'You had ',0,0);
    $pdf->Cell(10,6,$docresult->EggsFertilized,'B',0);
    $pdf->Cell(30,6,' eggs fertilized on ',0,0);
    $pdf->Cell(30,6,$docresult->EggsFertilizedDate,'B',1);

    $pdf->Cell(20,6,'You had ',0,0);
    $pdf->Cell(10,6,$docresult->EmbryosTransd,'B',0);
    $pdf->Cell(40,6,' embryo(s) transferred ',0,0);
    $pdf->Cell(30,6,$docresult->EmbryosTransdDate,'B',0);

    if($docresult->IsDay3)
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' 3',0,0);
    }
    else
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' 3',0,0);
    }

    if($docresult->IsDay5)
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' 5',0,0);
    }
    else
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' 5',0,0);
    }

    $pdf->Ln();

    $pdf->Cell(20,6,'You had ',0,0);
    $pdf->Cell(10,6,$docresult->EmbryosDis,'B',0);
    $pdf->Cell(10,6,' embryo(s) transferred ',0,1);

    $pdf->Cell(60,6,'Procedures Performed ICSI: ',0,0);
    if($docresult->IsICSI)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' YES ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' NO',0,0);
    }
    else
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' YES ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' NO',0,0);
    }
    $pdf->Ln();

    $pdf->Cell(35,6,'Patient Initials:',0,0);
    $pdf->Cell(0,6,$docresult->ICSIPatientInitials,'B',1);

    $pdf->Cell(60,6,'Assisted Hatching: ',0,0);
    if($docresult->IsAssistedHatch)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' YES ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' NO',0,0);
    }
    else
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' YES ','B',0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' NO','B',0);
    }
    $pdf->Ln();

    $pdf->Cell(35,6,'Patient Initials:',0,0);
    $pdf->Cell(0,6,$docresult->AssistedHatchPatientInitials,'B',1);

    $pdf->Cell(40,6,'Embryo Transfer Date:',0,0);
    $pdf->Cell(0,6,$docresult->EmbryosTransDate,'B',1);

    $pdf->Cell(90,6,'Partner Verified the dish/vessel with CORRECT NAME: ',0,0);
    if($docresult->IsVerifiedCorrectName)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' YES ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' NO',0,0);
    }
    else
    {
      $pdf->Cell(10,6,'Day: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,' YES ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,' NO',0,0);
    }
    $pdf->Ln();

    $pdf->Cell(35,6,'Patient Initials:',0,0);
    $pdf->Cell(0,6,$docresult->VerifiedCorrectNamePatientInitials,'B',1);


    $pdf->Ln();

    $pdf->Cell(35,6,'WIFE Signature:',0,0);
    $pdf->Cell(90,6,'','B',0);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Cell(35,6,'HUSBAND Signature:',0,0);
    $pdf->Cell(90,6,'','B',0);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Cell(35,6,'NURSE Signature:',0,0);
    $pdf->Cell(90,6,'','B',0);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Cell(35,6,'Embryologist Signature:',0,0);
    $pdf->Cell(90,6,'','B',0);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);

    $pdf->Ln();
    $pdf->Cell(35,6,'MD Signature:',0,0);
    $pdf->Cell(90,6,'','B',0);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(0,6,'','B',1);
    
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