<?php
include("check_oper.php");
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $result=mysqli_query($link,"select name, genre, developer, publisher, game_key, date_buy, date_exp, url from games 
 left outer JOIN `keys` on games.game_id=`keys`.`game_id` left outer JOIN store on `keys`.`store_id`=store.store_id
order by games.name");
$header= array("№ п/п","Название","Жанр","Разработчик","Издатель","Цифровой ключ","Дата приобретения",
"Дата окончания","URL магазина");

require('FPDF/fpdf.php');
define('FPDF_FONTPATH',"FPDF/font/");

class PDF extends FPDF
{
function Headr($header)
{   $this->SetFillColor(200);
    $this->Cell(12,7,iconv('utf-8', 'windows-1251',$header[0]),1,'','',true);
    $this->Cell(50,7,iconv('utf-8', 'windows-1251',$header[1]),1,'','',true);
    $this->Cell(35,7,iconv('utf-8', 'windows-1251',$header[2]),1,'','',true);
    $this->Cell(50,7,iconv('utf-8', 'windows-1251',$header[3]),1,'','',true);
    $this->Cell(50,7,iconv('utf-8', 'windows-1251',$header[4]),1,'','',true);
    $this->Cell(50,7,iconv('utf-8', 'windows-1251',$header[5]),1,'','',true);
    $this->Cell(35,7,iconv('utf-8', 'windows-1251',$header[6]),1,'','',true);
    $this->Cell(35,7,iconv('utf-8', 'windows-1251',$header[7]),1,'','',true);
    $this->Cell(60,7,iconv('utf-8', 'windows-1251',$header[8]),1,'','',true);
    $this->Ln();
}
function BasicTable($result)
{
    $a=1;
    $fill=true;
    while($object = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $this->SetFillColor(235);
        $this->Cell(12,6,$a,1,'','',$fill);
        $this->Cell(50,6,iconv('utf-8', 'windows-1251',$object['name']),1,'','',$fill);
        $this->Cell(35,6,iconv('utf-8', 'windows-1251',$object['genre']),1,'','',$fill);
        $this->Cell(50,6,iconv('utf-8', 'windows-1251',$object['developer']),1,'','',$fill);
        $this->Cell(50,6,iconv('utf-8', 'windows-1251',$object['publisher']),1,'','',$fill);
        $this->Cell(50,6,iconv('utf-8', 'windows-1251',$object['game_key']),1,'','',$fill);
        $this->Cell(35,6,iconv('utf-8', 'windows-1251',date("d.m.Y", strtotime($object['date_buy']))),1,'','',$fill);
        $this->Cell(35,6,iconv('utf-8', 'windows-1251',date("d.m.Y", strtotime($object['date_exp']))),1,'','',$fill);
        $this->Cell(60,6,iconv('utf-8', 'windows-1251',$object['url']),1,'','',$fill);
        $this->Ln();
        $a++;
        $fill=!$fill;
    }
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,iconv('utf-8', 'windows-1251',$data[$row]),1);
        $this->Ln();
    }
}
}
//create a FPDF object
$pdf=new PDF();
//set document properties
$pdf->AddFont('Arial','','arial.php'); 
$pdf->SetTitle('Таблица игр',true);
//set font for the entire document
$pdf->SetFont('Arial');
//set up a page
$pdf->AddPage('L','A3');
$pdf->SetDisplayMode('real','default');
$pdf->SetXY (10,20);
$pdf->SetFontSize(10);
//Output the document
$pdf->Headr($header);
$pdf->BasicTable($result);
$pdf->Output('Таблица игр.pdf','D',true);
?>