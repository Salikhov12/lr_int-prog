<html>
<head>
<title> Редактирование данных о пользователе </title>
</head>
<body>
<?php
include("check_oper.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect("localhost", "username","password") or die ("Невозможно
подключиться к серверу"); // установление соединения с сервером
 mysqli_query($link,'SET NAMES UTF8'); // тип кодировки
 // подключение к базе данных:
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 session_start();
 $getid = "a".$_GET['id'];
 $rows=mysqli_query($link,"SELECT * FROM users WHERE id='".$_SESSION[$getid]."';");
 $st = mysqli_fetch_array($rows,MYSQLI_ASSOC);
 $id=$st['id'];
 $username = $st['username'];
 $type = $st['type'];
 ?>
<form method='post' action='<?php print $PHP_SELF ?>'>
<?php
print "Логин: <input type='text' name='login' value='".$username."' required>";
print "<br>Пароль: <input type='password' name='pass' required>";
if ($_SESSION['type']==2){
print "<br>Тип: <input type='number' name='type' min=1 max=2 step=1 value='".$type."' required>";
}
print "<input type='hidden' name='id' value='".$id."'> <br>";
print "<input type='submit' name='add' value='Сохранить'>";
print "</form>";
if ($_SESSION['where']=="panel"){
    print "<p><a href='adm_panel.php'>Назад</a></p>";
}
if ($_SESSION['where']=="upanel"){
    print "<p><a href='user_panel.php'>Назад</a></p>";
}
?>
<?
if (isset($_POST["add"])) {
 $zapros="SELECT username FROM `users` WHERE username like '".$_POST['login']."' AND id not like '".$_POST['id']."'";
 $result=mysqli_query($link,$zapros);
 if (mysqli_affected_rows($link)==0){
     if ($_SESSION['type']==2){
    $zapros="UPDATE `users`
    set `username`='".$_POST['login']."',
    `password` = '".md5($_POST['pass'])."',
    `type` = ".$_POST['type']." 
    where id=".$id.";";
     }
     else{
    $zapros="UPDATE `users`
    set `username`='".$_POST['login']."',
    `password` = '".md5($_POST['pass'])."' 
    where id=".$id.";";
     }
    $result=mysqli_query($link,$zapros);
     if (mysqli_affected_rows($link)>=0){
        $_SESSION['success']=1;
        if ($_SESSION['where']=="upanel"){
            header("Location: user_panel.php");
        }
        else{
            header("Location: adm_panel.php");
        }
     }
 }
 else{ echo "Такой логин существует";}
}
?>
</body>
</html>