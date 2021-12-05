<?php
 // Подключение к базе данных:
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 // Строка запроса на добавление записи в таблицу:
 $sql_add = "INSERT INTO games SET name='" . $_GET['name']
."', genre='".$_GET['genre']."', developer='"
.$_GET['developer']."', publisher='".$_GET['publisher'].
"', sales='".$_GET['sales']. "'";
 mysqli_query($link,$sql_add); // Выполнение запроса
 if (mysqli_affected_rows($link)>0) // если нет ошибок при выполнении запроса
 { print "<p>Спасибо, вы зарегистрировали игру в базе данных.";
 print "<p><a href=\"index.php\"> Вернуться к списку
игр </a>"; }
 else { print "Ошибка сохранения. <a href=\"index.php\">
Вернуться к списку игр </a>"; }
?>
