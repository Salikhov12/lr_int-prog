<head>
<title>Салихов Рашит</title>
</head>
<BODY>
<TABLE border=1>
<?php
for ($i=1; $i<=10; $i++) {
 echo ("<tr>");
 for ($k=1; $k<=10; $k++) {
 $p=($i-1)*10+$k;
 if ($p%2==0){
  echo ("<td align=center style=\"color:red\">");
 }
 else{
  echo ("<td align=center style=\"color:black\">");
 }
 echo ($p);
 echo ("</td>");
 }
 echo ("</tr>");
}
?>
</TABLE>
</BODY>