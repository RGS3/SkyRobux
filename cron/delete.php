<?php
$path = realpath(__DIR__."/../php/classes/DataBase.php");
require $path;

$DataBase = new DataBase();

$sql = "DELETE FROM `donate` WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(`date`) > 1209600";
$DataBase->query($sql,[]);