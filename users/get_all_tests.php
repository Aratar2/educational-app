<?php
  header("Content-Type: text/html; charset=utf-8");


  
 if(isset($_GET["access_token"])){
   
   $token=$_GET["access_token"];

   require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";
	


$resultToken = mysql_query("SELECT `token` FROM `users` WHERE `token`='$token'");	
    if(mysql_num_rows($resultToken) > 0) {
             
	   $response = array();
       $result = mysql_query("SELECT *FROM tests_general") or die(mysql_error());
 

     while ($row = mysql_fetch_array($result)) {
          $info = array();
          $info["pid"] = $row["pid"];
		  $info["name"] = $row["name"];
		  $info["count_qwestion"] = $row["count_qwestion"];
		  $info["created_at"] = $row["created_at"];
          array_push($response, $info);
    }
 
    echo json_encode(array('tests' =>$response));
			
   } 
   else{ 
   
   echo "Access denied, incorrect access token";

   }
  
}
 else{ 
   
 echo "Access denied, access token not found";

 }
?>