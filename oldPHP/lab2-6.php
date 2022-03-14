<head>
<title>Салихов Рашит</title>
</head>
<?php
require_once "lab2-6lib.php";
$m = rand(1,15);
$n = rand(1,15);
fUsl3();
$arr = fZapAr($n,$m);
print ("<br>Исходный массив:<br>");
fTab($arr,$n,$m);
$arr = fObv3($arr,$n,$m);
print ("<br><br>Скорректированный массив:<br>");
fTab($arr,$n,$m);
fUsl6();
$arr1 = fZapAr($n,$n);
print ("<br>Массив:<br>");
fTab($arr1,$n,$n);
print ("<br>Ответ:<br>");
$arr1 = fObv6($arr1,$n,$n);
?>