<head>
<title>Салихов Рашит</title>
</head>
Вариант 3.
<?php
function fv3($u,$t) {
	if ($u>0 && $t>0){
		return (pow($u,2)+pow($t,2));	
	}
	elseif ($u<=0 && $t<=0){
		return ($u+pow($t,2));
	}
	elseif ($u>0 && $t<=0){
		return ($u-$t);
	}
	else{
		return ($u+$t);
	}
}

function fv6($u,$t) {
	if ($u>=0 && $t>=0){
		return ($u+$t);	
	}
	elseif ($u<0 && $t>=0){
		return (pow($u,2)+$t);
	}
	elseif ($u>=0 && $t<0){
		return ($u-2*$t);
	}
	else{
		return (($t+3*$u)/($u*$t));
	}
}
$a = rand(-100,100);
$b = rand(-100,100);
print("<br>z = ".(fv3($a,$b)+fv3(pow($a,2),pow($b,2))-fv3($a-1,$b)));
print("<br><br>Вариант 6.<br>z = ".(fv6($a,pow($b,8)-pow($a,7))+fv6(pow($a,10)-pow($b,11),$b)));
?>