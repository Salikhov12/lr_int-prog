<head>
<title>Салихов Рашит</title>
</head>
<?php
$cust['cnum'] = 2001;
$cust['cname'] = "Hoffman";
$cust['city'] = "London";
$cust['snum'] = 1001;
foreach($cust as $key => $value)
  {
     echo "$key = $value <br>";
  }
$cust['rating'] = 100;
print("<br>");
foreach($cust as $key => $value)
  {
     echo "$key = $value <br>";
  }
print("<br>");
asort($cust);
foreach($cust as $key => $value)
  {
     echo "$key = $value <br>";
  }
print("<br>");
ksort($cust);
foreach($cust as $key => $value)
  {
     echo "$key = $value <br>";
  }
 print("<br>");
sort($cust);
foreach($cust as $key => $value)
  {
     echo "$key = $value <br>";
  } 
?>