<?php
$kol=0;
$tek=0;
$kol = $_GET["param1"];
$tek = $_GET["param2"];
$array = array("1.jpg","Некое событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "2.jpg","Некое событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "3.jpg","Некое событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "1.jpg","Некое событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "2.jpg","Некое событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "3.jpg","1 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "1.jpg","1 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "2.jpg","1 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "3.jpg","1 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "1.jpg","1 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "2.jpg","2 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "3.jpg","2 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "1.jpg","2 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "2.jpg","2 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "3.jpg","2 событие","123123123123123123123123123123123 123123123123123123123123123123123123123123123 12312312312312312312312312312312312312312312312312312312312312 31231231231231231231231231 231231231231231231 23123123123123123123123123123123123123123123123123123123123123123123123 123123123123123123123123123123123123123123123",
			   "1.jpg","1233","321");

$mass = array_slice($array,$tek*3,$kol*3);
echo json_encode($mass,JSON_UNESCAPED_UNICODE);
?>