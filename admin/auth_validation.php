<?php
if(isset($_GET['logSESS'])) {$logSESS = $_GET['logSESS'];unset($logSESS);}
if(isset($_POST['logSESS'])) {$logSESS = $_POST['logSESS'];unset($logSESS);}
  session_start();
  $logSESS = $_SESSION['$logSESS'];
  if(!isset($logSESS)&&$logSESS!="admin")
  {
    header("location: index.php");
    exit;  
  }
?>
