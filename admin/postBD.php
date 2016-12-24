<?php

        header("Content-Type: text/html; charset=utf-8");

require_once "auth_validation.php";


$msg=$_POST['message'];
//echo $msg=$msg);

$name=$_POST['name'];
$adrees=translitAdrees($name);
$dir="pages/";
require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";


$con=mysql_connect($hostname,$username,$password);
$db=mysql_select_db($dbName) or die(mysql_error()); 
mysql_query('SET NAMES utf8');
$adreesUpd=$_SERVER['HTTP_ORIGIN']."/".$dir.$adrees;

mysql_set_charset('utf8_general_ci');
$msg_encode = base64_encode($msg);
date_default_timezone_set('Europe/Moscow');
$created_at = date("Y-m-d H:i:s");
$result = mysql_query("INSERT INTO informBD(name,adrees,description,adreesName,	created_at) VALUES('$name','$adreesUpd.html','$msg_encode','$adrees','$created_at')");

$file = $_SERVER['DOCUMENT_ROOT']."/".$dir.$adrees.".html";
$content = "
<html>
<head>
<title>$name</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />


  <style>
#header{
    word-wrap:break-word;
    }
	.name{
  font-size: 20px;
  font-weight: bold;
  display: block;
  text-align:center;
  }
	
	</style>
	
</head>
<body>
<div id=\"header\" class=\"col-md-12\">



<span class=\"name\">$name</span>


$msg
</div>

</body>
</html>


";
$fp = fopen($file, "w");
fwrite($fp, $content);
fclose($fp);

header("location: all_theory.php");
    exit; 


function translitAdrees($stroka) 
{
    $arrayStr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", " " => "_",
		 '\''=>'', '"'=>'', '\t'=>'', '«'=>'', '»'=>'', '?'=>'', '!'=>'', '*'=>'', '.'=>''
    );
    return strtr($stroka,$arrayStr);
}

?>

