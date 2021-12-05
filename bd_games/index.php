<html>
<head> <title> Сведения об играх </title> </head>
<body>
<?php
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
?>
<h2>Добавленные игры:</h2>
<table border="1">
<tr> <!-- вывод «шапки» таблицы -->
 <th> Название </th> <th> Жанр </th> <th> Разработчик </th> <th> Издатель </th> <th> Объем продаж </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($link,"SELECT *
FROM games"); // запрос на выборку сведений о пользователях
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['genre'] . "</td>";
 echo "<td>" . $row['developer'] . "</td>";
 echo "<td>" . $row['publisher'] . "</td>";
 echo "<td>" . $row['sales'] . "</td>";
 echo "<td><a href='edit.php?game_id=" . $row['game_id']
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
 echo "<td><a href='delete.php?game_id=" . $row['game_id']
. "'>Удалить</a></td>"; // запуск скрипта для удаления записи
 echo "</tr>";
}
print "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего игр: $num_rows </p>");
?>
<p> <a href="new.php"> Добавить игру </a>
</body> </html>