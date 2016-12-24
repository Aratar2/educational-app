<?php
 //header("Content-Type: text/html; charset=utf-8");

  
$hostname = "localhost"; 
$username = "aratar"; 
$password = "364332"; 
$dbName = "test"; 

$con=mysql_connect($hostname,$username,$password);
$db=mysql_select_db($dbName) or die(mysql_error()); 
mysql_query('SET NAMES utf8');
mysql_set_charset('utf8_general_ci');
?>