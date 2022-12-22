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

  $pdf->Cell(0,4,'CONSENT OF ANESTHESIA',0,1,'C');

  $pdf->SetFont('Arial','',12);
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();
  $DocDate =0;
  $strPatientName="";
  foreach($docresults as $docresult)
  {
    $DocDate =$docresult->docdate;
  }
  foreach($patients as $patient)
  {
    $pdf->Cell(45,6,'Date: ',0,0);
    $pdf->Cell(45,6,$DocDate,'B',1);
    $pdf->Cell(45,6,'File No: ',0,0);
    $pdf->Cell(45,6,$patient->FileNo,'B',1);

    if($patient->IsWifePatient)
    {
      $strPatientName = $patient->WifeLastName.', '.$patient->WifeName;
    $pdf->Cell(45,6,'Name of the patient: ',0,0);
    $pdf->Cell(0,6,$patient->WifeLastName.', '.$patient->WifeName,'B',1);
    $pdf->Cell(45,6,'Date of Birth: ',0,0);
    $pdf->Cell(45,6,$patient->WifeBirthDate,'B',1);

    $bday = new DateTime($patient->WifeBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(45,6,'Age:',0,0);
    $pdf->Cell(45,6,$diff->format('%y'),'B',1);

    $pdf->Cell(45,6,'Gender:',0,0);
    $pdf->Cell(45,6,'Female','B',1);

    if($patient->IsHusbandPatient)
    {
      $strPatientName = $patient->HusbandLastName.', '.$patient->HusbandName;
      $pdf->Cell(45,6,'File No: ',0,0);
      $pdf->Cell(45,6,$patient->FileNo,'B',1);
      $pdf->Cell(45,6,'Name of the patient: ',0,0);
      $pdf->Cell(0,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',1);
      $pdf->Cell(45,6,'Date of Birth: ',0,0);
      $pdf->Cell(45,6,$patient->HusbandBirthDate,'B',1);

      $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
      $today = new Datetime(date('m.d.y'));
      $diff = $today->diff($bday);

      $pdf->Cell(45,6,'Age:',0,0);
      $pdf->Cell(45,6,$diff->format('%y'),'B',1);
      $pdf->Cell(45,6,'Gender:',0,0);
      $pdf->Cell(45,6,'Female','B',1);
    }
  }
  }

  $pdf->Ln();
  $pdf->Ln();
  foreach($docresults as $docresult)
  {
    $pdf->WriteHTML("I am the <b> patient $strPatientName confirm </b> that I have been <b> fully explained </b> by the anesthetist <b> Dr. $docresult->StaffName. </b><br>");
    $pdf->Ln();
    $pdf->WriteHTML("<b>Regarding the risk, benefit, potental complication and the different options of Anesthesia [General Anesthesia (GA), Sedation (MAC), Regional Anesthesia, and stand by] for the surgical procedure $docresult->SurgicalProcedure . </b><br>");
    $pdf->Ln();
    $pdf->WriteHTML("<b>And I agree for the: Anesthesia of Choice $docresult->AneOfChoice . </b>");

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Cell(45,6,"Patient's Name:",0,0);
    $pdf->Cell(45,6,$strPatientName,'B',0);
    $pdf->Cell(45,6,"",0,0);
    $pdf->Cell(45,6,"Date:",0,1);

    $pdf->Cell(45,6,"Patient's Signature:",0,0);
    $pdf->Cell(45,6,"",'B',0);
    $pdf->Cell(45,6,"",0,0);
    $pdf->Cell(45,6,"Time:",0,1);

    $pdf->Ln();
    $pdf->Ln();

    $pdf->Cell(45,6,"Anesthestist's Name:",0,0);
    $pdf->Cell(45,6,$docresult->StaffName,'B',0);
    $pdf->Cell(45,6,"",0,0);
    $pdf->Cell(45,6,"Date:",0,1);

    $pdf->Cell(45,6,"Anesthestist's Signature:",0,0);
    $pdf->Cell(45,6,"",'B',0);
    $pdf->Cell(45,6,"",0,0);
    $pdf->Cell(45,6,"Time:",0,1);
    $pdf->Cell(45,6,"Anesthestist Stamp:",0,0);

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
