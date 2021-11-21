<head>
<title>Салихов Рашит</title>
</head>
<body>
<?php
$N = rand(2,100); #Единицу брать не будем
$M = rand(101,200);
$result = 0;
print('$N = '.$N.', $M = '.$M);
print("<br><br>Вариант 3.<br>");
for ($i=2;$i<$N;$i++){
	if ($N%$i==0){
		$result +=$i;
	}
}
print ("Характер: ".$result);
$result = 0;
print("<br><br>Вариант 6.<br>");
for ($i=$N;$i<=$M;$i++){
	$sqr = pow($i,(1.0/3)); #Корень числа третьей степени, для уменьшения количества переборов
	settype($sqr,int);
	for ($j=1;$j<=$sqr;$j++){
		for ($k=$j;$k<=$sqr;$k++){
			if ( (pow($j,3) + pow($k,3)) == $i){
				print($i." ");
			}
		}
	}
}
?>
</body>