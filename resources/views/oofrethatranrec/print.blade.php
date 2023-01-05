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

  $pdf->Cell(0,4,'OOcyte Freeze Thawing Transfer Record',0,1,'C');

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
  $pdf->Ln();
  $pdf->Ln();
  foreach($OOcyteSubs as $OOcyteSub)
  {
    $strsql ="select * from OOctyeFreezeThawTransRecSubDetails 
        where OOcFTTRSubId=".$OOcyteSub->id;

    $OOcyteSubDetails = DB::select($strsql);


    $pdf->Cell(120,6,'OOCYTE FREEZING',1,0);
    $pdf->Cell(70,6,'OOCYTE THAWING',1,1);
    $pdf->Cell(40,6,'STRAW NO',1,0);
    $pdf->Cell(40,6,'OOCTYE NO',1,0);
    $pdf->Cell(40,6,'MATURATION',1,0);
    $pdf->Cell(35,6,'STAGE/GRADE',1,0);
    $pdf->Cell(35,6,'THAW(Y/N)',1,1);
    foreach($OOcyteSubDetails as $OOcyteSubDetail)
    {
      $pdf->Cell(40,6,$OOcyteSubDetail->StrawNo,1,0);
      $pdf->Cell(40,6,$OOcyteSubDetail->OoctyeNo,1,0);
      $pdf->Cell(40,6,$OOcyteSubDetail->Maturation,1,0);
      $pdf->Cell(35,6,$OOcyteSubDetail->StageGrade,1,0);
      if($OOcyteSubDetail->IsThawYes==1)
      {
      $pdf->Cell(35,6,'YES',1,1);
      }
      else
      {
      $pdf->Cell(35,6,'NO',1,1);
      }
    }
  }

  foreach($docresults as $docresult)
    {

      $pdf->Ln();

      $pdf->Cell(45,6,'TRANSFER DATE/TIME:',0,0);
      $pdf->Cell(30,6,$docresult->docdate.' '.$docresult->TransferTime,'B',0);
      $pdf->Cell(35,6,'# OF EMB TRANS:',0,0);
      $pdf->Cell(35,6,$docresult->NoOfEmbTrans,'B',0);
      $pdf->Cell(35,6,'# OF ATTEMPTS:',0,0);
      $pdf->Cell(0,6,$docresult->NoOfAttempts,'B',1);

      $pdf->Cell(15,6,'AH:',0,0);
      if($docresult->IsAHYes==1)
      {
        $pdf->Cell(35,6,'YES','B',0);      
      }
      else
      {
      $pdf->Cell(35,6,'NO','B',0);      
      }
      $pdf->Cell(35,6,'CATHETER LOADING:',0,0);    
      $pdf->Cell(0,6,$docresult->CathLoading,'B',1);  
      $pdf->Cell(25,6,'PHYSICIAN:',0,0);      
      $pdf->Cell(35,6,$docresult->PhysicianStaffName,'B',0);      
      $pdf->Cell(35,6,'EMBRYOLOGIST:',0,0);      
      $pdf->Cell(35,6,$docresult->EmbryologistStaffName,'B',0);      
      $pdf->Cell(20,6,'NURSE:',0,0);      
      $pdf->Cell(0,6,$docresult->NurseStaffName,'B',0);      
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