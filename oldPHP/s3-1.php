<HEAD> <TITLE>Салихов Рашит</TITLE> </HEAD>
<?
if (isset($_POST["obr"])) {
if ($_POST["f"]==$_POST["s"]) { echo("Числа равны");
 } else {
 if ($_POST["f"]>$_POST["s"]) {
 echo("Число ".$_POST["f"]." - больше");
 } else { echo("Число ".$_POST["s"]." - больше"); }
 } }
 echo "<br><BR> <A href='s3-1.html'> Вернуться назад </A>";
?>