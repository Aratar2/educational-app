<?php
   if(isset($_POST['login']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['pass'])) { 
   $login=$_POST['login'];
   $pass=$_POST['pass'];
   $pass=md5($pass);

$response = array();
require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";



$result = mysql_query("SELECT * FROM `users` WHERE `login`='$login'");
$row = mysql_fetch_array($result);
$passBd=$row["pass"];
if($pass==$passBd){
$response["success"] = 1;
$response["token"] = $row["token"];
}
else{
$response["success"] = 0;
}
echo json_encode($response);
}
else{
$response["success"] = 0;
echo json_encode($response);
}
?>