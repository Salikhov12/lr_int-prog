<?php
 $link=mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $zapros="DELETE FROM games WHERE game_id=" . $_GET['game_id'];
 mysqli_query($link,$zapros);
 header("Location: index.php");
 exit;
?>