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
    $pdf->Cell(0,4,'OPERATIVE REPORT',0,1,'C');
    $pdf->Cell( 40, 6, 'Date: '.$docresult->docdate, 'B', 1); 
  }
  $pdf->Output();
  exit;
?>