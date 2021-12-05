<html> <body>
<?php
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $link = mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_query($link,'SET NAMES UTF8');
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 
 switch($_GET['type']){
   case 'game':  {
 $zapros="UPDATE games SET name='".$_GET['name'].
"', genre='".$_GET['genre']."', developer='"
.$_GET['developer']."', publisher='".$_GET['publisher'].
"', sales='".$_GET['sales']."' WHERE game_id="
.$_GET['game_id']; break;}
    case 'store': {
         $zapros="UPDATE store SET store_name='".$_GET['store_name'].
"', url='".$_GET['url']."' WHERE store_id=".$_GET['store_id'];
        break;
    }
    case '`key`': {
        $zapros="UPDATE `keys` SET date_buy='".$_GET['date_buy']."',
        date_exp='".$_GET['date_exp']."', game_id='".$_GET['game_id']."', 
store_id='".$_GET['store_id']."', price='".$_GET['price']."',
game_key='".$_GET['game_key']."'
WHERE key_id=".$_GET['key_id'];
        break;
    }
}
 mysqli_query($link,$zapros);
 if (mysqli_affected_rows($link)>0) {
 echo 'Все сохранено. <a href="index.php"> Вернуться к списку
игр </a>'; }
 else { echo 'Ошибка сохранения. <a href="index.php">
Вернуться к списку игр</a> '; }
?>
</body> </html>
