<html>
<head> <title> Салихов Рашит </title> </head>
<body>
<?php
$conn_string = "host=ec2-63-32-248-14.eu-west-1.compute.amazonaws.com port=5432 dbname=d4g919fr15hiaf user=hldnnyytoneyba password=715cf9b0dcfd8629ae613b113a1ba08f88dc46e0c94d649f353382f652617489 options='--client_encoding=UTF8'";
$link = pg_connect($conn_string);

 $query = 'SELECT * FROM messag';
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
while ($row=pg_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row['id'] . "</td>";
 echo "<td>" . $row['mail'] . "</td>";
 echo "<td>" . $row['mess'] . "</td>";
 echo "<td>" . $row['name'] . "</td>";
  echo "</tr>";
}

?>

</body> </html>