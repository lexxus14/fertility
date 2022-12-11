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
  $pdf->SetFont('Arial','B',10);

  $DocDate =0;
  foreach($docresultheaders as $docresultheader){
    $pdf->Cell(0,4,'FET Schedule for: '.$docresultheader->FedSched,0,1,'C');
    $pdf->Cell(0,4,'Month: '.$docresultheader->Months,0,1,'C');
    $pdf->Cell(0,4,"Note: $docresultheader->Notes",0,1,'C');
    $DocDate = $docresultheader->docdate;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);

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
  }
    
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(0,4,'',0,1);
    $pdf->Cell(0,4,'BCP',0,0);

    
    $htmlTable="<table>
<tr>
<td>Day</td>
<td>Date</td>
<td>Day</td>
<td>Notes</td>
</tr>";

foreach($docresultBCPS as $result)
{
$htmlTable=$htmlTable."<tr>
<td>$result->CycleNo</td>
<td>$result->CycleDate</td>
<td>".date('l', strtotime($result->CycleDate))."</td>
<td>$result->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(10, 40, 40, 100);
    $pdf->WriteHTMLTable("$htmlTable",$w);

 $pdf->Cell(0,4,'Expected Date',0,0);

    
    $htmlTable="<table>
<tr>
<td>Day</td>
<td>Date</td>
<td>Day</td>
<td>Notes</td>
</tr>";

foreach($docresultExpDate as $result)
{
$htmlTable=$htmlTable."<tr>
<td>$result->CycleNo</td>
<td>$result->CycleDate</td>
<td>".date('l', strtotime($result->CycleDate))."</td>
<td>$result->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(10, 40, 40, 100);
    $pdf->WriteHTMLTable("$htmlTable",$w);

 $pdf->Cell(0,4,'Main',0,0);

    
    $htmlTable="<table>
<tr>
<td>Day</td>
<td>Date</td>
<td>Day</td>
<td>Medicine</td>
<td>Notes</td>
</tr>";

foreach($docresults as $result)
{
$htmlTable=$htmlTable."<tr>
<td>$result->CycleNo</td>
<td>$result->CycleDate</td>
<td>".date('l', strtotime($result->CycleDate))."</td><td>";

$strsql ="SELECT Dose, m.description as Medicine,mu.ShortSymbol,d.ShortSymbol as DayShifSymbol FROM `fetsmedsubs`
                                    INNER JOIN medicines m on m.id = fetsmedsubs.MedId
                                    INNER JOIN medicineunits mu on mu.id = fetsmedsubs.MedUnitId
                                    INNER JOIN dayshifts d on d.id = fetsmedsubs.DayShiftId
                                    WHERE FetId =". $result->id;

$subdocresults = DB::select($strsql);
$strAddOtherMed ="";
foreach($subdocresults as $subdocresult )
{
  $strAddOtherMed =$strAddOtherMed." $subdocresult->Medicine $subdocresult->Dose $subdocresult->ShortSymbol $subdocresult->DayShifSymbol
  ";
}
                     

$htmlTable=$htmlTable.$strAddOtherMed."</td>

<td>$result->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(10, 40, 40,40, 60);
    $pdf->WriteHTMLTable("$htmlTable",$w);
$pdf->Cell(0,4,'Others',0,0);
$htmlTable="<table>
<tr>
<td>Date</td>
<td>Day</td>
<td>Medicine</td>
<td>Notes</td>
</tr>";

foreach($docresultFETothers as $result)
{
$htmlTable=$htmlTable."<tr>
<td>$result->CycleDate</td>
<td>".date('l', strtotime($result->CycleDate))."</td><td>";

$strsql ="SELECT Dose, m.description as Medicine,mu.ShortSymbol,d.ShortSymbol as DayShifSymbol FROM `fetsothermedsubs`
                                    INNER JOIN medicines m on m.id = fetsothermedsubs.MedId
                                    INNER JOIN medicineunits mu on mu.id = fetsothermedsubs.MedUnitId
                                    INNER JOIN dayshifts d on d.id = fetsothermedsubs.DayShiftId
                                    WHERE fetothersId =". $result->id;

$subdocresults = DB::select($strsql);
$strAddOtherMed ="";
foreach($subdocresults as $subdocresult )
{
  $strAddOtherMed =$strAddOtherMed." $subdocresult->Medicine $subdocresult->Dose $subdocresult->ShortSymbol $subdocresult->DayShifSymbol
  ";
}
                     

$htmlTable=$htmlTable.$strAddOtherMed."</td>

<td>$result->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(40, 40, 40,70);
    $pdf->WriteHTMLTable("$htmlTable",$w);

 
  
  $pdf->Output();
  exit;
?>