<?php
  $pdf = new App\PDF('L','mm','A4');
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
  $pdf->Cell(0,10,'Stimulating Medication',0,1,'C');
  $DocDate =0;
  foreach($docresults as $docresult){
    $DocDate=$docresult->docdate;
  }

  foreach($patients as $patient){
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(15,6,'Date: ',0,0);
    $pdf->Cell(25,6,$DocDate,'B',0);
    $pdf->Cell(145,6,'',0,0);
    // $pdf->Cell(40,6,'',0,1);
    $pdf->Cell(15,6,'File No: ',0,0);
    $pdf->Cell(25,6,$patient->FileNo,'B',1);
    $pdf->Cell(35,6,'Wife Name: ',0,0);
    $pdf->Cell(150,6,$patient->WifeLastName.', '.$patient->WifeName,'B',0);
    $pdf->Cell(25,6,'Contact No: ',0,0);
    $pdf->Cell(0,6,$patient->WifeContactNo,'B',1);

    $pdf->Cell(35,6,'Husband Name: ',0,0);
    $pdf->Cell(150,6,$patient->HusbandLastName.', '.$patient->HusbandName,'B',0);
    $pdf->Cell(25,6,'Contact No: ',0,0);
    $pdf->Cell(0,6,$patient->HusbandContactNo,'B',1);
    
    $pdf->SetFont('Arial','',8);
    $htmlTable="<table>
<tr>
<td>Cycle Day</td>
<td>Stimulating Medication</td>
<td>Date</td>
<td>Day</td>
<td>Breakfast</td>
<td>Lunch</td>
<td>Dinner</td>
<td>Other Medicine</td>
<td>Notes</td>
</tr>";

foreach($docresults as $result)
{
$htmlTable=$htmlTable."<tr>
<td>$result->CycleNo</td>
<td>AM $result->MedDoseAM $result->MuPMSymbol $result->MedAm 
PM $result->MedDosePM $result->MuPMSymbol $result->MedPm 
</td>
<td>$result->docdate</td>
<td>".date('l', strtotime($result->docdate))."</td>
<td>$result->Breakfast</td>
<td>$result->Lunch</td>
<td>$result->Dinner</td>
<td>";


$strsql ="SELECT dose, m.description as Medicine,mu.ShortSymbol FROM `stimedothmedsubs`
          INNER JOIN medicines m on m.id = stimedothmedsubs.MedId
          INNER JOIN medicineunits mu on mu.id = stimedothmedsubs.UnitId
          WHERE StimulatingMedicationsid =". $result->id;

$subdocresults = DB::select($strsql);
$strAddOtherMed ="";
foreach($subdocresults as $subdocresult )
{
  $strAddOtherMed =$strAddOtherMed." $subdocresult->Medicine $subdocresult->dose $subdocresult->ShortSymbol
  ";
}
                     

$htmlTable=$htmlTable.$strAddOtherMed."</td>
<td>
$result->Notes
</td>
</tr>";
}

    $htmlTable = $htmlTable."</table>";
    $w = array(10, 40, 20, 20,20, 20, 20, 60,70);
    $pdf->WriteHTMLTable("$htmlTable",$w);
  }
  $pdf->Output();
  exit;
?>