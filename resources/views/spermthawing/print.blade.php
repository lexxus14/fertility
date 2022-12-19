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

    $pdf->Cell(0,4,'Sperm Thawing',0,1,'C');

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
    $pdf->Cell(25,6,$patient->WifeBirthDate,'B',0);

    $bday = new DateTime($patient->HusbandBirthDate); // Your date of birth
    $today = new Datetime(date('m.d.y'));
    $diff = $today->diff($bday);

    $pdf->Cell(10,6,'Age:',0,0);
    $pdf->Cell(0,6,$diff->format('%y'),'B',1);
  }

  foreach($docresults as $docresult)
  {
     $htmlTable="<table>
<tr>
<td></td>
<td>Unit 4020 Building 64, Dubai
Healthcare City
Dubai, UAE</td>
<td>SPERM STORAGE
REPORT</td>
</tr>";

    $htmlTable = $htmlTable."</table>";
    $w = array(60, 60, 60);
    $pdf->WriteHTMLTable("$htmlTable",$w);
  }

  $pdf->Ln();
  $pdf->Cell(0,6,'PRC PROCESSED SPERM',0,1);
  $htmlTable="<table>
<tr>
<td># Of Vials</td>
<td>Date Recovered</td>
<td>Office</td>
<td>Specimen Type</td>
</tr>";
foreach($SpermThawingProcSubs as $SpermThawingProcSub)
{
$htmlTable=$htmlTable."<tr>
<td>$SpermThawingProcSub->NoOfVials</td>
<td>$SpermThawingProcSub->DateRecovered</td>
<td>$SpermThawingProcSub->Office</td>
<td>";

if($SpermThawingProcSub->IsFresh)
{
$htmlTable=$htmlTable."Fresh
";
}

if($SpermThawingProcSub->IsTESEPESAMESA)
{
$htmlTable=$htmlTable."TESE PESA MESA
";
}

if($SpermThawingProcSub->IsPrevFroz)
{
$htmlTable=$htmlTable."Previously Frozen";
}
$htmlTable=$htmlTable."</td>
</tr>";  
}

    $htmlTable = $htmlTable."</table>";
    $w = array(25, 50, 50, 50);
    $pdf->WriteHTMLTable("$htmlTable",$w);

    $pdf->Ln();
    $pdf->Cell(30,6,'Comments',0,1);
    $pdf->Write(6,$docresult->Notes);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->Cell(80,6,'COMPLETED BY: '.$docresult->StaffName,0,0);
    $pdf->Cell(70,6,'SIGNATURE',0,0);
    $pdf->Cell(0,6,'DATE',0,0);

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