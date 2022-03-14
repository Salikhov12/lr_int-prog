<html>
<head>
<title> Редактирование данных о магазине </title>
</head>
<body>
<?php
include("check_oper.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $rows=mysqli_query($link,"SELECT store_name, url
 FROM store 
 WHERE store_id=".$_GET['store_id']);
 while ($st = mysqli_fetch_array($rows,MYSQLI_ASSOC)) {
 $store_id=$_GET['store_id'];
 $store_name = $st['store_name'];
 $url = $st['url'];
 }
print "<form action='save_edit.php' metod='get'>";
print "Название: <input name='store_name' size='50' type='text'
value='".$store_name."' required>";
print "<br>URL: <input name='url' size='50' type='text'
value='".$url."'>";
print "<input type='hidden' name='store_id' value='".$store_id."'> <br>";
print "<input type='submit' name='' value='Сохранить'><input type='hidden' name='type' value=store>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться к спискам </a>";
?>
</body>
</html>