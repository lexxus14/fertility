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

  $DocDate =0;

    $pdf->Cell(0,4,'FRESH Form',0,1,'C');

  foreach($docresults as $docresult)
  {
    $DocDate =$docresult->docdate;
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
  
  $pdf->Cell(10,6,'',0,1);
  
  foreach($docresultheaders as $docresultheader)                    
   {
    $pdf->Cell(0,5,'Schedule: '.$docresultheader->FreshSched,0,1);    
    $pdf->Cell(0,5,'Month: '.$docresultheader->Months,0,1);
    $pdf->Cell(0,5,'Notes: '.$docresultheader->Notes,0,1);
  }
  $pdf->Cell(10,6,'',0,1);
  $pdf->Cell(10,6,'BCP',0,0);
    $htmlTable="<table>
<tr>
<td>CD No</td>
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
    $w = array(20, 30, 30,110,);
    $pdf->WriteHTMLTable("$htmlTable",$w);

  $pdf->Cell(10,6,'Expected Date',0,0);
    $htmlTable="<table>
<tr>
<td>CD No</td>
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
    $w = array(20, 30, 30,110,);
    $pdf->WriteHTMLTable("$htmlTable",$w);

$pdf->Cell(10,6,'Expected Date',0,0);
    $htmlTable="<table>
<tr>
<td>CD No</td>
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


$strsql ="SELECT Dose, m.description as Medicine,mu.ShortSymbol,d.ShortSymbol as DayShifSymbol FROM `freshformmedsubs`
                                    INNER JOIN medicines m on m.id = freshformmedsubs.MedId
                                    INNER JOIN medicineunits mu on mu.id = freshformmedsubs.MedUnitId
                                    INNER JOIN dayshifts d on d.id = freshformmedsubs.DayShiftId
                                    WHERE FreshFormId =". $result->id;
                  
                          $subdocresults = DB::select($strsql);
                          $strAddOtherMed="";
                          foreach($subdocresults as $subdocresult )
                          {
                            $strAddOtherMed =$strAddOtherMed."$subdocresult->Medicine $subdocresult->Dose $subdocresult->ShortSymbol $subdocresult->DayShifSymbol
  ";
                          }



$htmlTable=$htmlTable.$strAddOtherMed."</td><td>$result->Notes</td>
</tr>";
}
  
    $htmlTable = $htmlTable."</table>";
    $w = array(20, 30, 30,40,70);
    $pdf->WriteHTMLTable("$htmlTable",$w);


      if(is_file(public_path($docresult->filelink)))                   
      {
        $file= asset($docresult->filelink);
        $pdf->Cell(40,6,'',0,1);
        $pdf->Cell(30,6,'Attached File: ',0,0);
        $html='<a href="'.$file.'" target="_blank">Existing File</a>';
        $pdf->WriteHTML($html);
      }
  

  
  $pdf->Output();
  exit;
?>