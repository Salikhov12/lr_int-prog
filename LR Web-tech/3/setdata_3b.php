<?php
$conn_string = "host=ec2-54-228-32-29.eu-west-1.compute.amazonaws.com port=5432 dbname=d13vaqklogidto user=grwixcyucflxrt password=aa7c43bb2b037e1026b1b48599a535b047b394e1a2699c48a60686bc32bc3cdf options='--client_encoding=UTF8'";
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