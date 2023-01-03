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

  $FileNo='';
  $WifeName='';
  $WifeBirthDate='';
  $WifeAge='';

  $HusbandName='';
  $HusbandBirthDate='';
  $HusbandAge='';

  foreach($patients as $patient){

    $FileNo=$patient->FileNo;
    $WifeName=$patient->WifeLastName.', '.$patient->WifeName;
    $WifeBirthDate=$patient->WifeBirthDate;

    $bday = new DateTime($patient->WifeBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);
    $WifeAge=$diff->format('%y');

    $HusbandName=$patient->HusbandLastName.', '.$patient->HusbandName;
    $HusbandBirthDate=$patient->HusbandBirthDate;

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);
    $HusbandAge=$diff->format('%y');
  }

  foreach($docresults as $docresult)
  {
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(15,6,'Office: ',0,0);
    $pdf->Cell(25,6,$docresult->Office,'B',0);
    $pdf->Cell(35,6,'Retrieval Location: ',0,0);
    $pdf->Cell(25,6,$docresult->RetLoc,'B',0);
    $pdf->Cell(35,6,'Cryo Sperm Loc: ',0,0);
    $pdf->Cell(25,6,$docresult->CrySpermLoc,'B',1);

    $pdf->Cell(15,6,'IVF: ',0,0);
    $pdf->Cell(25,6,$docresult->IVF,'B',0);
    $pdf->Cell(35,6,'OVUM DONOR: ',0,0);
    $pdf->Cell(25,6,$docresult->IVF,'B',0);
    $pdf->Cell(40,6,'IVF W/ SURROGATE: ',0,0);
    $pdf->Cell(20,6,$docresult->CrySpermLoc,'B',1);


    $pdf->Cell(20,6,'PATIENT: ',0,0);
    $pdf->Cell(90,6,$WifeName,'B',0);
    $pdf->Cell(10,6,'DOB: ',0,0);
    $pdf->Cell(30,6,$WifeBirthDate,'B',0);
    $pdf->Cell(15,6,'AGE: ',0,0);
    $pdf->Cell(0,6,$WifeAge,'B',1);

    $pdf->Cell(20,6,'PARTNER: ',0,0);
    $pdf->Cell(90,6,$HusbandName,'B',0);
    $pdf->Cell(10,6,'DOB: ',0,0);
    $pdf->Cell(30,6,$HusbandBirthDate,'B',0);
    $pdf->Cell(15,6,'AGE: ',0,0);
    $pdf->Cell(0,6,$HusbandAge,'B',1);

    $pdf->Cell(40,6,'LUPRON START DATE: ',0,0);
    $pdf->Cell(25,6,$docresult->LupronStartDate,'B',0);
    $pdf->Cell(15,6,'CD 2: ',0,0);
    $pdf->Cell(25,6,$docresult->CD2,'B',0);
    $pdf->Cell(25,6,'',0,0);

    if($docresult->IsConsent==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,6,'Consent',0,1);


    $pdf->Cell(15,6,'FSH: ',0,0);
    $pdf->Cell(25,6,$docresult->FSH,'B',0);
    $pdf->Cell(25,6,'ESTRADIOL: ',0,0);
    $pdf->Cell(25,6,$docresult->LongEstradiol,'B',0);
    $pdf->Cell(15,6,'AMH: ',0,0);
    $pdf->Cell(25,6,$docresult->AMH,'B',0);
    $pdf->Cell(15,6,'DATE: ',0,0);
    $pdf->Cell(25,6,$docresult->LongProcDate,'B',0);

    if($docresult->CBC==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,6,'CBC',0,1);

    $pdf->Cell(15,6,'UTIRINE: ',0,0);
    $pdf->Cell(25,6,$docresult->UterinePosition,'B',0);
    $pdf->Cell(30,6,'MEASUREMENT: ',0,0);
    $pdf->Cell(25,6,$docresult->LongEstradiol.' mm','B',0);

    if($docresult->IsWallace==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,6,'WALLACE',0,1);

    $pdf->Ln();
    $pdf->Cell(20,6,'FERTILITY DIAGNOSIS',0,1);


    foreach($DiagnosisSubs as $DiagnosisSub)
    {
      $pdf->Cell(20,6,'   '.$DiagnosisSub->description,0,1);
    }

    $pdf->Cell(25,6,'PROTOCOL:',0,0);
    $pdf->Cell(15,6,$docresult->Protocol,'B',0);
    $pdf->Cell(35,6,'CD 1 ESTRADIOL:',0,0);
    $pdf->Cell(15,6,$docresult->CD1Estradiol,'B',0);
    $pdf->Cell(35,6,'CD 1 PROLACTIN:',0,0);
    $pdf->Cell(15,6,$docresult->CD1Prolactin,'B',0);
    $pdf->Cell(35,6,'CD 9 PROLACTIN:',0,0);
    $pdf->Cell(0,6,$docresult->CD9Prolactin,'B',1);

    $htmlTable="<table>
<tr>
<td>CD No</td>
<td>Date</td>
<td>Ultrasound</td>
<td>Lining</td>
<td>Estradiol</td>
<td>Notes</td>
</tr>";

foreach($FreshFormLongProSubs as $FreshFormLongProSub)
{
$htmlTable=$htmlTable."<tr>
<td>$FreshFormLongProSub->CycleNo</td>
<td>$FreshFormLongProSub->CycleDate</td>
<td>RT: $FreshFormLongProSub->UltrasoundRT
LT: $FreshFormLongProSub->UltrasoundLT</td>
<td>$FreshFormLongProSub->Lining</td>
<td>$FreshFormLongProSub->Estradiol</td>
<td>$FreshFormLongProSub->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(15, 25, 30,40, 40,40);
    $pdf->WriteHTMLTable("$htmlTable",$w);


  $pdf->Cell(15,6,'Notes: ',0,0);
  $pdf->Write(6,$docresult->Notes);

  $pdf->Ln();
  $pdf->Ln();

  $pdf->Cell(15,6,'hCG: ',0,0);
  $pdf->Cell(25,6,$docresult->HcgDate,'B',0);
  $pdf->Cell(15,6,'Time: ',0,0);
  $pdf->Cell(20,6,$docresult->HCGTime,'B',0);
  $pdf->Cell(10,6,'ER: ',0,0);
  $pdf->Cell(25,6,$docresult->ERDate,'B',0);
  $pdf->Cell(15,6,'Time: ',0,0);
  $pdf->Cell(25,6,$docresult->ERTime,'B',0);
  $pdf->Cell(20,6,'Blood Type: ',0,0);
  $pdf->Cell(0,6,$docresult->BloodType,'B',1);

  $pdf->Cell(20,6,'ET DATE: ',0,0);
  $pdf->Cell(25,6,$docresult->ETDate,'B',0);
  $pdf->Cell(15,6,'#Embryo: ',0,0);
  $pdf->Cell(25,6,$docresult->NoEmbryos,'B',0);
  $pdf->Cell(15,6,'#Trans: ',0,0);
  $pdf->Cell(25,6,$docresult->NoTrans,'B',0);
  $pdf->Cell(15,6,'#Eggs: ',0,0);
  $pdf->Cell(25,6,$docresult->NoEggs,'B',0);
  $pdf->Cell(15,6,'#Cryo: ',0,0);
  $pdf->Cell(0,6,$docresult->NoCryo,'B',1);

  $pdf->Cell(15,6,'BETA #1: ',0,0);
  $pdf->Cell(25,6,$docresult->BetaNo1,'B',0);
  $pdf->Cell(15,6,'Date: ',0,0);
  $pdf->Cell(25,6,$docresult->Beta1Date,'B',0);
  $pdf->Cell(15,6,'BETA #1s: ',0,0);
  $pdf->Cell(25,6,$docresult->BetNo2,'B',0);
  $pdf->Cell(15,6,'Date: ',0,0);
  $pdf->Cell(25,6,$docresult->Beta2Date,'B',0);
  $pdf->Cell(15,6,'P4: ',0,0);
  $pdf->Cell(0,6,$docresult->P4,'B',1);

  $pdf->Ln();
  $pdf->Cell(30,6,'',0,0);
  $pdf->Cell(5,6,'',0,0);
  $pdf->Cell(30,6,'',0,0);
  $pdf->Cell(5,6,'',0,0);
  $pdf->Cell(30,6,'Progesteron',0,0);
  $pdf->Cell(5,6,'',0,0);
  $pdf->Cell(30,6,'# SACS',0,0);
  $pdf->Cell(5,6,'',0,0);
  $pdf->Cell(30,6,'# FHT',0,1);
  foreach($FreshFormLongProgs as $FreshFormLongProg)
  {
    $pdf->Cell(30,6,'OB US# '.$FreshFormLongProg->OBUSNo,0,0);
    $pdf->Cell(5,6,'',0,0);
    $pdf->Cell(30,6,$FreshFormLongProg->OBUS,'B',0);
    $pdf->Cell(5,6,'',0,0);
    $pdf->Cell(30,6,$FreshFormLongProg->Progesterone,'B',0);
    $pdf->Cell(5,6,'',0,0);
    $pdf->Cell(30,6,$FreshFormLongProg->NoSACS,'B',0);
    $pdf->Cell(5,6,'',0,0);
    $pdf->Cell(30,6,$FreshFormLongProg->NoFHT,'B',1);
  }

  $pdf->Ln();
  $pdf->Cell(15,6,'OB/GYN: ',0,0);
  $pdf->Cell(50,6,$docresult->ObGyn,'B',0);
  $pdf->Cell(15,6,'Tel. No.: ',0,0);
  $pdf->Cell(30,6,$docresult->TelNo,'B',0);
  $pdf->Cell(15,6,'Address: ',0,0);
  $pdf->Cell(0,6,$docresult->Add,'B',0);

  

  }

  


  $pdf->Output();
  exit;
?>