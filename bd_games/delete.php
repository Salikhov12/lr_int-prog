<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $link=mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $zapros="DELETE FROM ".$_GET['table']." WHERE ".$_GET['ni']."id=" . $_GET['id'];
 mysqli_query($link,$zapros);
 header("Location: index.php");
 exit;
?>