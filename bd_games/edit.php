<html>
<head>
<title> Редактирование данных об игре </title>
</head>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $rows=mysqli_query($link,"SELECT name, genre,developer, publisher, sales 
 FROM games 
 WHERE game_id=".$_GET['game_id']);
 while ($st = mysqli_fetch_array($rows,MYSQLI_ASSOC)) {
 $game_id=$_GET['game_id'];
 $name = $st['name'];
 $genre = $st['genre'];
 $developer = $st['developer'];
 $publisher = $st['publisher'];
 $sales = $st['sales'];
 }
print "<form action='save_edit.php' metod='get'>";
print "Название: <input name='name' size='50' type='text'
value='".$name."' required>";
print "<br>Жанр: <input name='genre' size='50' type='text'
value='".$genre."'>";
print "<br>Разработчик: <input name='developer' size='30' type='text'
value='".$developer."' required>";
print "<br>Издатель: <input name='publisher' size='30' type='text'
value='".$publisher."' required>";
print "<br>Объем продаж: <input name='sales' value='".$sales."' type='number'>";
print "<input type='hidden' name='game_id' value='".$game_id."'> <br>";
print "<input type='submit' name='' value='Сохранить'><input type='hidden' name='type' value=game>";

print "</form>";
print "<p><a href=\"index.php\"> Вернуться к спискам </a>";
?>
</body>
</html>