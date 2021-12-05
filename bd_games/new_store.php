<html>
<head> <title> Добавление нового магазина </title> </head>
<body>
<H2>Добавление на сайт:</H2>
<form action="save_new.php" metod="get">
 Название: <input name="store_name" size="50" type="text" required>
<br>URL: <textarea name="url" size="50" type="text"></textarea>

<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
<input type='hidden' name='type' value=магазин>
</form>
<p>
<a href="index.php"> Вернуться к спискам </a>
</body>
</html>