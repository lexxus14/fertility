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

  $pdf->Cell(0,4,'POST ANESTHESIA RECORD',0,1,'C');

  $docDate ="";
  $docTime ="";
  foreach($docresults as $docresult)
  {
    $docDate = $docresult->docdate;
    $docTime = $docresult->doctime;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',1);

    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(25,6,$docDate ,'B',0);
    $pdf->Cell(80,6,'',0,0);
    $pdf->Cell(15,6,'Time: ',0,0);
    $pdf->Cell(25,6,$docTime ,'B',1);

    if($patient->IsWifePatient){
      $pdf->Cell(35,6,'Patient Name: ',0,0);
      $pdf->Cell(70,6,$patient->WifeLastName.', '.$patient->WifeName,'B',1);
    }
    if($patient->IsHusbandPatient){
      $pdf->Cell(35,6,'Patient Name: ',0,0);
      $pdf->Cell(70,6,$patient->WifeLastName.', '.$patient->WifeName,'B',1);
    }

    foreach($docresults as $docresult)
    {
      $pdf->Cell(35,6,'Surgeon Name: ',0,0);
      $pdf->Cell(70,6,$docresult->SurgeonStaffName,'B',1);

      $htmlTable="<table>
<tr>
<td>No</td>
<td>Procedure</td>
</tr>";
      $intctrPro=1;
      foreach($PosAneRecSurProcSubs as $PosAneRecSurProcSub)
      {
        $htmlTable=$htmlTable."<tr>
<td>$intctrPro</td>
<td>$PosAneRecSurProcSub->description</td>
</tr>";
$intctrPro++;
      }

    $htmlTable = $htmlTable."</table>";
    $w = array(10, 60);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(40,6,'Anesthesist Name: ',0,0);
    $pdf->Cell(70,6,$docresult->AnesthetestStaffName,'B',1);

    $pdf->Cell(40,6,'Type of Anesthesia ',0,1);
    if($docresult->IsTypAneGA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'G.A.',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'G.A.',0,0);
    }

    if($docresult->IsTypAneMAC==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'MAC',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'MAC',0,0);
    }

    if($docresult->IsTypAneRegAne==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(40,6,'Regional Anesthesia',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(40,6,'Regional Anesthesia',0,0);
    }

    if($docresult->IsTypAneOthers==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Others',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Others',0,1);
    }

    $pdf->Cell(0,6,'Monitoring Record',0,1,'C');
    $htmlTable="<table>
<tr>
<td>Time</td>
<td>B/P</td>
<td>Pulse Rate</td>
<td>Sp02</td>
<td>Fi02</td>
<td>Pain Score</td>
</tr>";
    foreach($PosAneMonRecSubs as $PosAneMonRecSub)
    {
      $htmlTable=$htmlTable."<tr>
<td>$PosAneMonRecSub->MonRecSubdoctime</td>
<td>$PosAneMonRecSub->BP</td>
<td>$PosAneMonRecSub->PulseRate</td>
<td>$PosAneMonRecSub->Sp02</td>
<td>$PosAneMonRecSub->Fi02</td>
<td>$PosAneMonRecSub->PainScore</td>
</tr>";
    }

    $htmlTable = $htmlTable."</table>";
    $w = array(30, 30,30,30, 30,30);
    $pdf->WriteHTMLTable("$htmlTable",$w);
    $pdf->Cell(0,6,'Drugs in Recovery',0,1,'C');
    $pdf->Write(6,$docresult->DruInRec);

    $pdf->Cell(0,6,'',0,1,'C');
    $pdf->Cell(0,6,'Criteria of Discharge',0,1,'C');

    if($docresult->IsCriDisCon==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Consciousness',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Consciousness',0,0);
    }

    if($docresult->IsCriDisAct==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Activity',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Activity',0,0);
    }

    if($docresult->IsCriDisBre==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Breathing',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Breathing',0,0);
    }

    if($docresult->IsCriDisCir==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Circulation',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Circulation',0,0);
    }

    if($docresult->IsCriDisOxySat==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(35,6,'Oxygen Saturation',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(35,6,'Oxygen Saturation',0,0);
    }

    $pdf->Cell(20,6,'Total Score:',0,0);
    $pdf->Cell(15,6,$docresult->TotalScore,0,1);
    $pdf->Cell(0,6,'Discharge Instruction and Remark',0,1,'C');
    $pdf->Cell(0,6,$docresult->DisInsAndRem,0,1);
    $pdf->Cell(0,6,'                ',0,1);

    $pdf->Cell(40,6,'Recovery Nurse Name:',0,0);
    $pdf->Cell(40,6,$docresult->RecNurStaffName,'B',0);
    $pdf->Cell(20,6,'',0,0);
    $pdf->Cell(45,6,'Recovery Nurse Signature:',0,0);
    $pdf->Cell(0,6,'                ','B',1);
    $pdf->Cell(0,6,'                ',0,1);

    $pdf->Cell(40,6,'Anesthesist Name:',0,0);
    $pdf->Cell(40,6,$docresult->AnesthetestStaffName,'B',0);
    $pdf->Cell(20,6,'',0,0);
    $pdf->Cell(45,6,'Anesthesist Signature:',0,0);
    $pdf->Cell(0,6,'                ','B',1);

    $pdf->Cell(80,6,'Anesthesist Stamp:',0,0);
    $pdf->Cell(20,6,'',0,0);
    $pdf->Cell(45,6,'Discharge Date & Time:',0,0);
    $pdf->Cell(0,6,$docresult->DisDate.' '.$docresult->DisTime,'B',1);

    if(is_file(public_path($docresult->filelink)))                   
      {
        $file= asset($docresult->filelink);
        $pdf->Cell(40,6,'',0,1);
        $pdf->Cell(30,6,'Attached File: ',0,0);
        $html='<a href="'.$file.'" target="_blank">Existing File</a>';
        $pdf->WriteHTML($html);
      }

    }
    
   
  }

  $pdf->Output();
  exit;
?>