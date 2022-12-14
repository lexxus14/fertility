<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\HtmlPaser;

class PDF extends Fpdf
{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';
    function Header()
    {
        // Logo
        // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        // $this->Cell(60);
        // Title
        $this->Cell(0,5,'PRC FERTILITY CENTER',0,1,'C');
        $this->SetFont('Arial','B',12);
        $this->Cell(0,5,'Dubai Healthcare City',0,1,'C');
        $this->SetFont('Arial','BI',8);
        $this->Cell(0,5,'Helping Create Families Every Day.',0,0,'C');
        // Line break
        $this->Ln(15);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function WriteHTML2($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract attributes
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $attr=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->Ln(10);
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->Ln(10);
    }

    function SetStyle($tag, $enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

    function WriteTable($data, $w)
    {
        $this->SetLineWidth(.3);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        foreach($data as $row)
        {
            $nb=0;
            for($i=0;$i<count($row);$i++)
                $nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
            $h=5*$nb;
            $this->CheckPageBreak($h);
            for($i=0;$i<count($row);$i++)
            {
                $x=$this->GetX();
                $y=$this->GetY();
                $this->Rect($x,$y,$w[$i],$h);
                $this->MultiCell($w[$i],5,trim($row[$i]),0,'C');                
                //Put the position to the right of the cell
                $this->SetXY($x+$w[$i],$y);                 
            }
            $this->Ln($h);

        }
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function ReplaceHTML($html)
    {
        $html = str_replace( '<li>', "\n<br> - " , $html );
        $html = str_replace( '<LI>', "\n - " , $html );
        $html = str_replace( '</ul>', "\n\n" , $html );
        $html = str_replace( '<strong>', "<b>" , $html );
        $html = str_replace( '</strong>', "</b>" , $html );
        $html = str_replace( '&#160;', "\n" , $html );
        $html = str_replace( '&nbsp;', " " , $html );
        $html = str_replace( '&quot;', "\"" , $html ); 
        $html = str_replace( '&#39;', "'" , $html );
        return $html;
    }

    function ParseTable($Table)
    {
        $_var='';
        $htmlText = $Table;
        $parser = new HtmlPaser ($htmlText);

        while ($parser->parse())
        {
            if(strtolower($parser->iNodeName)=='table')
            {
                if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
                    $_var .='/::';
                else
                    $_var .='::';
            }

            if(strtolower($parser->iNodeName)=='tr')
            {
                if($parser->iNodeType == NODE_TYPE_ENDELEMENT)
                    $_var .='!-:'; //opening row
                else
                    $_var .=':-!'; //closing row
            }
            if(strtolower($parser->iNodeName)=='td' && $parser->iNodeType == NODE_TYPE_ENDELEMENT)
            {
                $_var .='#,#';
            }
            if ($parser->iNodeName=='Text' && isset($parser->iNodeValue))
            {
                $_var .= $parser->iNodeValue;
            }
        }
        $elems = explode(':-!',str_replace('/','',str_replace('::','',str_replace('!-:','',$_var)))); //opening row
        foreach($elems as $key=>$value)
        {
            if(trim($value)!='')
            {
                $elems2 = explode('#,#',$value);
                array_pop($elems2);
                $data[] = $elems2;
            }
        }
        return $data;
    }
    function WriteHTML($html)
    {
        $html = $this->ReplaceHTML($html);
        //Search for a table
        $start = strpos(strtolower($html),'<table');
        $end = strpos(strtolower($html),'</table');
        if($start!==false && $end!==false)
        {
            $this->WriteHTML2(substr($html,0,$start).'<BR>');

            $tableVar = substr($html,$start,$end-$start);
            $tableData = $this->ParseTable($tableVar);
            for($i=1;$i<=count($tableData[0]);$i++)
            {
                if($this->CurOrientation=='L')
                    // $w[] = abs(120/(count($tableData[0])-1))+24;
                    $w[] = 30;
                else
                    $w[] = abs(120/(count($tableData[0])-1))+5;
            }
            $this->WriteTable($tableData,$w);

            $this->WriteHTML2(substr($html,$end+8,strlen($html)-1).'<BR>');
        }
        else
        {
            $this->WriteHTML2($html);
        }
    }

    function WriteHTMLTable($html,$w)
    {
        $html = $this->ReplaceHTML($html);
        //Search for a table
        $start = strpos(strtolower($html),'<table');
        $end = strpos(strtolower($html),'</table');
        if($start!==false && $end!==false)
        {
            $this->WriteHTML2(substr($html,0,$start).'<BR>');

            $tableVar = substr($html,$start,$end-$start);
            $tableData = $this->ParseTable($tableVar);
            // for($i=1;$i<=count($tableData[0]);$i++)
            // {
            //     if($this->CurOrientation=='L')
            //         // $w[] = abs(120/(count($tableData[0])-1))+24;
            //         $w[] = 30;
            //     else
            //         $w[] = abs(120/(count($tableData[0])-1))+5;
            // }
            $this->WriteTable($tableData,$w);

            $this->WriteHTML2(substr($html,$end+8,strlen($html)-1).'<BR>');
        }
        else
        {
            $this->WriteHTML2($html);
        }
    }

    function checkbox($checked = TRUE, $checkbox_size = 5 , $ori_font_family = 'Arial', $ori_font_size = '10', $ori_font_style = '' )
    {
        if($checked == TRUE)
        $check = "4";
        else
        $check = "";

        // $this->SetFont('ZapfDingbats','B', $ori_font_size);
        // $this->Cell($checkbox_size, $checkbox_size, $check, 1, 0);
        // $this->SetFont( $ori_font_family, $ori_font_style, $ori_font_size);
    }

}
