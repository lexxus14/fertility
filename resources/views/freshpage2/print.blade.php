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

    $pdf->Cell(0,4,'FRESH Cycle',0,1,'C');

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
    $pdf->Cell(25,6,$patient->HusbandBirthDate,'B',0);

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(0,6,$diff->format('%y'),'B',1);
  }

  $pdf->Cell(10,6,'',0,1);
  foreach($docresults as $docresult)
  {
    $pdf->Cell(25,6,'Fertility Diagnosis: ',0,1);
    foreach($FETPage2DiagnosisSubs as $FETPage2DiagnosisSub)
    {
      $pdf->Cell(25,6,'     '.$FETPage2DiagnosisSub->description,0,1);
      
    }
    $pdf->Cell(10,6,'CD 2: ',0,0);
    $pdf->Cell(30,6,$docresult->CD2,'B',0);

    if($docresult->IsConsent==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->Cell(20,6,'Consent',0,0);
    $pdf->Cell(15,6,'Protocol: ',0,0);
    $pdf->Cell(80,6,$docresult->Protocol,'B',1);

    $pdf->Cell(10,6,'FSH: ',0,0);
    $pdf->Cell(30,6,$docresult->FSH,'B',0);

    $pdf->Cell(18,6,'Estradiol: ',0,0);
    $pdf->Cell(30,6,$docresult->Estradiol,'B',0);

    $pdf->Cell(10,6,'AMH: ',0,0);
    $pdf->Cell(30,6,$docresult->AMH,'B',0);

    if($docresult->IsCBC==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->Cell(10,6,'CBC ',0,0);

    $pdf->Cell(10,6,'Date: ',0,0);
    $pdf->Cell(30,6,$docresult->CBCDate,'B',1);

    $pdf->Cell(30,6,'Uterine Position: ',0,0);
    $pdf->Cell(30,6,$docresult->UterinePosition,'B',0);
    $pdf->Cell(25,6,'Measurement: ',0,0);
    $pdf->Cell(30,6,$docresult->Measurement,'B',0);
    $pdf->Cell(10,6,'mm ',0,0);

    $pdf->Cell(15,6,'Wallace ',0,0);
    if($docresult->WallaceYesNo==1)
    {    
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO ',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO ',0,0);
    }
    $pdf->Cell(10,6,' ',0,1);
    $htmlTable="<table>
<tr>
<td>CD No</td>
<td>Date</td>
<td>Ultrasound</td>
<td>Lining</td>
<td>Estradiol</td>
<td>Notes</td>
</tr>";

foreach($FETPage2CDSubs as $FETPage2CDSub)
{
$htmlTable=$htmlTable."<tr>
<td>$FETPage2CDSub->CycleNo</td>
<td>$FETPage2CDSub->CycleDate</td>
<td>RT: $FETPage2CDSub->UltrasoundRT
LT: $FETPage2CDSub->UltrasoundLT</td>
<td>$FETPage2CDSub->Lining</td>
<td>$FETPage2CDSub->Estradiol</td>
<td>$FETPage2CDSub->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(15, 25, 30,40, 40,40);
    $pdf->WriteHTMLTable("$htmlTable",$w);

  $pdf->Cell(15,6,'Notes: ',0,0);
  $pdf->Write(6,$docresult->Notes);
  }

  $pdf->Output();
  exit;
?>