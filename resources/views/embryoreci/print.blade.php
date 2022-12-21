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

  foreach($docresults as $docresult)
  {
    $RecNumber =$docresult->RecordNo;
    $DocDate =$docresult->docdate;
  }
  $pdf->Cell(150,6,'PRC FERTILITY CENTER','LT',0);
  $pdf->Cell(40,6,'IVF Lab Record','TR',1);
  $pdf->Cell(150,6,'DUBAI DHCC','L',0);
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(15,6,'record #: ',0,0);
  $pdf->SetFont('Arial','B',10); 
  $pdf->Cell(0,6,$RecNumber,'BR',1);
  $pdf->Cell(150,1,'','LB',0);
  $pdf->Cell(40,1,'','RB',1);

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',9);    
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',0);
    $pdf->Cell(100,6,'',0,0);
    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(25,6,$DocDate,'B',1);
    $pdf->Cell(25,6,'Wife Name: ',0,0);
    $pdf->Cell(60,6,$patient->WifeLastName.', '.$patient->WifeName,'B',0);
    $pdf->Cell(20,6,'Date of Birth: ',0,0);
    $pdf->Cell(20,6,$patient->WifeBirthDate,'B',0);



    $bday = new DateTime($patient->WifeBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(10,6,$diff->format('%y'),'B',0);

    $pdf->Cell(20,6,'Contact No: ',0,0);
    $pdf->Cell(0,6,$patient->MainContactNo,'B',1);

    $pdf->Cell(25,6,'Husband Name: ',0,0);
    $pdf->Cell(60,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',0);
    $pdf->Cell(20,6,'Date of Birth: ',0,0);
    $pdf->Cell(20,6,$patient->HusbandBirthDate  ,'B',0);

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(10,6,$diff->format('%y'),'B',0);

    $pdf->Cell(20,6,'Message: ',0,0);

    if($docresult->IsMssgYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsMssgNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO',0,0);
    }

    $pdf->Ln();
    $pdf->Cell(20,6,'Cycle Type:',0,0);

    if($docresult->IsIVF==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'IVF',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'IVF',0,0);
    }

    if($docresult->IsICSC==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(12,6,'ICSC',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(12,6,'ICSC',0,0);
    }

    if($docresult->IsPGTA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'PGT-A',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'PGT-A',0,0);
    }

    if($docresult->IsPGTAM==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'PGT-M',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'PGT-M',0,0);
    }

    if($docresult->IsBabayGender==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'Baby Gender',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'Baby Gender',0,0);
    }

    if($docresult->IsOOctye==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'OOctye Vitrification',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'OOctye Vitrification',0,0);
    }

    $pdf->Ln();
    $pdf->Cell(20,6,'hCG Date:','LT',0);
    $pdf->Cell(35,6,$docresult->hCGDate.' ' .$docresult->hCGTime,'TB',0);
    $pdf->Cell(20,6,'# Foll>=12:','T',0);
    $pdf->Cell(20,6,$docresult->NoFoll,'TB',0);
    $pdf->Cell(15,6,'Max E2:','T',0);
    $pdf->Cell(20,6,$docresult->MaxE2,'TBR',0);
    $pdf->Cell(5,6,'G:','T',0);
    $pdf->Cell(10,6,$docresult->G,'TB',0);
    $pdf->Cell(5,6,'P:','T',0);
    $pdf->Cell(10,6,$docresult->P,'TB',0);
    $pdf->Cell(5,6,'A:','T',0);
    $pdf->Cell(10,6,$docresult->A,'TB',0);
    $pdf->Cell(5,6,'E:','T',0);
    $pdf->Cell(10,6,$docresult->E,'TBR',1);

    $pdf->Cell(45,6,'Infertility Drugs & Amount:','L',0);
    $pdf->Cell(85,6,$docresult->InfeDruAmount,'BR',0);
    $pdf->Cell(10,6,'1dx:',0,0);
    $pdf->Cell(50,6,$docresult->dx1,'BR',1);

    $pdf->Cell(20,6,'Cycle No:','L',0);
    $pdf->Cell(20,6,$docresult->CycleNo,'B',0);

    $pdf->Cell(20,6,'Cycle Date:',0,0);
    $pdf->Cell(20,6,$docresult->CycleDate,'B',0);

    $pdf->Cell(20,6,'Lupron:',0,0);
    if($docresult->IsLupronYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsLupronNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO','R',0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO','R',0);
    }
    $pdf->Cell(10,6,'2dx:',0,0);
    $pdf->Cell(50,6,$docresult->dx2,'BR',1);
    $pdf->Cell(130,6,'','LBR',0);

    $pdf->Cell(15,6,'Ethnicity: ','B',0);
    $pdf->Cell(15,6,$docresult->Ethnicity,'B',0);
    $pdf->Cell(10,6,'Town: ','B',0);
    $pdf->Cell(20,6,$docresult->Town,'BR',1);

    $pdf->Cell(90,6,'Egg Retrieval: Day 0','LR',0);
    $pdf->Cell(12,6,'Sperm:','L',0);

    if($docresult->IsFresh==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(13,6,'Fresh',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(13,6,'Fresh',0,0);
    }

    if($docresult->IsFrozen==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(30,6,'Frozen husband',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(30,6,'Frozen husband',0,0);
    }

    if($docresult->IsTESE==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(13,6,'TESE',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(13,6,'TESE',0,0);
    }

    if($docresult->IsMESA==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(12,6,'MESA','R',1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(12,6,'MESA','R',1);
    }
    $pdf->Cell(15,6,'Ret Date:','L',0);
    $pdf->Cell(30,6,$docresult->RetDate,'B',0);
    $pdf->Cell(20,6,'# of Eggs:',0,0);
    $pdf->Cell(25,6,$docresult->RetNoOfEggs,'BR',0);
    $pdf->Cell(40,6,'',0,0);
    $pdf->Cell(30,6,'Pre Wash',0,0);
    $pdf->Cell(30,6,'Post Wash','R',1);

    $pdf->Cell(20,6,'Start Time:','L',0);
    $pdf->Cell(25,6,$docresult->RetStartTime,'B',0);
    $pdf->Cell(20,6,'Finish Time:',0,0);
    $pdf->Cell(25,6,$docresult->RetFinishTime,'BR',0);
    $pdf->Cell(40,6,'Vol(ml)',0,0);
    $pdf->Cell(30,6,$docresult->PreWashVol,0,0);
    $pdf->Cell(30,6,$docresult->PosWashVol,'R',1);

    $pdf->Cell(15,6,'Anest:','L',0);
    $pdf->Cell(30,6,$docresult->RetAnesthesiologistName,'B',0);
    $pdf->Cell(15,6,'Nurse:',0,0);
    $pdf->Cell(30,6,$docresult->RetNurseName,'BR',0);
    $pdf->Cell(40,6,'Conc(x10/mL)',0,0);
    $pdf->Cell(30,6,$docresult->PreWashConc,0,0);
    $pdf->Cell(30,6,$docresult->PosWashConc,'R',1);

    $pdf->Cell(15,6,'Embr:','L',0);
    $pdf->Cell(30,6,$docresult->RetEmbName,'B',0);
    $pdf->Cell(15,6,'Phys:',0,0);
    $pdf->Cell(30,6,$docresult->RetPhysicianName,'BR',0);
    $pdf->Cell(40,6,'Motility(%)',0,0);
    $pdf->Cell(30,6,$docresult->PreWashMotility,0,0);
    $pdf->Cell(30,6,$docresult->PosWashMotility,'R',1);

    $pdf->Cell(45,6,'Pt. Wristband Checked by:','L',0);
    $pdf->Cell(45,6,$docresult->RetWristCheckByName,'BR',0);
    $pdf->Cell(40,6,'Progression(1-4)',0,0);
    $pdf->Cell(30,6,$docresult->PreWashProg,0,0);
    $pdf->Cell(30,6,$docresult->PosWashProg,'R',1);

    $pdf->Cell(25,6,'Comments:','L',0);
    $pdf->Cell(65,6,$docresult->RetComments,'R',0);
    $pdf->Cell(40,6,'Tech',0,0);
    $pdf->Cell(30,6,$docresult->PreWashTech,0,0);
    $pdf->Cell(30,6,$docresult->PosWashTech,'R',1);

    $pdf->Cell(90,6,'','LR',0);
    $pdf->Cell(25,6,'Prep Method',0,0);

    if($docresult->IsPreMetIsolate==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(15,6,'Isolate',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(15,6,'Isolate',0,0);
    }

    if($docresult->IsPreMetWashOnly)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(20,6,'Wash Only',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(20,6,'Wash Only',0,0);
    }

    if($docresult->IsPreMetPentoxifyline)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(25,6,'Pentoxifyline','R',1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(25,6,'Pentoxifyline','R',1);
    }

    $pdf->Cell(90,6,'','LBR',0);
    $pdf->Cell(20,6,'Comments:','B',0);
    $pdf->Cell(80,6,$docresult->SpermComments,'BR',1);

    $pdf->Cell(45,6,'Insem Instruction:','LR',0);
    $pdf->Cell(45,6,'Fertilization Results:','R',0);
    $pdf->Cell(50,6,'Hyaluronidase:','R',0);
    $pdf->Cell(50,6,'ICSI:','R',1);

    $pdf->Cell(10,6,'ICSI:','L',0);
    $pdf->Cell(10,6,$docresult->InsInsICSI,'B',0);
    $pdf->Cell(10,6,'Conv:',0,0);
    $pdf->Cell(15,6,$docresult->InsInsConv,'BR',0);

    $pdf->Cell(15,6,'# 2PN:',0,0);
    $pdf->Cell(30,6,$docresult->FerRes2PN,'RB',0);

    $pdf->Cell(20,6,'Time/Tech:',0,0);
    $pdf->Cell(30,6,$docresult->HvaTime.' '.$docresult->HvaTech,'RB',0);
    $pdf->Cell(20,6,'Total # Inj:',0,0);
    $pdf->Cell(30,6,$docresult->ICSITotalInj,'RB',1);

    $pdf->Cell(25,6,'Insem Time:','L',0);
    $pdf->Cell(20,6,$docresult->InsInsTime,'BR',0);

    $pdf->Cell(15,6,'# 1PN:',0,0);
    $pdf->Cell(30,6,$docresult->FerRes1PN,'RB',0);

    $pdf->Cell(15,6,'MII:',0,0);
    $pdf->Cell(35,6,$docresult->HvaMII,'RB',0);
    $pdf->Cell(20,6,'Embr:',0,0);
    $pdf->Cell(30,6,$docresult->ICSIEmbName,'RB',1);

    $pdf->Cell(15,6,'Embr:','L',0);
    $pdf->Cell(30,6,$docresult->InsInsEmbrName,'BR',0);
    $pdf->Cell(15,6,'>=3PN',0,0);
    $pdf->Cell(30,6,$docresult->FerRes3PN,'RB',0);
    $pdf->Cell(15,6,'MI:',0,0);
    $pdf->Cell(35,6,$docresult->HvaMI,'RB',0);
    $pdf->Cell(50,6,'Comments:','R',1);

    $pdf->Cell(15,6,utf8_decode('2° ID:'),'BL',0);
    $pdf->Cell(30,6,$docresult->InsInsID,'BR',0);
    $pdf->Cell(15,6,'Embr:','B',0);
    $pdf->Cell(30,6,$docresult->FerResEmbrName,'RB',0);
    $pdf->Cell(10,6,'#GV:','B',0);
    $pdf->Cell(10,6,$docresult->HvaGV,'B',0);
    $pdf->Cell(15,6,'#Other:','B',0);
    $pdf->Cell(15,6,$docresult->HvaOther,'RB',0);
    $pdf->Cell(50,6,$docresult->ICSIComments,'RB',1);
    $pdf->Cell(0,1,'','LR',1);

    $pdf->Cell(40,6,'Embryo Transfer:','L',0);

    $pdf->Cell(10,6,'Date:',0,0);
    $pdf->Cell(25,6,$docresult->EmbTranDate,'B',0);
    $pdf->Cell(10,6,'Time:',0,0);
    $pdf->Cell(20,6,$docresult->EmbTranTime,'B',0);
    $pdf->Cell(25,6,'# Emb Trans:',0,0);
    $pdf->Cell(20,6,$docresult->EmbTranNoEmbTran,'B',0);

    $pdf->Cell(10,6,'AH:',0,0);
    
    if($docresult->IsEmbTranAHYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranAHNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO','R',1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO','R',1);
    }

    $pdf->Cell(20,6,'Physician:','L',0);
    $pdf->Cell(30,6,$docresult->EmbTranPhysiName,'B',0);
    $pdf->Cell(25,6,'Embryologist:',0,0);
    $pdf->Cell(30,6,$docresult->EmbTranEmbrName,'B',0);
    $pdf->Cell(25,6,'Days of Tran:',0,0);
    $pdf->Cell(15,6,$docresult->EmbTranDayOfTran,'B',0);

    $pdf->Cell(15,6,'A-CGH:',0,0);
    
    if($docresult->IsEmbTranACGHYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranACGHNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO','R',1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO','R',1);
    }

    $pdf->Cell(20,6,utf8_decode('Nurse/2° ID:'),'L',0);
    $pdf->Cell(85,6,$docresult->EmbTranNurseName.' / '.$docresult->EmbTranID,'B',0);
    $pdf->Cell(85,6,'Quality of embroyos Transfer/s:','R',1);

    $pdf->Cell(20,6,'Catheter:','L',0);
    $pdf->Cell(85,6,$docresult->EmbTranCatheter,'B',0);
    $pdf->Cell(85,6,$docresult->EmbTranQuaTrans,'R',1,'C');

    $pdf->Cell(25,6,'Tenac used:','L',0);
    
    if($docresult->IsEmbTranTenaYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranTeanNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO',0,0);
    }

    $pdf->Cell(20,6,'Bleeding:',0,0);
    
    if($docresult->IsEmbTranBleYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranBleNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO',0,0);
    }

    $pdf->Cell(20,6,'Cramping:',0,0);
    
    if($docresult->IsEmbTranACGHYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranACGHNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(45,6,'NO','R',1);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(45,6,'NO','R',1);
    }

    $pdf->Cell(20,6,'# Attempts:','L',0);
    $pdf->Cell(20,6,$docresult->EmbTranNoAttempts,'B',0);

    $pdf->Cell(35,6,'Embryos retained?:',0,0);
    if($docresult->IsEmbTranACGHYes==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'YES',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'YES',0,0);
    }

    if($docresult->IsEmbTranACGHNo==1)
    {
      checkbox( $pdf, TRUE);
      $pdf->Cell(10,6,'NO',0,0);
    }
    else
    {
      checkbox( $pdf, FALSE);
      $pdf->Cell(10,6,'NO',0,0);
    }

    $pdf->Cell(20,6,'# retained:',0,0);
    $pdf->Cell(20,6,$docresult->EmbTranNoRet,'B',0);
    $pdf->Cell(45,6,'','R',1);
    $pdf->Cell(20,6,'Comments:','LB',0);
    $pdf->Cell(0,6,$docresult->EmbTranComments,'BR',1);

    $pdf->Cell(50,6,'Oocyte Cryopreservation:','L',0);
    $pdf->Cell(35,6,'Vitrification solution:',0,0);
    $pdf->Cell(40,6,$docresult->OocCrvVitri,'B',0);
    $pdf->Cell(10,6,'Lot#:',0,0);
    $pdf->Cell(55,6,$docresult->OocCrvVitri,'BR',1);

    $pdf->Cell(15,6,'Exp date:','L',0);
    $pdf->Cell(25,6,$docresult->OocCrvExpDate,'B',0);
    $pdf->Cell(15,6,'Device:',0,0);
    $pdf->Cell(0,6,$docresult->OocCrvDevice,'BR',1);

    $pdf->Cell(10,6,'Date:','L',0);
    $pdf->Cell(25,6,$docresult->OocCrvDate,'B',0);
    $pdf->Cell(25,6,'Embryologist:',0,0);
    $pdf->Cell(30,6,$docresult->OocCrvEmbName,'B',0);
    $pdf->Cell(33,6,'Tank/Canister/Cane:',0,0);
    $pdf->Cell(10,6,$docresult->OocCrvTankCanCan,'B',0);
    $pdf->Cell(50,6,'TOTAL # FROZEN OOCYTES:',0,0);
    $pdf->Cell(0,6,$docresult->OocCrvTotalFroOoc,'BR',1);

    $pdf->Cell(20,6,'Comments:','LB',0);
    $pdf->Cell(0,6,$docresult->OocCrvComments,'BR',1);
    $pdf->Ln();
    $pdf->Cell(20,6,'NOTES:',0,0);
    $pdf->Write(6,$docresult->Notes);

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