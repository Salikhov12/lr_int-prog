<html>
<head> <title> Сведения об играх. Салихов Рашит </title> </head>
<body>
<?php
include("check_oper.php");
 session_start();
 $_SESSION['where']="index";
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
?>
<form method="post" action="<?php print $PHP_SELF ?>">
<div ><h2 style="display: inline;">Добавленные игры:</h2>
<input style="float:right;font-size:16px" name="add" type="submit" value="Выход">
<input style="float:right;font-size:16px" name="sett" type="submit" value="Управление">
</div>
<br>
<!--<p style="float:right;"><a  href="../index.php" onclick="func();"> Выход </a></p> -->
<?
if (isset($_POST["add"])) {
    session_destroy();
    header("Location: ../index.php");
}
if (isset($_POST["sett"])) {
    if ($_SESSION['type']==2){
    header("Location: adm_panel.php");
    }
    else{
     header("Location: user_panel.php");
    }
}
?>
</form>


<table border="1">
<tr> <!-- вывод «шапки» таблицы -->
 <th> Название </th> <th> Жанр </th> <th> Разработчик </th> <th> Издатель </th> <th> Объем продаж </th>
 <th> Редактировать </th>  
 <?php 
 if ($_SESSION['type']==2){
     echo "<th> Уничтожить </th>";
 }
 ?> </tr>
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
 if ($_SESSION['type']==2){
     echo "<td><a href='delete.php?id=" . $row['game_id']
. "&table=games&ni=game_'>Удалить</a></td>"; // запуск скрипта для удаления записи
 }
 echo "</tr>";
}
print "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего игр: $num_rows </p>");
?>
<p> <a href="new.php"> Добавить игру </a>

<h2>Добавленные магазины:</h2>
<table border="1">
<tr> <!-- вывод «шапки» таблицы -->
 <th> Название </th> <th> URL </th> 
 <th> Редактировать </th>
 <?php 
 if ($_SESSION['type']==2){
     echo "<th> Уничтожить </th>";
 }
 ?>
  </tr>
<?php
$result=mysqli_query($link,"SELECT *
FROM store"); // запрос на выборку сведений о магазинах
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row['store_name'] . "</td>";
 echo "<td>" . $row['url'] . "</td>";
 echo "<td><a href='edit_store.php?store_id=" . $row['store_id']
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования
if ($_SESSION['type']==2){
 echo "<td><a href='delete.php?id=" . $row['store_id']
. "&table=store&ni=store_'>Удалить</a></td>";} // запуск скрипта для удаления записи
 echo "</tr>";
}
print "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего магазинов: $num_rows </p>");
?>
<p> <a href="new_store.php"> Добавить магазин </a>

<h2>Доступные добавленные ключи:</h2>
<table border="1">
<tr> <!-- вывод «шапки» таблицы -->
 <th> Дата приобретения </th> <th> Дата окончания </th> <th> Игра </th>
 <th> Магазин </th><th> Стоимость </th><th> Ключ </th>
 <th> Редактировать </th>  
 <?php 
 if ($_SESSION['type']==2){
     echo "<th> Уничтожить </th>";
 }
 ?> </tr>
<?php
$result=mysqli_query($link,"SELECT `key_id`,`date_buy`,`date_exp`,`name`,
`store_name`,`price`,`game_key` FROM `keys`,`games`,`store` 
WHERE `keys`.`game_id`=games.game_id AND `keys`.store_id=store.store_id");
// запрос на выборку сведений о ключах
while ($row=mysqli_fetch_array($result)){// для каждой строки из запроса
 echo "<tr>";
 echo "<td>" . $row['date_buy'] . "</td>";
 echo "<td>" . $row['date_exp'] . "</td>";
 echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['store_name'] . "</td>";
 echo "<td>" . $row['price'] . "</td>";
 echo "<td>" . $row['game_key'] . "</td>";
 echo "<td><a href='edit_key.php?key_id=" . $row['key_id']
. "'>Редактировать</a></td>"; // запуск скрипта для редактирования

 if ($_SESSION['type']==2){
      echo "<td><a href='delete.php?id=" . $row['key_id']
. "&table=`keys`&ni=key_'>Удалить</a></td>"; // запуск скрипта для удаления записи
 }


 echo "</tr>";
}
print "</table>";
$num_rows = mysqli_num_rows($result); // число записей в таблице БД
print("<P>Всего ключей: $num_rows </p>");
?>
<p> <a href="new_key.php"> Добавить ключ </a><br>
<div style="float: left;margin-right: 15px;"><a href="gen_pdf.php"> Скачать PDF </a></div><div><a href="gen_xls.php"> Скачать XML </a></div><br>
<a href="../index.php"> Назад </a>
</body> </html>