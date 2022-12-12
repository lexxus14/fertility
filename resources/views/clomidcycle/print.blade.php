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

  $pdf->Cell(0,4,'Clomid Cycle',0,1,'C');

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
    $pdf->Cell(10,6,'LMP:',0,0);
    $pdf->Cell(25,6,$docresult->LMPDAte,'B',1);

    $pdf->Cell(25,6,'Diagnosis: ',0,1);
    foreach($DiagnosisSubs as $DiagnosisSub)
    {
      $pdf->Cell(25,6,'     '.$DiagnosisSub->description,0,1);
      
    }
    $pdf->Cell(10,6,'AMH:',0,0);
    $pdf->Cell(30,6,$docresult->AMH,'B',0);
    $pdf->Cell(10,6,'FSH:',0,0);
    $pdf->Cell(30,6,$docresult->FSH,'B',0);
    $pdf->Cell(10,6,'E2:',0,0);
    $pdf->Cell(30,6,$docresult->E2,'B',1);

    $pdf->Cell(30,6,'Start CLOMID on:',0,0);
    $pdf->Cell(30,6,$docresult->DateStartClomid,'B',0);
    $pdf->Cell(20,6,'CLOMID',0,0);
    $pdf->Cell(10,6,$docresult->Clomidmg.' mg','B',0);
    $pdf->Cell(5,6,'  x',0,0);
    $pdf->Cell(20,6,$docresult->ClomidXDays,'B',0);
    $pdf->Cell(10,6,'days',0,0);

    $pdf->Cell(15,6,'Cycle #',0,0);

    $intc=1;
    $intctr = count($ClomidCycleNos);
    foreach($ClomidCycleNos as $ClomidCycleNo)
    {
      if ($intctr>$intc) {
        $pdf->Cell(5,6,$ClomidCycleNo->ClomidNo.'      ','B',0);
      }
      else{
        $pdf->Cell(5,6,$ClomidCycleNo->ClomidNo.'      ','B',1);
      }
      $intc++;      
    }

    $pdf->Cell(20,6,'HCG INJ: ',0,0);

    if($docresult->IsHCGInj==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'NO',0,0);
    }
    
    $pdf->Cell(30,6,'Intecourse/IUI: ',0,0);

    if($docresult->IsIntercourseIUI==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'NO',0,0);
    }

    $pdf->Cell(35,6,'Clomid Consent Date: ',0,0);
    $pdf->Cell(0,6,$docresult->ClomidConsendDate,'B',1);

    $pdf->Cell(10,6,' ',0,1);
    $htmlTable="<table>
<tr>
<td>CD No</td>
<td>Date</td>
<td>Ultrasound</td>
<td>Lining</td>
</tr>";

foreach($ClomidCycleSubs as $ClomidCycleSub)
{
$htmlTable=$htmlTable."<tr>
<td>$ClomidCycleSub->CycleNo</td>
<td>$ClomidCycleSub->CycleDate</td>
<td>RT: $ClomidCycleSub->RT
LT: $ClomidCycleSub->LT</td>
<td>$ClomidCycleSub->Lining mm</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 40, 60,70);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(25,6,'HCG Date: ',0,0);
    $pdf->Cell(20,6,$docresult->HCGDate,'B',0);
    $pdf->Cell(15,6,'  Time: ',0,0);
    $pdf->Cell(20,6,$docresult->HCGTime,'B',1);

    $pdf->Cell(25,6,'Beta HCG #1: ',0,0);
    $pdf->Cell(20,6,$docresult->BetaHCG1,'B',0);
    $pdf->Cell(20,6,'  Date: ',0,0);
    $pdf->Cell(20,6,$docresult->Beta1HCGDate,'B',0);
    $pdf->Cell(25,6,'  Beta HCG #2: ',0,0);
    $pdf->Cell(20,6,$docresult->BetaHCG2,'B',0);
    $pdf->Cell(15,6,'  Date: ',0,0);
    $pdf->Cell(20,6,$docresult->BetaHCG2Date,'B',1);

    $pdf->Cell(10,6,' ',0,1);
    $htmlTable="<table>
<tr>
<td>OB US week Sac</td>
<td>FHT</td>
<td>P4</td>
<td>Date</td>
</tr>";

foreach($ClomidCycleObus  as $ClomidCycleObu)
{
$htmlTable=$htmlTable."<tr>
<td>$ClomidCycleObu->OBUSWeeksSac</td>
<td>$ClomidCycleObu->FHT</td>
<td>$ClomidCycleObu->P4</td>
<td>$ClomidCycleObu->ClomidCycleDate</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(45, 45, 50,50);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(15,6,'Notes: ',0,0);
    $pdf->Write(6,$docresult->Notes);


  }

  $pdf->Output();
  exit;
?>