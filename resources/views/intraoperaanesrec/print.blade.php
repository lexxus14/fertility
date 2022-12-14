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

  $pdf->Cell(0,4,'INTRA-OPERATIVE ANAESTHESIA RECORD',0,1,'C');

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',1);

    if ($patient->IsWifePatient) {
      $pdf->Cell(15,6,'Patient: ',0,0);
      $pdf->Cell(70,6,$patient->WifeLastName.', '.$patient->WifeName,'B',0);
      $pdf->Cell(25,6,'Date of Birth: ',0,0);
      $pdf->Cell(25,6,$patient->HusbandBirthDate,'B',0);

      $bday = new DateTime($patient->WifeBirthDate); // Your date of birth
      $today = new Datetime(date('m.d.y'));
      $diff = $today->diff($bday);

      $pdf->Cell(10,6,'Age:',0,0);
      $pdf->Cell(5,6,$diff->format('%y'),'B',0);

      $pdf->Cell(10,6,'Sex:',0,0);
      $pdf->Cell(0,6,'Female','B',1);
    }

    if ($patient->IsHusbandPatient) {
      $pdf->Cell(15,6,'Patient: ',0,0);
      $pdf->Cell(70,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',0);
      $pdf->Cell(25,6,'Date of Birth: ',0,0);
      $pdf->Cell(25,6,$patient->HusbandBirthDate,'B',0);

      $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
      $today = new Datetime(date('m.d.y'));
      $diff = $today->diff($bday);

      $pdf->Cell(10,6,'Age:',0,0);
      $pdf->Cell(0,6,$diff->format('%y'),'B',0);
      $pdf->Cell(10,6,'Sex:',0,0);
      $pdf->Cell(0,6,'Male','B',1);
    }
    

    
  }

  foreach($docresults as $docresult)
  {
    $pdf->Ln();
    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(20,6,$docresult->docdate,'B',1);
    $pdf->Cell(10,6,'BP:',0,0);
    $pdf->Cell(20,6,$docresult->BP,'B',0);
    $pdf->Cell(20,6,'Pulse Rate:',0,0);
    $pdf->Cell(20,6,$docresult->PulseRate,'B',0);
    $pdf->Cell(10,6,'R/R:',0,0);
    $pdf->Cell(20,6,$docresult->RR,'B',0);
    $pdf->Cell(25,6,'Temperature:',0,0);
    $pdf->Cell(20,6,$docresult->Temperature,'B',0);
    $pdf->Cell(15,6,'Allergy:',0,0);
    $pdf->Cell(0,6,$docresult->Allergy,'B',0);
    $pdf->Ln();

    $pdf->Cell(40,6,'Intr-operative Diagnosis:',0,0);
    $pdf->Cell(0,6,$docresult->IntraOperativeDiags,'B',0);
    $pdf->Ln();

    $pdf->Cell(30,6,'Surgery Name:',0,0);
    $pdf->Cell(0,6,$docresult->SurgeryName,'B',0);
    $pdf->Ln();

    $pdf->Cell(30,6,'Surgeon Name:',0,0);
    $pdf->Cell(60,6,$docresult->StaffName,'B',0);
    $pdf->Cell(40,6,'Asst. Surgeon Name:',0,0);
    $pdf->Cell(0,6,$docresult->AsstSurgeonStaffName,'B',0);
    $pdf->Ln();

    $pdf->Cell(30,6,'Anesthetist Name:',0,0);
    $pdf->Cell(60,6,$docresult->AnesthetistStaffName,'B',0);
    $pdf->Cell(40,6,'Type of Anesthesia:',0,0);
    $pdf->Cell(0,6,$docresult->TypeOfAnesthesia,'B',0);    
    $pdf->Ln();

    $pdf->Cell(30,6,'Anesthesia Start:',0,0);
    $pdf->Cell(60,6,$docresult->AnesthesiaStartTime,'B',0);
    $pdf->Cell(40,6,'Surgery Start:',0,0);
    $pdf->Cell(0,6,$docresult->SurgeryStartTime,'B',0);    
    $pdf->Ln();

    $pdf->Cell(30,6,'Anesthesia End:',0,0);
    $pdf->Cell(60,6,$docresult->AnesthesiaEndTime,'B',0);
    $pdf->Cell(40,6,'Surgery End:',0,0);
    $pdf->Cell(0,6,$docresult->SurgeryEndTime,'B',0);    
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Image(asset($docresult->IntOpeAneRecord));
    $pdf->Ln();
    $pdf->Cell(0,6,'Total Dose of Drugs',0,0);
    $htmlTable="<table>
<tr>
<td>No</td>
<td>Medicine</td>
<td>Unit</td>
<td>Dose</td>
</tr>";
$intctr=1;
foreach($IntOpeAneRecTotalDoseDrugs as $IntOpeAneRecTotalDoseDrug)
{
$htmlTable=$htmlTable."<tr>
<td>$intctr</td>
<td>$IntOpeAneRecTotalDoseDrug->description</td>
<td>$IntOpeAneRecTotalDoseDrug->ShortSymbol</td>
<td>$IntOpeAneRecTotalDoseDrug->Dose</td>
</tr>";
$intctr++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 60, 20,20);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Ln();
    $pdf->Cell(30,6,'Notes:',0,0);
    $pdf->Write(6,$docresult->Notes);

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(30,6,'Anesthetist Name:',0,0);
    $pdf->Cell(60,6,$docresult->AnesthetistStaffName,'B',0);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(40,6,'Anesthetist Signature:',0,0);
    $pdf->Cell(60,6,'','B',0);
    $pdf->Cell(40,6,'',0,0);
    $pdf->Cell(0,6,'Time/Date:',0,0);

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