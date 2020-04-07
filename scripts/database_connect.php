<?php

$host       = 'localhost';
$dbuser     = 'root';
$dbpassword = '';
$dbname     = 'agency_db';

$connect = mysqli_connect($host, $dbuser, $dbpassword, $dbname) or die('Ошибка подключения: ' . mysqli_error());

mysqli_query($connect, "SET NAMES 'utf8'");
