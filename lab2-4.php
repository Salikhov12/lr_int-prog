<head>
<title>Салихов Рашит</title>
</head>
Вариант 3.
<?php
$N = rand(1,100); #Количество случайных элементов массива
$K = rand(0,$N);
$min = 1000;
for ($i=0;$i<$N;$i++){
	$A[$i] = rand(-500,500);
	if (($K>$i)&&($min>$A[$i])){
		$min = $A[$i];
	}
}
print("<br>Исходный массив:<br>");
foreach ($A as $value){
	print($value." ");
}
for ($i=0;$i<$N;$i++){
	$A[$i] = $min;
}
print('<br><br>$K = '.$K.', $min = '.$min."<br>");
print ("<br>Полученный массив:<br>");
foreach ($A as $value){
	print($value." ");
}
print("<br><br>Вариант 6.<br>");
$N = rand(1,100); #Количество случайных элементов массива
for ($i=0;$i<$N;$i++){
	$A[$i] = rand(-500,500);
}
print("<br>Массив:<br>");
foreach ($A as $value){
	print($value." ");
}
$min = 5001;
for ($i=0;$i<$N;$i++){
	$result = 0;
	for ($j=0;$j<=$i;$j++){
		$result+=$A[$j];
	}
	for ($z=$i+1;$z<$N;$z++){
		$result-=$A[$z];
	}
	if ($min > abs($result)){
		$min = abs($result);
		$k=$i;
	}
}
print('<br><br>$k = '.$k.". Минимальная велечина = ".$min);
?>