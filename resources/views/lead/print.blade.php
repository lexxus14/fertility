<?php
  $pdf = new App\PDF('P','mm','A4');

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
//cel (w,h,text,border(01LRBT),ln(012),align(LCR),fill,link)
foreach($patients as $patient){
    $pdf->SetFont('Arial','BU',16);
    $pdf->Cell(0,10,'Patient Profile',0,1,'C');

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(40,6,'File NO: ',0,0);
    $pdf->Cell(50,6,$patient->FileNo,'B',1);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(40,6,'Contact Person:',0,0);
    $pdf->Cell(0,6,$patient->MainContactPerson,'B',1);
    $pdf->Cell(40,6,'Contact Number:',0,0);
    $pdf->Cell(0,6,$patient->MainContactNo,'B',1);
    $pdf->Cell(40,6,'Email:',0,0);
    $pdf->Cell(0,6,$patient->MainEmail,'B',1);
    
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(40,6,'Wife Information',0,1);
    if($patient->IsWifePatient==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(25,6,'Is Patient',0,1);

    $pdf->Cell(15,6,'Name:',0,0);
    $pdf->Cell(50,6,$patient->WifeName,'B',0);
    $pdf->Cell(25,6,'Last Name:',0,0);
    $pdf->Cell(50,6,$patient->WifeName,'B',0);
    $pdf->Cell(20,6,'Birthday:',0,0);
    $pdf->Cell(25,6,$patient->WifeBirthDate,'B',1);

    $dateOfBirth = date_create(date_format(new DateTime($patient->WifeBirthDate),"Y-m-d"));
    $today = date_create(date("Y-m-d"));
    $diff = date_diff($dateOfBirth, $today);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(10,6,$diff->format('%y'),'B',0);

    $pdf->Cell(26,6,'Married Year:',0,0);
    $pdf->Cell(26,6,$patient->MarriedSince,'B',0);

    $dateOfBirth = date_create(date_format(new DateTime($patient->MarriedSince),"Y-m-d"));
    $today = date_create(date("Y-m-d"));
    $diff = date_diff($dateOfBirth, $today);

    $pdf->Cell(28,6,'Married Since:',0,0);
    $pdf->Cell(10,6,$diff->format('%y'),'B',0);

    $pdf->Cell(18,6,'Address:',0,0);
    $pdf->Cell(0,6,$patient->WifeAddress,'B',1);

    $pdf->Cell(22,6,'Email Add:',0,0);
    $pdf->Cell(50,6,$patient->WifeEmailAddress,'B',0);
    $pdf->Cell(24,6,'Contact No:',0,0);
    $pdf->Cell(30,6,$patient->WifeContactNo,'B',0);
    $pdf->Cell(24,6,'Nationality:',0,0);
    $pdf->Cell(0,6,$patient->WifeNationality,'B',1);

    if($patient->IsIVF=='on')
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(25,6,'IVF Before',0,0);
   
    if($patient->IsHasChildren=='on')
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(28,6,'Has Children',0,0); 
   
    if($patient->IsMiscarriage=='on')
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',12);    
    $pdf->Cell(25,6,'Has Miscarriage',0,0); 

    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(40,6,'Husband Information',0,1);
    if($patient->IsHusbandPatient==1)
    {    
      checkbox( $pdf, TRUE);
    }
    else
    {
      checkbox( $pdf, FALSE);
    }
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(25,6,'Is Patient',0,1);
    $pdf->Cell(15,6,'Name:',0,0);
    $pdf->Cell(50,6,$patient->HusbandName,'B',0);
    $pdf->Cell(25,6,'Last Name:',0,0);
    $pdf->Cell(50,6,$patient->HusbandLastName,'B',0);
    $pdf->Cell(20,6,'Birthday:',0,0);
    $pdf->Cell(25,6,$patient->HusbandBirthDate,'B',1);

    $dateOfBirth = date_create(date_format(new DateTime($patient->HusbandBirthDate),"Y-m-d"));
    $today = date_create(date("Y-m-d"));
    $diff = date_diff($dateOfBirth, $today);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(10,6,$diff->format('%y'),'B',0);

    
    $pdf->Cell(18,6,'Address:',0,0);
    $pdf->Cell(0,6,$patient->HusbandAddress,'B',1);

    $pdf->Cell(22,6,'Email Add:',0,0);
    $pdf->Cell(50,6,$patient->HusbandEmailAddress,'B',0);
    $pdf->Cell(24,6,'Contact No:',0,0);
    $pdf->Cell(30,6,$patient->HusbandContactNo,'B',0);
    $pdf->Cell(24,6,'Nationality:',0,0);
    $pdf->Cell(0,6,$patient->HusbandNationality,'B',1);
    $pdf->Cell(18,6,'',0,1);
    $pdf->Cell(18,6,'',0,1);
    $pdf->Cell(24,6,'Notes:',0,0);
    $pdf->Write(6,$patient->Notes);

   

    }
$pdf->Output();
exit;

?>