<head>
<title>Салихов Рашит</title>
</head>
<?php
require_once "lab2-6lib.php";
$m = rand(1,15);
$n = rand(1,15);
fUsl3();
$arr = fZapAr($n,$m);
fTab($arr,$n,$m);
$arr = fObv3($arr,$n,$m);
fTab($arr,$n,$m);
?>