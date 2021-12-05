<?php
 // Подключение к базе данных:
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 // Строка запроса на добавление записи в таблицу:
 switch ($_GET['type']){
  case 'игру':{
 $sql_add = "INSERT INTO games SET name='" . $_GET['name']
."', genre='".$_GET['genre']."', developer='"
.$_GET['developer']."', publisher='".$_GET['publisher'].
"', sales='".$_GET['sales']. "'"; break;
}
  case 'магазин':{
       $sql_add = "INSERT INTO store SET store_name='" . $_GET['store_name']
."', url='".$_GET['url']."'"; break;
  }
  case 'ключ':{
      $sql_add = "INSERT INTO `keys` (`date_buy`, `date_exp`, `game_id`, `store_id`, `price`, `game_key`)
      VALUES ('".$_GET['date_buy']."',
      '".$_GET['date_exp']."',
      '".$_GET['game_id']."',
      '".$_GET['store_id']."',
      '".$_GET['price']."',
      '".$_GET['game_key']."')";
      break;
  }
     
 }
 mysqli_query($link,$sql_add); // Выполнение запроса
 if (mysqli_affected_rows($link)>0) // если нет ошибок при выполнении запроса
 { print "<p>Спасибо, вы зарегистрировали ".$_GET['type']." в базе данных.";
 print "<p><a href=\"index.php\"> Вернуться к спискам </a>"; }
 else { print "Ошибка сохранения. <a href=\"index.php\">
Вернуться к спискам </a>"; }
?>
