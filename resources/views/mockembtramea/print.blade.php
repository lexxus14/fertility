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

  $pdf->Cell(0,4,'Mock Embryo Transfer Measurement',0,1,'C');

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

  $pdf->Cell(0,6,'',0,1);
  foreach($docresults as $docresult)
  {
    $pdf->Cell(10,6,'Date: ',0,0);
    $pdf->Cell(10,6,$docresult->docdate,0,1);

    $pdf->Cell(20,6,'WALLACE:',0,0);
    if($docresult->IsWalEasy==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Easy',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Easy',0,0);
    }

    if($docresult->IsWalDiff==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Difficult',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Difficult',0,0);
    }

    if($docresult->IsWalWIntr==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'With Introducer',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'With Introducer',0,0);
    }

    if($docresult->IsWalMeCaNe==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(40,6,'Metal Cannula needed',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(40,6,'Metal Cannula needed',0,0);
    }

    if($docresult->IsWalTenN==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Tennaculum needed',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Tennaculum needed',0,1);
    }
    $pdf->Cell(15,6,'Comment: ',0,1);
    $pdf->Write(6,$docresult->Comments);

    $pdf->Cell(15,6,'',0,1);
    $pdf->Cell(45,6,'UTERINE MEASUREMENT: ',0,0);
    $pdf->Cell(30,6,$docresult->UtMea.' mm',0,1);
    $pdf->Cell(45,6,'UTERINE POSITION: ',0,0);
    if($docresult->IsUtPoAnteflex==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Anteflex',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Anteflex',0,0);
    }

    if($docresult->IsUtPoAnteverted==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Anteverted',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Anteverted',0,0);
    }

    if($docresult->IsUtPoAxial==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Axial',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Axial',0,0);
    }

    if($docresult->IsUtPoRetroverted==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Retroverted',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Retroverted',0,1);
    }

    $pdf->Image(asset($docresult->UtPoImage),$pdf->GetX(),$pdf->GetY(),75,75);
    $pdf->Ln(70);
    $pdf->Cell(15,6,'',0,1);
    $pdf->Cell(50,6,'CATHETER ORIENTATION: ',0,0);

    if($docresult->IsCaOr1==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'1',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'1',0,0);
    }

    if($docresult->IsCaOr2==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'2',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'2',0,0);
    }

    if($docresult->IsCaOr3==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'3',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'3',0,0);
    }

    if($docresult->IsCaOr4==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'4',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'4',0,0);
    }

    if($docresult->IsCaOr5==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'5',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'5',0,0);
    }

    if($docresult->IsCaOr6==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'6',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'6',0,0);
    }

    if($docresult->IsCaOr7==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'7',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'7',0,0);
    }

    if($docresult->IsCaOr8==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'8',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'8',0,0);
    }

    if($docresult->IsCaOr9==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'9',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'',0,0);
    }

    if($docresult->IsCaOr10==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'10',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'10',0,0);
    }

    if($docresult->IsCaOr11==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'11',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'11',0,0);
    }

    if($docresult->IsCaOr12==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'12',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'12',0,1);
    }

    $pdf->Image(asset($docresult->UtPoCaOr),$pdf->GetX(),$pdf->GetY(),75,75);


  }
  $pdf->Output();
  exit;
?>