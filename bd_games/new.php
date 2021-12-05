<html>
<head> <title> Добавление новой игры </title> </head>
<body>
<H2>Добавление на сайт:</H2>
<form action="save_new.php" metod="get">
 Название: <input name="name" size="50" type="text" required>
<br>Жанр: <input name="genre" size="50" type="text">
<br>Разработчик: <input name="developer" size="30" type="text" required>
<br>Издатель: <input name="publisher" size="30" type="text" required>
<br>Объем продаж: <input name="sales" type="number" >
<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
<input type='hidden' name='type' value=игру>
</form>
<p>
<a href="index.php"> Вернуться к списку игр </a>
</body>
</html>