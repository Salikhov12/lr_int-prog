<head>
<title>Салихов Рашит</title>
</head>
<?php
$treug[10];
print("\"Треугольные\" числа<br>");
for ($i=1;$i<11;$i++){
	$treug[$i] = $i*($i+1)/2;
	print($treug[$i]." ");
}
$kvd[10];
print("<br><br>Квадраты натуральных чисел<br>");
for ($i=1;$i<11;$i++){
	$kvd[$i]=pow($i,2);
	print($kvd[$i]." ");
}
$rez = array_merge($treug,$kvd);
print("<br><br>Объединенные массивы<br>");
foreach ($rez as $value){
	print($value." ");
}
print("<br><br>Отсортированный массив<br>");
sort($rez);
foreach ($rez as $value){
	print($value." ");
}
print("<br><br>Массив с удаленным первым элементом<br>");
unset($rez[0]);
foreach ($rez as $value){
	print($value." ");
}
print("<br><br>Массив с удаленными повторяющимися элементами<br>");
$rez1 = array_unique($rez);
foreach ($rez1 as $value){
	print($value." ");
}
?>