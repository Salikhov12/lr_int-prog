<html> <body>
<?php
 $link = mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_query($link,'SET NAMES UTF8');
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $zapros="UPDATE games SET name='".$_GET['name'].
"', genre='".$_GET['genre']."', developer='"
.$_GET['developer']."', publisher='".$_GET['publisher'].
"', sales='".$_GET['sales']."' WHERE game_id="
.$_GET['game_id'];
 mysqli_query($link,$zapros);
 if (mysqli_affected_rows($link)>0) {
 echo 'Все сохранено. <a href="index.php"> Вернуться к списку
игр </a>'; }
 else { echo 'Ошибка сохранения. <a href="index.php">
Вернуться к списку игр</a> '; }
?>
</body> </html>
