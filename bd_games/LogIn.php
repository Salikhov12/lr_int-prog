<style>
   .blok-center {
    width: 500px; /* Ширина блока */
    height: auto; /* Высота блока */
    margin: auto; /* Отступ от блока */
    text-align: center;
    padding: 10px; /* Отступ внутри блока */
   }

   .combo{
   font-size : 12pt;
   }
</style>
<body>
<div class="blok-center">
<h1 class="text">Авторизация</h1>
<form method="post" action="<?php print $PHP_SELF ?>">
<input type='hidden' name='page' id='LogIn' value='LogIn'/>
<input type='hidden' name='fio' id='fio' value=''/>
<br>
<?php
echo ("<input type='text' placeholder='Логин' class='combo' name='login' id='login' value='".$log."' required title='Введите ваш логин'><br><br>
<input  class='combo' placeholder='Пароль' type='password' name='pass' id='pass' value='".$pass."' required  title='Введите ваш пароль'><br>");
?>
<br><input  class='combo' type='submit' name='sign' value='Вход'></br>
</form>
</div>
2 - admin admin <br>
1 - user user
</body>
<?
if (isset($_POST["sign"])) {
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $link=mysqli_connect("localhost","username","password") or die ("Невозможно
подключиться к серверу");
 mysqli_select_db($link,"db_name") or die("Нет такой таблицы!");
 $zapros="SELECT type,id FROM `users` WHERE username = '".$_POST['login']."' and `password` = '" . md5($_POST['pass'])."'";
 $result=mysqli_query($link,$zapros);
 if (mysqli_affected_rows($link)>0) // если нет ошибок при выполнении запроса
 {
 $row=mysqli_fetch_array($result);
 session_start();
 $_SESSION['type'] = $row['type'];
 $_SESSION['userid'] = $row['id'];
 header("Location: index.php");
 exit;
 }
 else { print "<p style='text-align:center'>Неверный логин/пароль.</p>";}
 }
?>
