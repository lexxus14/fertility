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
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(0,10,'Vital Sign',0,1,'C');
  $DocDate =0;
  foreach($docresults as $docresult){
    $DocDate=$docresult->docdate;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,6,'',0,1);

    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(25,6,$DocDate,'B',1);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',1);
    $pdf->Cell(35,6,'Wife Name: ',0,0);
    $pdf->Cell(100,6,$patient->WifeLastName.', '.$patient->WifeName,'B',0);
    $pdf->Cell(25,6,'Contact No: ',0,0);
    $pdf->Cell(0,6,$patient->WifeContactNo,'B',1);

    $pdf->Cell(35,6,'Husband Name: ',0,0);
    $pdf->Cell(100,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',0);
    $pdf->Cell(25,6,'Contact No: ',0,0);
    $pdf->Cell(0,6,$patient->HusbandContactNo,'B',1);
    
    foreach($docresults as $docresult)
    {
      $pdf->Cell(40,6,'',0,1);
      $pdf->Cell(25,6,'Description: ',0,0);
      $pdf->Cell(0,6,$docresult->description,'B',1);

      $header = array('No', 'Vital Sign','Result');
      
      // Colors, line width and bold font
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('','B');
        // Header
        $w = array(15, 150, 25);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        $intCtr=0;
        foreach($patientvitalsignssubs as $row)
        {
            $pdf->Cell($w[0],6,++$intCtr,'LR',0,'L',$fill);
            $pdf->Cell($w[1],6,$row->description,'LR',0,'L',$fill);
            $pdf->Cell($w[2],6,$row->notes,'LR',0,'R',$fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        // Closing line
        $pdf->Cell(array_sum($w),0,'','T');

      $pdf->Cell(40,6,'',0,1);$pdf->Cell(40,6,'',0,1);
      $pdf->Cell(15,6,'Notes: ',0,0);
      $pdf->Write(6,$docresult->notes);


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