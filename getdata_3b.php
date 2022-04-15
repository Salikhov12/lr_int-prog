<?php
$conn_string = "host=ec2-63-32-248-14.eu-west-1.compute.amazonaws.com port=5432 dbname=d4g919fr15hiaf user=hldnnyytoneyba password=715cf9b0dcfd8629ae613b113a1ba08f88dc46e0c94d649f353382f652617489 options='--client_encoding=UTF8'";
$link = pg_connect($conn_string); //Подключение к БД

$query = 'SELECT * FROM messag'; //Создание запроса на получение всех записей из таблицы
$result = pg_query($link,$query) or die('Ошибка запроса: ' . pg_last_error());
while ($row=pg_fetch_row($result)){ // Для каждой строки из запроса
	$mass = array_merge($mass,$row);
}

echo json_encode($mass,JSON_UNESCAPED_UNICODE);
?>