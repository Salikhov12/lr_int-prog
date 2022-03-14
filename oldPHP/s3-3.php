<HEAD> <TITLE>Салихов Рашит </TITLE> </HEAD>
<body>Нечетный вариант.<br><br>
<FORM method="post" action="<?php print $PHP_SELF ?>">
 <INPUT type="number" name="a" required> <br> <br>
 <SELECT NAME="z" SIZE="1">
 <OPTION VALUE="1" SELECTED> четные
 <OPTION VALUE="2"> нечетные
 <OPTION VALUE="3"> простые
 <OPTION VALUE="4"> составные 
 </SELECT> <br>
  <P> <INPUT type="submit" name="obr" value="Вывести" >  <br>
</FORM></body>
<?if (isset($_POST["obr"])) {
	switch($_POST['z']){
	 case 1:{
		 chet($_POST['a']); break;
	 }
	 case 2:{
		 nechet($_POST['a']); break;
	 } 
	 case 3:{
		 prost($_POST['a']); break;
	 }
	 case 4:{
		 sost($_POST['a']);
	 }
	}
}
function chet($n){
	for ($i=2;$i<=$n;$i++){
		if ($i%2==0) { echo ($i." ");}
	}
}
function nechet($n){
	for ($i=2;$i<=$n;$i++){
		if ($i%2==1) { echo ($i." ");}
	}
}
function prost($n){
	for ($i=2;$i<=$n;$i++){
		for ($j=2;$j<=$i;$j++){
			if (($i%$j==0)&&($i<>$j)){
				break;
			}
			elseif (($i==$j)&&($i%$j==0)){
				echo ($i." ");
			}
		}
	}
}
function sost($n){
	for ($i=2;$i<=$n;$i++){
		for ($j=2;$j<=$i;$j++){
			if (($i%$j==0)&&($i<>$j)){
				echo ($i." ");
				break;
			}
		}
	}
}?>