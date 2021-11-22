<?php
function fUsl3(){
	print("Вариант 3.<br>В матрице A(m,n) все ненулевые элементы заменить обратными по величине и
	противоположными по знаку. Исходный и скорректированный массивы вывести на
	экран.<br>");
}
function fUsl6(){
	print("Вариант 6.<br>Дана квадратная матрица порядка N. Для каждого столбца матрицы найти наименьший
	элемент. Вычислить и напечатать произведение найденных наименьших элементов.<br>");
}
function fZapAr($n,$m){
	for ($i=0;$i<$n;$i++){
		for ($j=0;$j<$m;$j++){
			$arr[$i][$j] = rand(-100,100);
		}
	}
	return $arr;
}
function fTab($arr,$n,$m){
	echo "<TABLE border=1>";
	for ($i=0; $i<$n; $i++) {
		echo ("<tr>");
		for ($k=0; $k<$m; $k++) {
			echo ("<td align=center>");
			echo ($arr[$i][$k]);
			echo ("</td>");
		}
		echo ("</tr>");
	}
	echo "</TABLE>";
}
function fObv3($arr,$n,$m){
	for ($i=0;$i<$n;$i++){
		for ($j=0;$j<$m;$j++){
			if ($arr[$i][$j]!=0){
				$arr[$i][$j] = round(0-(1/$arr[$i][$j]),3);
			}
		}
	}
	return $arr;
}
function fObv6(){
	
}
?>