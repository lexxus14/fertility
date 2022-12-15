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

    $pdf->Cell(0,4,'FET Flow Sheet',0,1,'C');

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
  
  $pdf->Cell(10,6,'',0,1);
  foreach($docresults as $docresult)
  {
    $pdf->Cell(30,6,'Lupron Start Date:',0,0);
    $pdf->Cell(30,6,$docresult->LupronStartDate,'B',0);

    $pdf->Cell(15,6,'  CD 2: ',0,0);
    $pdf->Cell(20,6,$docresult->CD2Date,'B',1);

    $pdf->Cell(30,6,'Uterin Position:',0,0);
    $pdf->Cell(30,6,$docresult->UterinePosition,'B',0);

    $pdf->Cell(25,6,'  Measurment: ',0,0);
    $pdf->Cell(30,6,$docresult->Measurement,'B',1);
    $pdf->Cell(25,6,'',0,1);
    $pdf->Cell(25,6,'Diagnosis: ',0,1);
    foreach($FETPage2DiagnosisSubs as $FETPage2DiagnosisSub)
    {
      $pdf->Cell(25,6,'     '.$FETPage2DiagnosisSub->description,0,1);
      
    }

    $pdf->Cell(25,6,'',0,1);
    $pdf->Cell(15,6,'HIPPA#:',0,0);
    $pdf->Cell(60,6,$docresult->HIPPA,'B',0);

    $pdf->Cell(25,6,'CD1 Estradiol:',0,0);
    $pdf->Cell(40,6,$docresult->CD1Etradiol,'B',0);

    $pdf->Cell(20,6,'CD1 PRL:',0,0);
    $pdf->Cell(0,6,$docresult->CD1PRL,'B',1);

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
<td>$FETPage2CDSub->CDNo</td>
<td>$FETPage2CDSub->CDDate</td>
<td>RT: $FETPage2CDSub->RT
LT: $FETPage2CDSub->LT</td>
<td>$FETPage2CDSub->Lining</td>
<td>$FETPage2CDSub->Estradiol</td>
<td>$FETPage2CDSub->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(10, 25, 30,40, 40,50);
    $pdf->WriteHTMLTable("$htmlTable",$w);
$pdf->Cell(15,6,'Notes: ',0,0);
      $pdf->Write(6,$docresult->Notes);

    $pdf->Cell(25,6,'',0,1);
    $pdf->Cell(20,6,'Blood Type: ',0,0);
    $pdf->Cell(25,6,$docresult->BloodType,'B',0);

    $pdf->Cell(20,6,'FET Date: ',0,0);
    $pdf->Cell(25,6,$docresult->FETDate,'B',0);
    
    $pdf->Cell(15,6,'Embros: ',0,0);
    $pdf->Cell(25,6,$docresult->Embros,'B',0);

    $pdf->Cell(12,6,'Trans: ',0,0);
    $pdf->Cell(25,6,$docresult->Embros,'B',0);

    $pdf->Cell(10,6,'Cryo: ',0,0);
    $pdf->Cell(0,6,$docresult->Cryo,'B',0);

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