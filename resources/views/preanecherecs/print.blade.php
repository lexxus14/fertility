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

  $pdf->Cell(0,4,'PRE ANESTHESIA (CHECK-UP) RECORD',0,1,'C');
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
  foreach($docresults as $docresult)
  {
    $pdf->Cell(10,6,'',0,1);
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(25,6,$docresult->created_at,'B',1);

    $pdf->Cell(10,6,'Pre-Operative Diagnosis',0,0);
    $htmlTable="<table>
<tr>
<td>No</td>
<td>Diagnosis</td>
</tr>";
$intctrDiag = 1;
foreach($DoctorDiagnosis as $DoctorDiagnosi)
{
$htmlTable=$htmlTable."<tr>
<td>$intctrDiag</td>
<td>$DoctorDiagnosi->description</td>
</tr>";
$intctrDiag++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 40);
    $pdf->WriteHTMLTable("$htmlTable",$w);

$pdf->Cell(10,6,'Proposed Procedure',0,0);
$htmlTable="<table>
<tr>
<td>No</td>
<td>Procedure</td>
</tr>";
$intctrDiag = 1;
foreach($PreAneProProcs as $PreAneProProc)
{
$htmlTable=$htmlTable."<tr>
<td>$intctrDiag</td>
<td>$PreAneProProc->description</td>
</tr>";
$intctrDiag++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 40);
    $pdf->WriteHTMLTable("$htmlTable",$w);
    $pdf->Cell(60,6,'Pre-Anesthetic Surgical History:',0,1);
    $pdf->Write(6,$docresult->PreAneSurHis);

    $pdf->Cell(60,6,'',0,1);
    $pdf->Cell(60,6,'Current Therapy:',0,1);
    $pdf->Write(6,$docresult->CurTheraphy);
$pdf->Cell(60,6,'',0,1);
$pdf->Cell(10,6,'General Information and Vital Signs',0,0);
$htmlTable="<table>
<tr>
<td>No</td>
<td>Vital</td>
<td>Result</td>
</tr>";
$intctrDiag = 1;
foreach($PreAneGenInfVitSigns as $PreAneGenInfVitSign)
{
$htmlTable=$htmlTable."<tr>
<td>$intctrDiag</td>
<td>$PreAneGenInfVitSign->description</td>
<td>$PreAneGenInfVitSign->VSResult</td>
</tr>";
$intctrDiag++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 40,30);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(60,6,'Special Risk',0,1);
    
    if($docresult->IsSpeRisHypertension==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'Hypertension',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'Hypertension',0,0);
    }

    if($docresult->IsSpeRiBronchialAsthma==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(35,6,'Bronchial Asthma',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(35,6,'Bronchial Asthma',0,0);
    }

    if($docresult->IsSpeRiCOPD==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'COPD',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'COPD',0,0);
    }

    if($docresult->IsSpeRiObesity==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Obesity',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Obesity',0,0);
    }

    if($docresult->IsSpeRiDiaMellitus==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Diabetes Mellitus',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Diabetes Mellitus',0,1);
    }

    if($docresult->IsSpeRiIscHeaDisease==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(45,6,'Ischemipc Heart Disease',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(45,6,'Ischemipc Heart Disease',0,0);
    }

    if($docresult->IsSpeRiAlcHistory==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Alcohol History',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Alcohol History',0,0);
    }

    if($docresult->IsSpeRiSmoHistory==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Smoking History',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Smoking History',0,1);
    }

    $pdf->Cell(30,6,'Others:',0,1);
    $pdf->Write(6,$docresult->Others);

    $pdf->Cell(30,6,'',0,1);
    $pdf->Cell(80,6,'Airway (Mallampati) Score',0,0);
    $pdf->Cell(30,6,'ASA Score',0,1);

    if($docresult->AirwayScore==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'I',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'I',0,0);
    }

    if($docresult->AirwayScore==2)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'II',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'II',0,0);
    }

    if($docresult->AirwayScore==3)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'III',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'III',0,0);
    }

    if($docresult->AirwayScore==4)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(45,6,'IV',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(45,6,'IV',0,0);
    }

    

    if($docresult->AsaScore==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'I',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'I',0,0);
    }

    if($docresult->AsaScore==2)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'II',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'II',0,0);
    }

    if($docresult->AsaScore==3)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'III',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'III',0,0);
    }

    if($docresult->AsaScore==4)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(5,6,'IV',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(5,6,'IV',0,0);
    }

    $pdf->Cell(30,6,'',0,1);
    $pdf->Cell(0,6,'Pre Medication Drugs & Instructions',0,1,'C');
    $pdf->Write(6,$docresult->PreMedDruInsNote);
    $pdf->Cell(30,6,'',0,1);
    $pdf->Cell(0,6,'Anesthesia Plan',0,1,'C');
    $pdf->Write(6,$docresult->AnesthesiaPlan);

    $pdf->Cell(30,6,'',0,1);
    $pdf->Cell(30,6,'Anestetist Name:',0,0);
    $pdf->Cell(30,6,$docresult->StaffName,0,0);
    $pdf->Cell(60,6,'Anestetist Signature & Stamp',0,0);
    $pdf->Cell(25,6,'Date & Time:',0,0);
    $pdf->Cell(30,6,$docresult->AnesthetistDate.' & '.$docresult->AnesthetistTime,0,1);

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