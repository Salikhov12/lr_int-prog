<?php
$conn_string = "host=ec2-54-228-32-29.eu-west-1.compute.amazonaws.com port=5432 dbname=d13vaqklogidto user=grwixcyucflxrt password=aa7c43bb2b037e1026b1b48599a535b047b394e1a2699c48a60686bc32bc3cdf options='--client_encoding=UTF8'";
$link = pg_connect($conn_string); //Подключение к БД

$query = 'SELECT * FROM messag'; //Создание запроса на получение всех записей из таблицы
$result = pg_query($link,$query) or die('Ошибка запроса: ' . pg_last_error());
$mass = array();
while ($row=pg_fetch_row($result)){ // Для каждой строки из запроса
	$mass = array_merge($mass,$row);
}

echo json_encode($mass,JSON_UNESCAPED_UNICODE);
?>