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

    $pdf->Cell(0,4,'Sperm Freezing',0,1,'C');

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

  foreach($docresults as $docresult)
  {
    $pdf->Ln();
    $pdf->Cell(10,6,'Date: ',0,0);
    $pdf->Cell(25,6,$docresult->docdate,'B',0);
    $pdf->Cell(10,6,'File #: ',0,0);
    $pdf->Cell(25,6,$docresult->FileNo,'B',0);
    $pdf->Cell(20,6,'Freezing #: ',0,0);
    $pdf->Cell(25,6,$docresult->FreezingNo,'B',0);
    $pdf->Cell(15,6,'Accn NO: ',0,0);
    $pdf->Cell(25,6,$docresult->AccnNo,'B',1);

    $htmlTable="<table>
<tr>
<td>File #: $docresult->FileNo
Freezing #: $docresult->FreezingNo</td>
<td>Unit 4020 Building 64, Dubai
Healthcare City
Dubai, UAE</td>
<td>SPERM STORAGE
REPORT</td>
</tr>";

    $htmlTable = $htmlTable."</table>";
    $w = array(60, 60, 60);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(30,6,'Collection Time: ',0,0);
    $pdf->Cell(25,6,$docresult->CollectionTime,'B',0);

    $pdf->Cell(35,6,'Days of Abstinence: ',0,0);
    $pdf->Cell(25,6,$docresult->DaysOfAbstinence,'B',0);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(90,6,'Completeness of Ejaculate: ',0,0);
    $pdf->Cell(25,6,'Collected at: ',0,0);

    if($docresult->IsCollectedOnSite==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'On Site',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'On Site',0,0);
    }

    if($docresult->IsCollectedOffSite==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Off Site',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Off Site',0,1);
    }

    if($docresult->IsEjaculateComplete==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Complete',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Complete',0,0);
    }

    if($docresult->IsEjaculateIncomplete==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Incomplete',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Incomplete',0,0);
    }

    if($docresult->IsEjaculateSpilled==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Spilled',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Spilled',0,0);
    }

    if($docresult->IsFreshEja==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Fresh Ejaculation',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Fresh Ejaculation',0,0);
    }

    if($docresult->IsMESA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'MESA',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'MESA',0,0);
    }

    if($docresult->IsTESE==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'TESE',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'TESE',0,0);
    }

    if($docresult->IsPESA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'PESA',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'PESA',0,0);
    }

    if($docresult->IsReFreeze==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Re-Freeze',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Re-Freeze',0,1);
    }

    $pdf->Ln();
    $pdf->Cell(0,6,'WHO Manual 5th Edition, 2010',0,0,'R');
    $pdf->Ln();

    $pdf->Cell(150,6,'Physical Characteristic',0,0);
    $pdf->Cell(30,6,'Normal Range',0,1);

    $pdf->Cell(80,6,'Volume',0,0);
    $pdf->Cell(75,6,$docresult->Volume,0,0);
    $pdf->Cell(30,6,'1.5ml',0,1);
    $pdf->Cell(80,6,'Liquefaction',0,0);
    $pdf->Cell(75,6,$docresult->Liquefaction,0,0);
    $pdf->Cell(30,6,'< 60 min.',0,1);
    $pdf->Cell(80,6,'Color',0,0);
    $pdf->Cell(75,6,$docresult->Color,0,0);
    $pdf->Cell(30,6,'[Grey, White, Opalscent]',0,1);
    $pdf->Cell(80,6,'Viscosity',0,0);
    $pdf->Cell(75,6,$docresult->Viscosity,0,0);
    $pdf->Cell(30,6,'[None to sligth]',0,1);
    $pdf->Cell(80,6,'pH',0,0);
    $pdf->Cell(75,6,$docresult->pH,0,0);
    $pdf->Cell(30,6,'>= 7.2',0,1);

    $pdf->Ln();
    $pdf->Cell(60,6,'PRC PROCESSED SPERM',0,1);

    $pdf->Cell(25,6,'# OF VIALS',0,0);
    $pdf->Cell(20,6,$docresult->OfVialsNo,0,0);
    $pdf->Cell(25,6,'Volume: ',0,0);
    $pdf->Cell(20,6,$docresult->SpermVolume,0,0);
    $pdf->Cell(27,6,'Date Recovered: ',0,0);
    $pdf->Cell(23,6,$docresult->DateRecovered,0,0);
    $pdf->Cell(0,6,'SPECIMEN TYPE',0,1);

    $pdf->Cell(25,6,'Tank: ',0,0);
    $pdf->Cell(20,6,$docresult->Tank,0,0);
    $pdf->Cell(25,6,'Concl: ',0,0);
    $pdf->Cell(20,6,$docresult->Conc.'Mill./ml',0,0);
    $pdf->Cell(30,6,'OFFICE: ',0,0);
    $pdf->Cell(20,6,$docresult->Office,0,0);

    if($docresult->IsSpecTypeFresh==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Fresh',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Fresh',0,1);
    }

    $pdf->Cell(25,6,'Canister: ',0,0);
    $pdf->Cell(20,6,$docresult->Canister,0,0);
    $pdf->Cell(25,6,'Motility: ',0,0);
    $pdf->Cell(20,6,$docresult->Motility,0,0);
    $pdf->Cell(50,6,'',0,0);

    if($docresult->IsSpecTESAPESAMESA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'TESA PESA MESA',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'TESA PESA MESA',0,1);
    }

    $pdf->Cell(25,6,'Cane: ',0,0);
    $pdf->Cell(20,6,$docresult->Cane,0,0);
    $pdf->Cell(95,6,'',0,0);

    if($docresult->IsSpecPrevFroz==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Previously Frozen',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Previously Frozen',0,1);
    }
    $pdf->Ln();
    $pdf->Cell(30,6,'Comments',0,1);
    $pdf->Write(6,$docresult->Notes);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Cell(80,6,'COMPLETED BY: '.$docresult->StaffName,0,0);
    $pdf->Cell(70,6,'SIGNATURE',0,0);
    $pdf->Cell(0,6,'DATE',0,0);

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