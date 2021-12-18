<?php
session_start();
if (($_SESSION['type']!=2)&&($_SESSION['type']!=1)){
    header("Location: LogIn.php");
    exit;
}

?>
