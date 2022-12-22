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
    $CycleNo =$docresult->CycleNo;
  }
  $pdf->Cell(145,6,'PRC FERTILITY CENTER','LT',0);
  $pdf->Cell(45,6,'IVF Lab Record, pg2','TR',1);
  $pdf->Cell(150,6,'DUBAI DHCC','L',0);
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(15,6,'record #: ',0,0);
  $pdf->SetFont('Arial','B',10); 
  $pdf->Cell(0,6,$RecNumber,'BR',1);
  $pdf->Cell(150,1,'','LB',0);
  $pdf->Cell(40,1,'','RB',1);

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',0);
    $pdf->Cell(15,6,'Cycle No: ',0,0);
    $pdf->Cell(25,6,$CycleNo,'B',0);
    $pdf->Cell(75,6,'',0,0);
    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(0,6,$DocDate,'B',1);    
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
  $pdf->Ln();
  foreach($docresults as $docresult)
  {
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10,20,'No',1,0,'C');
    $pdf->Cell(30,8,'Day 0: '.$docresult->Day0Date,'TR',0,'C');
    $pdf->Cell(30,8,'Day 1: '.$docresult->Day1Date,'TR',0,'C');
    $pdf->Cell(30,4,'Day 3: '.$docresult->Day3Date,'TR',0,'C');
    $pdf->Cell(30,4,'Day 5: '.$docresult->Day5Date,'TR',0,'C');
    $pdf->Cell(30,4,'Day 6: '.$docresult->Day6Date,'TR',0,'C');
    $pdf->Cell(30,4,'Disposition','TR',1,'C');

    $pdf->Cell(10,4,'',0,0,'C');
    $pdf->Cell(30,4,'',0,0,'C');
    $pdf->Cell(30,4,'',0,0,'C');
    $pdf->Cell(30,4,'Time: '.$docresult->Day3Time,'R',0,'C');
    $pdf->Cell(30,4,'Time: '.$docresult->Day5Time,'R',0,'C');
    $pdf->Cell(30,4,'Time: '.$docresult->Day6Time,'R',0,'C');
    $pdf->Cell(30,4,'ET-Transfer','R',1,'C');

    $pdf->Cell(10,4,'',0,0,'C');
    $pdf->Cell(30,4,'Time: '.$docresult->Day0Time,'R',0,'C');
    $pdf->Cell(30,4,'Time: '.$docresult->Day1Time,'R',0,'C');
    $pdf->Cell(30,4,'Embr: '.$docresult->Day3EmbryologistName,'R',0,'C');
    $pdf->Cell(30,4,'Embr: '.$docresult->Day5EmbryologistName,'R',0,'C');
    $pdf->Cell(30,4,'Embr: '.$docresult->Day6EmbryologistName,'R',0,'C');
    $pdf->Cell(30,4,'C-egg Cyro','R',1,'C');

    $pdf->Cell(10,4,'',0,0,'C');
    $pdf->Cell(30,4,'Embr: '.$docresult->Day0EmbryologistName,'R',0,'C');
    $pdf->Cell(30,4,'Embr: '.$docresult->Day1EmbryologistName,'R',0,'C');
    $pdf->Cell(30,4,'AH Time '.$docresult->Day3AhTime.' AH','R',0,'C');
    $pdf->Cell(30,4,'bx time'.$docresult->Day5AhTime.' bx','R',0,'C');
    $pdf->Cell(30,4,'bx time '.$docresult->Day6AhTime.' bx','R',0,'C');
    $pdf->Cell(30,4,'D-Discard','R',1,'C');

    $pdf->Cell(10,4,'',0,0,'C');
    $pdf->Cell(12,4,'maturity',1,0,'C');
    $pdf->Cell(12,4,'remarks',1,0,'C');
    $pdf->Cell(6,4,'icsi',1,0,'C');
    $pdf->Cell(9,4,'PB',1,0,'C');
    $pdf->Cell(9,4,'PN',1,0,'C');
    $pdf->Cell(12,4,'Remarks',1,0,'C');
    $pdf->Cell(30,4,'Tech: '.$docresult->Day3AhTech,'RB',0,'C');
    $pdf->Cell(30,4,'Tech: '.$docresult->Day5AhTech,'RB',0,'C');
    $pdf->Cell(30,4,'Tech: '.$docresult->Day6AhTech,'RB',0,'C');
    $pdf->Cell(30,4,'','RB',1,'C');

    $intCtr=0;
    foreach($EmbryologyRecordIISubs as $EmbryologyRecordIISub)
    {
      $pdf->Cell(10,4,++$intCtr,'LB',0,'C');
      $pdf->Cell(12,4,$EmbryologyRecordIISub->maturity,1,0,'C');
      $pdf->Cell(12,4,$EmbryologyRecordIISub->Day0remarks,1,0,'C');
      $pdf->Cell(6,4,$EmbryologyRecordIISub->icsi,1,0,'C');
      $pdf->Cell(9,4,$EmbryologyRecordIISub->PB,1,0,'C');
      $pdf->Cell(9,4,$EmbryologyRecordIISub->PN,1,0,'C');
      $pdf->Cell(12,4,$EmbryologyRecordIISub->Day1remarks,1,0,'C');
      $pdf->Cell(30,4,$EmbryologyRecordIISub->Day3remarks,'RB',0,'C');
      $pdf->Cell(30,4,$EmbryologyRecordIISub->Day5remarks,'RB',0,'C');
      $pdf->Cell(30,4,$EmbryologyRecordIISub->Day6remarks,'RB',0,'C');
      $pdf->Cell(30,4,$EmbryologyRecordIISub->Dispositionremarks,'RB',1,'C');
    }
    $pdf->Cell(10,4,'',1,0,'C');
    $pdf->Cell(30,4,'','BR',0,'C');
    $pdf->Cell(30,4,$docresult->Day1PtCall.' PT Cal '.$docresult->Day1Initial.' Initial','BR',0,'C');
    $pdf->Cell(30,4,$docresult->Day3PtCall.' PT Cal '.$docresult->Day3Initial.' Initial','BR',0,'C');
    $pdf->Cell(30,4,$docresult->Day5PtCall.' PT Cal '.$docresult->Day5Initial.' Initial','BR',0,'C');
    $pdf->Cell(30,4,$docresult->Day6PtCall.' PT Cal '.$docresult->Day6Initial.' Initial','BR',0,'C');
    $pdf->Cell(30,4,'','BR',1,'C');

    $pdf->SetFont('Arial','',12);

    $pdf->Ln();
    $pdf->Cell(15,6,'Notes: ',0,0);
    $pdf->Write(6,$docresult->Notes);

    
    $pdf->Ln();
    
    $pdf->Cell(15,6,'Lot Numbers: ',0,1);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(38,6,'ASP: lot# ','TLR',0);
    $pdf->Cell(38,6,'ASP: Exp. Date ','TR',0);
    $pdf->Cell(38,6,'Protien:SSS Lot # ','TR',0);
    $pdf->Cell(38,6,'Protien:SSS Exp. Date ','TR',0);
    $pdf->Cell(38,6,'Others ','TR',1);

    $pdf->Cell(38,6,$docresult->AspLotNo,'LRB',0);
    $pdf->Cell(38,6,$docresult->AspExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->ProteinSSSLot,'RB',0);
    $pdf->Cell(38,6,$docresult->ProteinSSSExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->AspOthers,'RB',1);

    $pdf->Cell(38,6,'Global Lot #','LR',0);
    $pdf->Cell(38,6,'Global Date','R',0);
    $pdf->Cell(38,6,'mHTF Lot #','R',0);
    $pdf->Cell(38,6,'mHT FExp Date','R',0);
    $pdf->Cell(38,6,'Others ','R',1);

    $pdf->Cell(38,6,$docresult->GlobalLotNo,'LRB',0);
    $pdf->Cell(38,6,$docresult->GlobalExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->mHTFLotNo,'RB',0);
    $pdf->Cell(38,6,$docresult->mHTFExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->GlobalOther,'RB',1);

    $pdf->Cell(38,6,'Hyluronidase Log #','LR',0);
    $pdf->Cell(38,6,'Hyluronidase Exp Date','R',0);
    $pdf->Cell(38,6,'Oil Lot No','R',0);
    $pdf->Cell(38,6,'Oil Exp Date','R',0);
    $pdf->Cell(38,6,'Others ','R',1);

    $pdf->Cell(38,6,$docresult->HyluronidaseLogNo,'LRB',0);
    $pdf->Cell(38,6,$docresult->HyluronidaseExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->OilLotNo,'RB',0);
    $pdf->Cell(38,6,$docresult->OilExpDate,'RB',0);
    $pdf->Cell(38,6,$docresult->GlobalOthers,'RB',1);

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