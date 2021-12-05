<html>
<head> <title> Добавление нового ключа </title> </head>
<body>
<?php
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
?>
<H2>Добавление на сайт:</H2>
<form action="save_new.php" metod="get">	
 Дата приобретения: 
 <?php
echo "<input type='date' name='date_buy' max='" . date("Y-m-d") . "' required>";
?>
 <!--<input name="date_buy" type="date" required>-->
<br>Дата окончания: 
<?php
echo "<input type='date' name='date_exp' min='" . date("Y-m-d") . "' required>";
?>
<!--<input name="date_exp" type="date" required>-->
<br>ID игры:
<?php 
$sql = "SELECT game_id,name FROM games";
$result_select = mysqli_query($link,$sql);
echo "<select name = 'game_id'>";
while($object = mysqli_fetch_array($result_select,MYSQLI_ASSOC)){
echo "<option value = '".$object['game_id']."' >". $object['name'] ."</option>";
}
echo "</select>";
?>
<br>ID магазина:
<?php 
$sql = "SELECT store_id,store_name FROM store";
$result_select = mysqli_query($link,$sql);
echo "<select name = 'store_id'>";
while($object = mysqli_fetch_array($result_select,MYSQLI_ASSOC)){
echo "<option value = '".$object['store_id']."' >". $object['store_name'] ."</option>";
}
echo "</select>";
?>
<br>Стоимость: <input name="price" type="number" required>
<br>Ключ: <input name="game_key" type="text" required>
<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
<input type='hidden' name='type' value=ключ>
</form>
<p>
<a href="index.php"> Вернуться к списку игр </a>
</body>
</html>