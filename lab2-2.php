<head>
<title>Салихов Рашит</title>
</head>
<?php
$rand = rand(3,20);
for ($i=0;$i<$rand;$i++){
	$rand_ar[$i] = rand(10,99);
}
print("Массив из ".$rand." элементов, заполненный случайными числами:<br>");
foreach ($rand_ar as $value){
	print($value." ");
}
print("<br><br>Отсортированный массив<br>");
sort($rand_ar);
foreach ($rand_ar as $value){
	print($value." ");
}

print("<br><br>Элементы массива в обратном порядке<br>");
$rand_ar = array_reverse($rand_ar);
foreach ($rand_ar as $value){
	print($value." ");
}
print("<br><br>Массив с удаленным последним элементом<br>");
array_pop($rand_ar);
foreach ($rand_ar as $value){
	print($value." ");
}
print("<br><br>");
foreach ($rand_ar as $value){
	$sum+=$value;
}
print("Сумма: ".$sum." Количество элементов: ".count($rand_ar));
print("<br>Среднее арифметическое: ".$sum/count($rand_ar));
print("<br><br>Есть 50? ");
if (in_array("50",$rand_ar)){
	print("Да");
}
else{
	print("Нет");
}
print("<br><br>Массив с удаленными повторяющимися элементами<br>");
$rand_ar = array_unique($rand_ar);
foreach ($rand_ar as $value){
	print($value." ");
}
?>