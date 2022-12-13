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

  $pdf->Cell(0,4,'IVF REQUESITION FORM',0,1,'C');

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
    $pdf->Cell(35,6,'',0,1);
    $pdf->Cell(35,6,'Patient Physician: ',0,0);
    $pdf->Cell(35,6,$docresult->StaffName,0,1);

    $pdf->Cell(35,6,'',0,1);
    $pdf->Cell(35,6,'OOCTYE SOURCE: ',0,0);
    if($docresult->IsFemalePartner==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'Female Partner',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'Female Partner',0,0);
    }

    $pdf->Cell(30,6,'   Baseline FSH: ',0,0);
    $pdf->Cell(10,6,$docresult->BaselineFSH,'B',0);

    $pdf->Cell(20,6,'UT Lining: ',0,0);
    $pdf->Cell(15,6,$docresult->UTLining,'B',0);
    $pdf->Cell(20,6,'  AMH: ',0,0);
    $pdf->Cell(10,6,$docresult->AMH,'B',1);
    $pdf->Cell(85,6,'Inf. Dis/.FDA Testing/Screening completed and valid: ',0,0);
    $pdf->Cell(0,6,$docresult->OocyteSoureValid,'B',1);


    $pdf->Cell(35,6,'',0,1);
    $pdf->Cell(35,6,'Sperm Source: ',0,0);
    if($docresult->IsMalePartner==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'Male Partner',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'Male Partner',0,0);
    }

    if($docresult->IsFresh==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Fresh',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Fresh',0,0);
    }

    if($docresult->IsFrozen==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Frozen',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Frozen',0,0);
    }

    if($docresult->IsTESE==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'TESE ect',0,1);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'TESE ect',0,1);
    }

    $pdf->Cell(85,6,'Inf. Dis/.FDA Testing/Screening completed and valid: ',0,0);
    $pdf->Cell(0,6,$docresult->OocyteSoureValid,'B',1);

    $pdf->Cell(10,6,'Dx: ',0,0);
    $pdf->Cell(100,6,$docresult->Dx,'B',0);
    $pdf->Cell(5,6,' G:',0,0);
    $pdf->Cell(5,6,$docresult->G,'B',0);
    $pdf->Cell(5,6,' P:',0,0);
    $pdf->Cell(5,6,$docresult->P,'B',0);
    $pdf->Cell(5,6,' T:',0,0);
    $pdf->Cell(5,6,$docresult->T,'B',0);
    $pdf->Cell(5,6,' A:',0,0);
    $pdf->Cell(5,6,$docresult->A,'B',0);
    $pdf->Cell(5,6,' L: ',0,0);
    $pdf->Cell(5,6,$docresult->L,'B',1);
    
    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(23,6,'MEDICATION','B',1);
    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(23,6,'Protocol: ',0,0);
    $pdf->Cell(100,6,$docresult->Protocol,'B',0);
    $pdf->Cell(23,6,'Cycle: ',0,0);
    $pdf->Cell(23,6,$docresult->Cycle,'B',0);
    $pdf->Cell(5,6,'',0,1);
    $htmlTable="<table>
<tr>
<td>No</td>
<td>Medicine</td>
<td>Dosage</td>
</tr>";
$intcrM = 1;
foreach($IVFReqFormMeds as $IVFReqFormMed)
{
$htmlTable=$htmlTable."<tr>
<td>$intcrM</td>
<td>$IVFReqFormMed->description</td>
<td>$IVFReqFormMed->MedDosage $IVFReqFormMed->ShortSymbol</td>
</tr>";
$intcrM++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 100, 60);
    $pdf->WriteHTMLTable("$htmlTable",$w);

  $pdf->Cell(43,6,'PROCEDURE ORDERED','B',1);

   $htmlTable="<table>
<tr>
<td>No</td>
<td>Procedure</td>
</tr>";
$intcrM = 1;
foreach($IVFProcOrds as $IVFProcOrd)
{
$htmlTable=$htmlTable."<tr>
<td>$intcrM</td>
<td>$IVFProcOrd->description</td>
</tr>";
$intcrM++;
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 100);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    if($docresult->IsICSI==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'ICSI',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'ICSI',0,0);
    }

    if($docresult->IsAssHatching==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(35,6,'Assisted Hatching',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(35,6,'Assisted Hatching',0,0);
    }

    if($docresult->IsEmbBxFSH==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(35,6,'Embryo Bx for FSH',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(35,6,'Embryo Bx for FSH',0,0);
    }

    if($docresult->IsEmbBxAcgh==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Embryo Bx for Acgh',0,1);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Embryo Bx for Acgh',0,1);
    }

    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(50,6,'OV. STM. / RETRIEVAL INFO:','B',1);
    $pdf->Cell(5,6,'',0,1);
    $pdf->Cell(20,6,'Peak E2: ',0,0);
    $pdf->Cell(40,6,$docresult->PeakE2,'B',0);
    $pdf->Cell(50,6,' No. Follicles on hCG inj. Day: ',0,0);
    $pdf->Cell(20,6,$docresult->NoFollHcgInjDays,'B',1);
    $pdf->Cell(20,6,'Stimulation Days: ',0,0);
    $pdf->Cell(40,6,$docresult->StimDays,'B',0);
    $pdf->Cell(20,6,'Cycle Start: ',0,0);
    $pdf->Cell(40,6,$docresult->CycleStartDate,'B',0);
    $pdf->Cell(20,6,'Patient Coasted (Days): ',0,0);
    $pdf->Cell(40,6,$docresult->PatientCoastedDays,'B',1);
    $pdf->Cell(50,6,'CHROMOSONAL STUDY','B',1);

    if($docresult->IsPGTA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'PGTA',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'PGTA',0,0);
    }

    if($docresult->IsGenderSel==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Gender Selection',0,0);;
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Gender Selection',0,0);
    }

    if($docresult->IsPGTM==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'PGT-M',0,1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'PGT-M',0,1);
    }

    $pdf->Cell(20,6,'hCG Date: ',0,0);
    $pdf->Cell(40,6,$docresult->HcgDate,'B',0);

    $pdf->Cell(20,6,' Time: ',0,0);
    $pdf->Cell(20,6,$docresult->HcgTime,'B',0);

    $pdf->Cell(20,6,' ER Date: ',0,0);
    $pdf->Cell(20,6,$docresult->ErDate,'B',0);

    $pdf->Cell(20,6,' Time: ',0,0);
    $pdf->Cell(20,6,$docresult->ErTime,'B',1);

    if($docresult->IsBryoTransYes==1)
    {
      $pdf->Cell(30,6,'Embryo Transfer: ',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'NO',0,1);
    }
    else
    {
      $pdf->Cell(30,6,'Embryo Transfer: ',0,0);
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'YES',0,0);
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'NO',0,1);
    }

    $pdf->Cell(60,6,' ALERT/SPECIAL INSTRUCTIONS: ',0,1);
    $pdf->Write(6,$docresult->Notes,'B',1);

    $pdf->Cell(60,12,"",0,1);
    $pdf->Cell(50,6,"Physician's Signature",'T',0);
    $pdf->Cell(60,6,"",0,0);
    $pdf->Cell(30,6,"Date:    /     /     ",'B',1);

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