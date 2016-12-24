<?php
   if(
   isset($_POST['login']) && 
   isset($_POST['pass']) && 
   isset($_POST['email'])&& 
   isset($_POST['invite'])&& 
   isset($_POST['fullname']) && 
   isset($_POST['group']) && 
   !empty($_POST['login']) &&
   !empty($_POST['pass']) && 
   !empty($_POST['email'])&& 
   !empty($_POST['invite']) && 
   !empty($_POST['fullname']) &&
   !empty($_POST['group'])
   ){ 
   
   
   $login=$_POST['login'];
   $pass=$_POST['pass'];
   $pass=md5($pass);
   $fullname=$_POST['fullname'];
   $group=$_POST['group'];
   $email=$_POST['email'];
   $invite=$_POST['invite'];

$response = array();
require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";




$resultInvite = mysql_query("SELECT `invite` FROM `invitebd` WHERE `invite`='$invite'");
    if(mysql_num_rows($resultInvite) > 0) {

$resultLog = mysql_query("SELECT `login` FROM `users` WHERE `login`='$login'");
   if(mysql_num_rows($resultLog) > 0) {
            $response["success"] = 3; 
			
   } 
   else{  


$queryAuto_increment  = mysql_query("SHOW TABLE STATUS LIKE 'users'") or die (mysql_error);
$id = mysql_result($queryAuto_increment, 0, 'Auto_increment');
$token=md5(base64_encode(md5($pass.$id)));
$result = mysql_query("INSERT INTO users(login,pass,email,token,fullname,groups) VALUES('$login','$pass','$email','$token','$fullname','$group')");

         
            if($result){
            $response["success"] = 1;
            }
             else{
			 echo $group;
            $response["success"] = 0;
            }
      }
                                           }
   else{
         $response["success"] = 4; 			
       }
echo json_encode($response);



}
else{
$response["success"] = 0;
echo json_encode($response);
}
?>