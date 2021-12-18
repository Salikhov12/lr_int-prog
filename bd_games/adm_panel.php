<?php include("check_type.php");
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 session_start();
  $_SESSION['where']="panel";
?>
<H2>Пользователи:</H2>
<table border="1">
<tr> <!-- вывод «шапки» таблицы -->
 <th> Имя </th> <th> Пароль </th> <th> Доступ </th>
 <th> Редактировать </th> <th> Уничтожить </th> </tr>
<?php
$result=mysqli_query($link,"SELECT * FROM users"); // запрос на выборку сведений о пользователях
$a=1;
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
$_SESSION["a".$a]=$row['id'];
 echo "<tr>";
 echo "<td>" . $row['username'] . "</td>";
 echo "<td>" . $row['password'] . "</td>";
 echo "<td>" . $row['type'] . "</td>";
 if ($row['username']!="admin"){
 echo "<td><a href='edit_user.php?id=" . $a
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
}
else{
    echo "<td></td>"; // запуск скрипта для удаления записи
}
if ($row['username']!="admin"){
 echo "<td><a href='delete.php?id=" . $row['id']
. "&table=users'>Удалить</a></td>"; // запуск скрипта для удаления записи
}
else{
    echo "<td></td>"; // запуск скрипта для удаления записи
}
 echo "</tr>";
 $a++;
}
print "</table>";
if ($_SESSION['success']==1){
   print "<br>Изменено успешно";
   unset($_SESSION['success']);
}

$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего пользователей: $num_rows </p>");
?>
<p><a href="new_user.php">Создание нового пользователя</a></p>
<p><a href="index.php">Назад</a></p>

