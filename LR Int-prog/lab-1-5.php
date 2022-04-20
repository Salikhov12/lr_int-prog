<head>
<title>Салихов Рашит</title>
</head>
<?php
$a = rand(-20,20);
$b = rand(-20,20);
$c = rand(-20,20);
$d = rand(-20,20);
print("a =".$a.", b =".$b.", c =".$c.", d =".$d);
?>
<br>
<br>
Вариант 4.
<br>
<?php
$result = ($c+4*$d-12)/(1-($a/2));
print("(".$c."+4*".$d."-12)/(1-(".$a."/2)) = ".$result);
?>
<br>
<br>
Вариант 8.
<br>
<?php
$result = ($b*2*$c+$d-52)/($a/3+1);
print("(".$b."*2*".$c."+".$d."-52/(".$a."/3+1) = ".$result);
?>