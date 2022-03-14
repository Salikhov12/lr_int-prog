<HEAD> <TITLE>Салихов Рашит </TITLE> </HEAD>
<body>
<FORM method="post" action="<?php print $PHP_SELF ?>">
Логин:<br>
<Input type="text" name = "login" required> <br><br>
<INPUT type="submit" name="obr" value="Вывести" >
</FORM>
</body>

<? 
if (isset($_POST["obr"])) {
	switch ($_POST["login"]){
		case "admin":
			{echo "Здравствуйте, Администратор";
		break;}
		case "user":{
			echo "Здравствуйте, Пользователь";
		break;}
		case "login":{
			echo "Здравствуйте, Пользователь2";
		break;}
		case "Salikhov_php":{
			echo "Здравствуйте, Салихов Рашит";
			break;
		}
		default: {echo "Вы не зарегистрированный пользователь!";}
	}
}
?>
