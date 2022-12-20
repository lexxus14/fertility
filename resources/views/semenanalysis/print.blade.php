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

    $pdf->Cell(0,4,'Semen Analysis',0,1,'C');

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
  foreach($docresults as $docresult)
  {
    $pdf->Cell(25,6,'Accession #:',0,0);
    $pdf->Cell(25,6,$docresult->AccessionNo,0,0);
    $pdf->Cell(25,6,'Date:',0,0);
    $pdf->Cell(25,6,$docresult->docdate,0,0);
    $pdf->Cell(25,6,'Collection Time:',0,0);
    $pdf->Cell(25,6,$docresult->CollectionTime,0,0);

    $pdf->Cell(25,6,'Delivery Time:',0,0);
    $pdf->Cell(25,6,$docresult->DeliveryTime,0,1);

    $pdf->Cell(30,6,'Days of Abtinence:',0,0);
    $pdf->Cell(20,6,$docresult->DaysOfAbstinence,0,0);

    $pdf->Cell(20,6,'Physician:',0,0);
    $pdf->Cell(25,6,$docresult->PhysicianStaffName,0,1);

    $pdf->Cell(40,6,'Complete of Ejaculation',0,0);
    if($docresult->IsEjaComplete)
    {
      checkbox($pdf,TRUE);
      $pdf->Cell(25,6,'Complete',0,0);
    }
    else{
      checkbox($pdf,FALSE);
      $pdf->Cell(25,6,'Complete',0,0);
    }
    if($docresult->IsEjaSpilled)
    {
      checkbox($pdf,TRUE);
      $pdf->Cell(25,6,'Spilled',0,0);
    }
    else{
      checkbox($pdf,FALSE);
      $pdf->Cell(25,6,'Spilled',0,0);
    }

    $pdf->Cell(40,6,'Complete of Ejaculation',0,0);
    if($docresult->IsCollHome)
    {
      checkbox($pdf,TRUE);
      $pdf->Cell(25,6,'Home',0,0);
    }
    else{
      checkbox($pdf,FALSE);
      $pdf->Cell(25,6,'Home',0,0);
    }

    if($docresult->IsCollOffice)
    {
      checkbox($pdf,TRUE);
      $pdf->Cell(25,6,'Office',0,0);
    }
    else{
      checkbox($pdf,FALSE);
      $pdf->Cell(25,6,'Office',0,0);
    }

    $pdf->Ln();
    $pdf->Cell(0,6,'WHO Manual 5th Edition, 2010',0,0,'R');
    $pdf->Ln();

    $pdf->Cell(150,6,'Physical Characteristic',0,0);
    $pdf->Cell(30,6,'Normal Range',0,1);

    $pdf->Cell(80,6,'Liquefaction',0,0);
    $pdf->Cell(75,6,$docresult->Liquefaction,0,0);
    $pdf->Cell(30,6,'60 min.',0,1);
    $pdf->Cell(80,6,'Color',0,0);
    $pdf->Cell(75,6,$docresult->Color,0,0);
    $pdf->Cell(30,6,'[Grey, White, Opalscent]',0,1);;
    $pdf->Cell(80,6,'Viscosity',0,0);
    $pdf->Cell(75,6,$docresult->Viscosity,0,0);
    $pdf->Cell(30,6,'[None to sligth]',0,1);
    $pdf->Cell(80,6,'pH',0,0);
    $pdf->Cell(75,6,$docresult->pH,0,0);
    $pdf->Cell(30,6,'>= 7.2',0,1);
    $pdf->Ln();
    $pdf->Cell(150,6,'Semen Analysis',0,0);
    $pdf->Cell(30,6,'Normal Range',0,1);

    $pdf->Cell(80,6,'Volume',0,0);
    $pdf->Cell(75,6,$docresult->Volume.' ml.',0,0);
    $pdf->Cell(30,6,'>=1.5ml',0,1);
    $pdf->Cell(80,6,'Sperm Count',0,0);
    $pdf->Cell(75,6,$docresult->SpermCount,0,0);
    $pdf->Cell(30,6,'>=15 Million /ml',0,1);;
    $pdf->Cell(80,6,'Total Sperm Count',0,0);
    $pdf->Cell(75,6,$docresult->TotalSpermCount,0,0);
    $pdf->Cell(30,6,'>=39 Million /ml',0,1);
    $pdf->Cell(80,6,'Cryptozoospermia',0,0);
    $pdf->Cell(75,6,$docresult->Cryptozoospermia,0,0);
    $pdf->Cell(30,6,'',0,1);
    $pdf->Cell(80,6,'Progressive Motility (a+b)',0,0);
    $pdf->Cell(75,6,$docresult->ProgMotility,0,0);
    $pdf->Cell(30,6,'>=39 %',0,1);

    $pdf->Cell(30,6,'Progression: ',0,1);
    $pdf->Cell(80,6,'a. Rapid',0,0);
    $pdf->Cell(75,6,$docresult->ProgRapid.' %',0,1);
    $pdf->Cell(80,6,'b. Slow',0,0);
    $pdf->Cell(75,6,$docresult->ProgSlow.' %',0,1);
    $pdf->Cell(80,6,'c. Non Progressive',0,0);
    $pdf->Cell(75,6,$docresult->ProgNonProg.' %',0,1);
    $pdf->Cell(80,6,'d. Non Motile',0,0);
    $pdf->Cell(75,6,$docresult->ProgNonMotile.' %',0,1);

    $pdf->Ln();

    $pdf->Cell(80,6,'Non-sperms cells',0,0);
    $pdf->Cell(75,6,$docresult->NonSpermCells.' Million/ml',0,0);
    $pdf->Cell(30,6,'< 1 Million /ml',0,1);

    $pdf->Ln();

    $pdf->Cell(30,6,'Morophology: Strict Criteria [Kruger]',0,1);

    $pdf->Cell(80,6,'Normal Form',0,0);
    $pdf->Cell(75,6,$docresult->NorForm,0,0);
    $pdf->Cell(30,6,'>= 4%',0,1);
    $pdf->Cell(80,6,'Abnormal Head',0,0);
    $pdf->Cell(75,6,$docresult->AbHead.' %',0,1);
    $pdf->Cell(80,6,'Abnormal Midpiece',0,0);
    $pdf->Cell(75,6,$docresult->AbMid.' %',0,1);
    $pdf->Cell(80,6,'Abnormal Tail',0,0);
    $pdf->Cell(75,6,$docresult->AbTail.' %',0,1);

    $pdf->Ln();
    $pdf->Cell(30,6,'Comments',0,1);
    $pdf->Write(6,$docresult->Notes);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Cell(80,6,'Time Analyzed: '.$docresult->TimeAnalyzed,0,0);
    $pdf->Cell(80,6,'Embryologist: '.$docresult->EmbryologistStaffName,0,1);

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