<?php
  header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
if(isset($_POST['add_test2'])) {


  if (isset($_GET['count_qwestion'])&&!empty($_GET['count_qwestion'])&&isset($_GET['kod'])&&!empty($_GET['kod'])) {
    $kod=$_GET['kod'];
    $count_qwestion = $_GET['count_qwestion'];
    require_once $_SERVER['DOCUMENT_ROOT'] . "/db_config.php";

    $i = 0;
    while ($i < $count_qwestion) {
      $i = $i + 1;
      $question = $_POST['question'.$i];
      $answer1 =$_POST['answer1'.$i];
      $answer2 =$_POST['answer2'.$i];
      $answer3 =$_POST['answer3'.$i];
      $answer4 =$_POST['answer4'.$i];


     $result = mysql_query("INSERT INTO test(pid,question,answer1,answer2,answer3,answer4) VALUES('$kod','$question','$answer1','$answer2','$answer3','$answer4')") or die(mysql_error());
    }
	
	     if($result){
            header("location: tests.php");
            exit;
                    }
  }
}
else{
  header("location: tests.php");
  exit;
}
?>
