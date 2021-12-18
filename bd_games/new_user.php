<html>
<head> <title> Добавление нового пользователя </title> </head>
<body>
    <?php 
    include("check_type.php");
    ?>
<H2>Добавление пользователя:</H2>
<form method="post" action="<?php print $PHP_SELF ?>">
 Имя: <input name="login" size="50" type="text" required>
<br>Пароль: <input name="pass" size="50" type="text" required>
<br>Доступ: <input name="type" size="1" type="number" max=2 step="1" min=1 title="1-Оператор, 2-Администратор" required>
<p><input name="add" type="submit" value="Добавить">
<input name="b2" type="reset" value="Очистить"></p>
</form>
<?
if (isset($_POST["add"])) {
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $link=mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $zapros="SELECT username FROM `users` WHERE username like '".$_POST['login']."'";
 $result=mysqli_query($link,$zapros);
 if (mysqli_affected_rows($link)==0){
    $zapros="INSERT INTO users (username, password, type) VALUES ('".
    $_POST['login']."','".md5($_POST['pass'])."',".$_POST['type'].");";
    $result=mysqli_query($link,$zapros);
     if (mysqli_affected_rows($link)>=0)
        echo "Аккаунт добавлен";
 }
 else{ echo "Такой логин существует";}
}
?>
<p>
<a href="adm_panel.php"> Назад </a>
</body>
</html>
