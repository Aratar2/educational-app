<?php
header("Content-Type: text/html; charset=utf-8");
$response = array();
if(isset($_POST['token'])  && !empty($_POST['token'])) {
require_once $_SERVER['DOCUMENT_ROOT'] . "/db_config.php";
$token=$_POST['token'];
$resultToken = mysql_query("SELECT `token` FROM `users` WHERE `token`='$token'");

if(mysql_num_rows($resultToken) > 0) {

    $get_name_login_groups= mysql_query("SELECT `login`,`fullname`,`groups` FROM `users` WHERE `token`='$token' ");
    $row_get_name_login_groups=mysql_fetch_array($get_name_login_groups);
    $login=$row_get_name_login_groups['login'];
    $fullname=$row_get_name_login_groups['fullname'];
    $groups=$row_get_name_login_groups['groups'];


   if (isset($_POST['strResult']) && !empty($_POST['strResult'])) {
      $strResult = $_POST['strResult'];
      $resultTest=json_decode($strResult,true) or json_last_error();
      $kod = $resultTest[0]['kod'];
      $k = 0;


       for($i=0; $i<count($resultTest); $i++){
           $question = $resultTest[$i]['question'];
           $selectedAnswer = $resultTest[$i]['selectedAnswer'];
           $resultEquals = mysql_query("SELECT `answer1` FROM `test` WHERE `question`='$question' AND `pid`='$kod'");
           $row=mysql_fetch_array($resultEquals);
           $rightAnswer= $row['answer1'];

           if($selectedAnswer==$rightAnswer){
               $k=$k+1;
           }
      }
       date_default_timezone_set('Europe/Moscow');
       $created_at = date("Y-m-d H:i:s");
       $result_score =round(100/count($resultTest)*$k,2)."%"." (".$k." из ".count($resultTest).")";
       $resultSaveTest=mysql_query("INSERT INTO `tests_result`(kod_test,login, fullname,groups, result,str_result, created_at) VALUES ('$kod','$login','$fullname','$groups','$result_score','$strResult', '$created_at')");
       if($resultSaveTest==1){
           $response["success"] = 1;
           //echo "Successful";
       }
       else{
           $response["success"] = 0;
          // echo "Unsuccessful";
       }
       echo json_encode($response);
   }
   else{
       $response["success"] = 0;
      // echo "Error, empty result";
       echo json_encode($response);
   }
 }
  else{
    $response["success"] = 0;
   // echo "Error, incorrect token";
      echo json_encode($response);
  }

}
else{
    $response["success"] = 0;
    //echo "Error, empty token";
    echo json_encode($response);
}
?>