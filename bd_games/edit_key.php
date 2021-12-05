<html>
<head>
<title> Редактирование данных о ключе </title>
</head>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $rows=mysqli_query($link,"SELECT date_buy, date_exp, game_id, store_id, price, game_key
 FROM `keys`
 WHERE key_id=".$_GET['key_id']);
 while ($st = mysqli_fetch_array($rows,MYSQLI_ASSOC)) {
 $key_id=$_GET['key_id'];
 $date_buy = $st['date_buy'];
 $date_exp = $st['date_exp'];
 $game_id = $st['game_id'];
 $store_id = $st['store_id'];
 $price = $st['price'];
 $game_key = $st['game_key'];
 }
print "<form action='save_edit.php' metod='get'>";
print "Дата приобретения: <input type='date' name='date_buy' max='" . date("Y-m-d") . "'
value='".$date_buy."' required>";

print "<br>Дата окончания: <input type='date' name='date_exp' min='" . date("Y-m-d") . "' required
value='".$date_exp."'>";
$sql = "SELECT game_id,name FROM games";
$result_select = mysqli_query($link,$sql);
echo "<br>Название игры:<select name = 'game_id'>";
while($object = mysqli_fetch_array($result_select,MYSQLI_ASSOC)){
echo "<option value = '".$object['game_id']."' >". $object['name'] ."</option>";
}
echo "</select>";
$sql = "SELECT store_id,store_name FROM store";
$result_select = mysqli_query($link,$sql);
echo "<br>Название магазина<select name = 'store_id'>";
while($object = mysqli_fetch_array($result_select,MYSQLI_ASSOC)){
echo "<option value = '".$object['store_id']."' >". $object['store_name'] ."</option>";
}
echo "</select>";
print "<br>Стоимость: <input name='price' type='number' required value='".$price."'>";
print "<br>Ключ: <input name='game_key' type='text' required value='".$game_key."'>";
print "<input type='hidden' name='key_id' value='".$key_id."'> <br>";
print "<input type='submit' name='' value='Сохранить'><input type='hidden' name='type' value=`key`>";
print "</form>";
print "<p><a href=\"index.php\"> Вернуться к спискам </a>";
?>
</body>
</html>