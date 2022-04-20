<HEAD> <TITLE>Салихов Рашит </TITLE> </HEAD>
<body>
<FORM method="post" action="<?php print $PHP_SELF ?>">
<h2>Анкета</h2>
<p>Ваше имя:</p>
<Input type="text" name = "name" required>
<div>
<p>1. Считаете ли Вы, что у многих ваших знакомых хороший характер?<br>
Да<Input type="radio" name = "q1" checked>Нет
<Input type="radio" name = "q1" value="1"></div><div>
<p>2. Раздражают ли Вас мелкие повседневные обязанности?<br>
Да<Input type="radio" name = "q2" checked>Нет
<Input type="radio" name = "q2" value="1"></div><div>
<p>3. Верите ли Вы, что ваши друзья преданы Вам?<br>
Да<Input type="radio" name = "q3" checked value="1">Нет
<Input type="radio" name = "q3" ></div><div>
<p>4. Неприятно ли Вам, когда незнакомый человек делает Вам замечание?<br>
Да<Input type="radio" name = "q4" checked>Нет
<Input type="radio" name = "q4" value="1"></div><div>
<p>5. Способны ли Вы ударить собаку или кошку?<br>
Да<Input type="radio" name = "q5" checked>Нет
<Input type="radio" name = "q5" value="1"></div><div>
<p>6. Часто ли Вы принимаете лекарства?<br>
Да<Input type="radio" name = "q6" checked>Нет
<Input type="radio" name = "q6" value="1"></div><div>
<p>7. Часто ли Вы меняете магазин, в который ходите за продуктами? <br>
Да<Input type="radio" name = "q7" checked>Нет
<Input type="radio" name = "q7" value="1"></div><div>
<p>8. Продолжаете ли Вы отстаивать свою точку зрения, поняв, что ошиблись?<br>
Да<Input type="radio" name = "q8" checked>Нет
<Input type="radio" name = "q8" value="1"></div><div>
<p>9. Тяготят ли Вас общественные обязанности?<br>
Да<Input type="radio" name = "q9" checked value="1">Нет
<Input type="radio" name = "q9" ></div><div>
<p>10. Способны ли Вы ждать более 5 минут, не проявляя беспокойства?<br>
Да<Input type="radio" name = "q10" checked value="1">Нет
<Input type="radio" name = "q10" ></div><div>
<p>11. Часто ли Вам приходят в голову мысли о Вашей невезучести?<br>
Да<Input type="radio" name = "q11" checked>Нет
<Input type="radio" name = "q11" value="1"></div><div>
<p>12. Сохранилась ли у Вас фигура по сравнению с прошлым?<br>
Да<Input type="radio" name = "q12" checked>Нет
<Input type="radio" name = "q12" value="1"></div><div>
<p>13. Можете ли Вы с улыбкой воспринимать подтрунивание друзей?<br>
Да<Input type="radio" name = "q13" checked value="1">Нет
<Input type="radio" name = "q13" ></div><div>
<p>14. Нравится ли Вам семейная жизнь?<br>
Да<Input type="radio" name = "q14" checked value="1">Нет
<Input type="radio" name = "q14" ></div><div>
<p>15. Злопамятны ли Вы?<br>
Да<Input type="radio" name = "q15" checked>Нет
<Input type="radio" name = "q15" value="1"></div><div>
<p>16. Находите ли Вы, что стоит погода, типичная для данного времени года?<br>
Да<Input type="radio" name = "q16" checked>Нет
<Input type="radio" name = "q16" value="1"></div><div>
<p>17. Случается ли Вам с утра быть в плохом настроении?<br>
Да<Input type="radio" name = "q17" checked>Нет
<Input type="radio" name = "q17" value="1"></div><div>
<p>18. Раздражает ли Вас современная живопись?<br>
Да<Input type="radio" name = "q18" checked>Нет
<Input type="radio" name = "q18" value="1"></div><div>
<p>19. Надоедает ли Вам присутствие чужих детей в доме более одного часа?<br>
Да<Input type="radio" name = "q19" checked value="1">Нет
<Input type="radio" name = "q19" ></div><div>
<p>20. Надоедает ли Вам делать лабораторные по PHP?<br>
Да<Input type="radio" name = "q20" checked>Нет
<Input type="radio" name = "q20" value="1"></div>

<INPUT type="submit" name="obr" value="Отправить" >
</FORM>
</body>

<? 
if (isset($_POST["obr"])) {
	$a = 0;
	for ($i=1;$i<=20;$i++){
		if ($_POST["q".$i]==1){
			$a++;
		}
	}
	if ($a > 15) {echo $_POST["name"].". У Вас покладистый характер";}
	elseif ($a>=8) {echo $_POST["name"].". Вы не лишены недостатков, но с вами можно ладить";}
	else {echo $_POST["name"].". Вашим друзьям можно посочувствовать";}
}
?>