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

  $pdf->Cell(0,10,'PREOPERATIVE CHECKLIST',0,1,'C');

  $strPatientName="";
  foreach($patients as $patient){
    if($patient->IsHusbandPatient==1)
          {
            $strPatientName=$patient->HusbandName.' '.$patient->HusbandLastName;
          }
          else
          {
            $strPatientName= $patient->WifeName.' '.$patient->WifeLastName; 
          }
    }
  foreach($docresults as $docresult)
  {
    
    $pdf->SetFont('');
    $pdf->Cell(35,6,'Preoperative Instructions: ',0,1);
    $pdf->Write(6,$docresult->PreoperativeInstruction);

    $pdf->Cell(35,12,'',0,1);
    $pdf->Cell(20,6,'Given By: ',0,0);
    $pdf->Cell(70,6,$docresult->StaffName,'B',0);
    $pdf->Cell(12,6,'Date: ',0,0);
    $pdf->Cell(25,6,$docresult->PreOperaDate,'B',0);
    $pdf->Cell(10,6,'Time: ',0,0);
    $pdf->Cell(15,6,$docresult->PreOperaTime,0,1);
    $pdf->Cell(30,6,'Surgery Date: ',0,0);
    $pdf->Cell(35,6,$docresult->PSurgeryDate,'B',0);
    $pdf->Cell(15,6,'Time: ',0,0);
    $pdf->Cell(35,6,$docresult->SurgeryTime,'B',0);

    $pdf->Cell(30,6,'Time to arrive: ',0,0);
    $pdf->Cell(0,6,$docresult->ArrivalTime,'B',1);
    $pdf->Cell(35,6,'NPO Instruction: ',0,0);
    $pdf->Cell(0,6,$docresult->NPOInstruction,'B',1);
    if($docresult->IsNoJewelry==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'No Jewelry',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'No Jewelry',0,1);
    }

    if($docresult->IsNoMakeup==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'No Makeup',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'No Makeup',0,1);
    }

    if($docresult->IsNoNailPolish==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'No Nail Polish',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'No Nail Polish',0,1);
    }
    $pdf->SetFont('');
    $pdf->Cell(35,6,'Others: ',0,1);
    $pdf->Write(6,$docresult->Others);
    $pdf->Cell(35,6,' ',0,1);

    $pdf->Cell(15,6,'UPON ADMISSION: NURSING ASSESSMENT',0,1);

    $pdf->Cell(45,6,'PATIENT IDENTIFICATION: ',0,0);
    $pdf->Write(6,$strPatientName);

    $pdf->Cell(35,6,' ',0,1);
    $pdf->Cell(35,6,'CURRENT VITAL SIGN: ',0,1);
    $intCtr=1;
    $htmlTable="<table>
<tr>
<td>NO</td>
<td>VITAL SIGN</td>
<td>RESULT</td>
</tr>";
    foreach($PreOpeChkLstVitalSigns as $PreOpeChkLstVitalSign)
    {

      $htmlTable=$htmlTable."<tr>
<td>$intCtr</td>
<td>$PreOpeChkLstVitalSign->description</td>
<td>$PreOpeChkLstVitalSign->VitalSignRes</td>
</tr>";
  $intCtr++;
    }

    $htmlTable = $htmlTable."</table>";
    $w = array(20, 80,40);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(35,6,' ',0,1);
    $pdf->Cell(35,6,'NPO Status: ',0,0);
    $pdf->Cell(0,6,$docresult->NpoStatus,'B',1);
    $pdf->Cell(35,6,'Allergy: ',0,0);
    $pdf->Cell(0,6,$docresult->Allergy,'B',1);

    $pdf->Cell(35,6,' ',0,1);
    $pdf->Cell(35,6,'PROCEDURE',0,1);
    $intCtr=1;
    $htmlTable="<table>
<tr>
<td>NO</td>
<td>Procedure</td>
</tr>";
    foreach($PreOpProcedures as $PreOpProcedure)
    {

      $htmlTable=$htmlTable."<tr>
<td>$intCtr</td>
<td>$PreOpProcedure->description</td>
</tr>";
  $intCtr++;
    }

    $htmlTable = $htmlTable."</table>";
    $w = array(20, 80);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Cell(50,6,'History and Physical: ',0,0);
    $pdf->Cell(0,6,$docresult->HisAndPhy,'B',1);
    $pdf->Cell(50,6,'Informed Consent for Surgery: ',0,0);
    $pdf->Cell(0,6,$docresult->InfoConforSur,'B',1);
    $pdf->Cell(50,6,'Anesthesia Consent: ',0,0);
    $pdf->Cell(0,6,$docresult->AnesCons,'B',1);

    $pdf->Cell(50,6,'Lab Reports: ',0,0);
    $pdf->Cell(0,6,$docresult->LabReport,'B',1);

    $pdf->Cell(50,6,'Pre-Op Medication: ',0,0);
    $pdf->Cell(0,6,$docresult->VoidedFreely,'B',1);

    $pdf->Cell(50,6,'Pre-Op Medication: ',0,0);
    $pdf->Cell(0,6,$docresult->VoidedFreely,'B',1);

    $pdf->Cell(35,10,'',0,1);
    $pdf->Cell(50,6,'Nurse Name and Signature','T',1);
    $pdf->Cell(35,6,'Date:','B',1);
  }
  $pdf->Output();
  exit;
?>