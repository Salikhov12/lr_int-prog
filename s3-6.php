<HEAD> <TITLE>Салихов Рашит </TITLE> </HEAD>
<?
$s1 = $_POST["vr9"];
$s2_1 = $_POST["vr14-1"];
$s2_2 = $_POST["vr14-2"];
$s3 = $_POST["vr19"];
vr9($s1);
vr14($s2_1,$s2_2);
vr19($s3);

function vr9($s){
	$kol = substr_count($s,"?");
	$kol+= substr_count($s,"!");
	$kol+= substr_count($s,"...");
	$s = str_replace("...","",$s);
	$kol+= substr_count($s,".");
	echo ("Вариант 9<br><br>Число предложений: ".$kol."<br><br>");
}
function vr14($s1,$s2){
	echo ("Вариант 14<br><br>");
	$pos = strpos($s1,$s2,0);
	$count = 0;
	if ($pos===false){
		echo $s2." не был найден в тексте.";
	}
	else{
		echo ("Позиции вхождения символа: ");
		while($pos!==false){
			$count++;
			echo (" ".$pos);
			$pos = strpos($s1,$s2,$pos+1);
		}
		echo ("<br><br>Число повторений: ".$count);
	}
}
function vr19($s){
	echo ("<br><br>Вариант 19<br><br>");
	$v=0;
	$n=0;
	for ($i=0;$i<strlen($s);$i++){
		if (ctype_upper($s{$i})){
			$v++;
		}
		if (ctype_lower($s{$i})){
			$n++;
		}
	}
	echo ("Строчный букв:".round(($n/strlen($s)*100),1)."%");
	echo ("<br>Прописных букв:".round(($v/strlen($s)*100),1)."%");
}
?>