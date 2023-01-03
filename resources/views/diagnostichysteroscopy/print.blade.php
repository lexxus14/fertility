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

  $pdf->Cell(0,4,'Diagnostic Hysteroscopy',0,1,'C');

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

    $pdf->Cell(20,6,'Diaganosis: ',0,1);
    
    foreach($DiagnosisSubs as $DiagnosisSub)
    {
      $pdf->Cell(60,6,'   '.$DiagnosisSub->description,0,1);
    }

    $pdf->Cell(20,6,'',0,1);
    $pdf->Cell(20,6,'',0,1);

    $pdf->Cell(20,6,'Lt. Ovary:',0,0);
    $pdf->Cell(25,6,$docresult->LtOvary,'B',0);
    $pdf->Cell(20,6,' Rt. Ovary:',0,0);
    $pdf->Cell(25,6,$docresult->RtOvary,'B',0);
    $pdf->Cell(25,6,' Endo Stripe:',0,0);
    $pdf->Cell(25,6,$docresult->EndoStripe,'B',1);

    $pdf->Cell(20,6,' Fiborids:',0,0);
    $pdf->Cell(25,6,$docresult->Fibroids,'B',0);
    $pdf->Cell(20,6,' Polyps:',0,0);
    $pdf->Cell(25,6,$docresult->Polyps,'B',0);
    $pdf->Cell(25,6,' Free Fluid:',0,0);
    $pdf->Cell(25,6,$docresult->FreeFluid,'B',0);
    $pdf->Cell(25,6,' Hydrosalpinx:',0,0);
    $pdf->Cell(25,6,$docresult->Hydrosalpinx,'B',1);

    $pdf->Cell(25,6,'',0,1);

    $pdf->Cell(30,6,'Comments:',0,0);
    $pdf->Write(6,$docresult->Comments);

    $pdf->Cell(25,6,'',0,1);
    $pdf->Cell(25,6,'',0,1);

    
    $pdf->Cell(40,6,'Okay to proceed IVF? ',0,0);

    if($docresult->IsVFok==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'NO',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'NO',0,1);
    } 
    $pdf->Cell(25,6,'If NO, Why? ',0,0);
    $pdf->Write(6,$docresult->NoWhy);

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