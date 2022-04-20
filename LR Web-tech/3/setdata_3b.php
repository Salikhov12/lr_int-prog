<?php
$conn_string = "host=ec2-63-32-248-14.eu-west-1.compute.amazonaws.com port=5432 dbname=d4g919fr15hiaf user=hldnnyytoneyba password=715cf9b0dcfd8629ae613b113a1ba08f88dc46e0c94d649f353382f652617489 options='--client_encoding=UTF8'";
$link = pg_connect($conn_string); //Подключение к БД

$mail = $_GET["mail"]; //Получение введенных данных
$mess = $_GET["mess"];
$name = $_GET["name"];

$query="insert into messag (name,mail,mess) 
values ('".$name."','".$mail."','".$mess."')"; //Создание запроса для БД

$result = array("Произошла ошибка."); //Сообщение об ошибке по умолчанию

$abc = pg_query($link,$query);
if (pg_affected_rows($abc)>0) 
{
	$result[0] = "Отзыв успешно создан!"; //При успешном выыполнении запроса результат меняется.
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>