<?php
include("check_oper.php");
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $result=mysqli_query($link,"select name, genre, developer, publisher, game_key, 
 date_buy, date_exp, url from games left outer JOIN `keys` on games.game_id=`keys`.`game_id`
 left outer JOIN store on `keys`.`store_id`=store.store_id
order by games.name");
$header= array("№ п/п","Название","Жанр","Разработчик","Издатель","Цифровой ключ","Дата приобретения",
"Дата окончания","URL магазина");

require __DIR__.'/../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$a=1;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(
        $header,   // The data to set
        NULL,        // Array values with this value will not be set
        'A'.$a         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );
while($object = mysqli_fetch_array($result,MYSQLI_NUM)){
    $sheet->setCellValue('A'.$a+1,$a);
	$object[5]=date("d.m.Y", strtotime($object[5]));
    $object[6]=date("d.m.Y", strtotime($object[6]));
    $sheet->fromArray(
        $object,   // The data to set
        NULL,        // Array values with this value will not be set
        'B'.$a+1         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );
    $a++;
}
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Таблица игр.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
//$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
$writer->save('php://output');
exit();
?>