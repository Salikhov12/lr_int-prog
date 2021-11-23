<HTML>
<HEAD> <TITLE>Салихов Рашит </TITLE> </HEAD>
<BODY>
<FORM method="post" action="<?php print $PHP_SELF ?>">
 Калькулятор:
 <INPUT type="number" name="a" required>
 <INPUT type="number" name="b"  required>
 <p>
 <SELECT NAME="z" SIZE="1">
 <OPTION VALUE="1" SELECTED> сложить
 <OPTION VALUE="2"> вычесть
 <OPTION VALUE="3"> умножить
 <OPTION VALUE="4"> разделить 
 </SELECT>
 <P> <INPUT type="submit" name="obr" value="Посчитать">
</FORM>
<?
if (isset($_POST["obr"])) {
	switch($_POST['z']){
	 case 1:{
		 echo ($_POST['a']." + ".$_POST['b']." = ".($_POST['a']+$_POST['b'])); break;
	 }
	 case 2:{
		 echo ($_POST['a']." - ".$_POST['b']." = ".($_POST['a']-$_POST['b'])); break;
	 }
	 case 3:{
		 echo ($_POST['a']." * ".$_POST['b']." = ".($_POST['a']*$_POST['b'])); break;
	 }
	 case 4:{
		 if ($_POST['b']!=0){
		 echo ($_POST['a']." / ".$_POST['b']." = ".($_POST['a']/$_POST['b'])); break;}
		 else {echo "Деление на ноль."; break;}
	 }
	}
 }
?>
</BODY> </HTML>