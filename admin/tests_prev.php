<?php
  header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
?>
<html>
<head>
<title>Тесты</title>
    <style>
    #width_td{
      width:120px;
      word-wrap:break-word;
	  text-align:center;
           }
	</style>

<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="/css/style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
        Администратор<br>
		<a href="config.php">Настройки</a> | <a href="logout.php">Выйти</a>
		</div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">
	<div id="leftBar">
	<ul>
		<li><a href="add_theory.php">Добавить тему</a></li>
		<li><a href="all_theory.php">Добавленные темы</a></li>
		<li><a href="tests.php">Тесты</a></li>
		<li><a href="stat_tests.php">Статистика по тестам</a></li>
	</ul>
	</div>
	<div id="rightContent">
	<?php
  
    

  
 

 
  
  
  
  
    ////Просмотр записи 
  if (isset($_REQUEST['prev']))
  {
 $pid=$_REQUEST['prev'];
 
 include $_SERVER['DOCUMENT_ROOT']."/db_config.php";
 
 $res=mysql_query("SELECT `name` FROM `tests_general` WHERE `pid`='$pid'")or die(mysql_error());
 $rowname = mysql_fetch_array($res);
 
 echo "<center>";
 echo "<h3>";
 echo $rowname['name'];
 echo"</h3>";
 echo "</center>";
 
 $result=mysql_query("SELECT * FROM `test` WHERE `pid`='$pid'")or die(mysql_error());
  
   ////Просмотр записи  
  
echo "<br>";
echo "<table>";

echo "<tr class=\"data\">";

//////////
echo "<th class=\"data\" align=\"center\" >";
echo "№";   
echo "</th>";
//////////
echo "<th class=\"data\"  align=\"center\" >";
echo "Вопрос";
echo "</th>";
//////////
echo "<th class=\"data\"  align=\"center\" >";
echo "Правильный ответ";   
echo "</th>";
//////////
echo "<th class=\"data\" align=\"center\" >";
echo "Вариант ответа";   
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\" >";
echo "Вариант ответа";   
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\" >";
echo "Вариант ответа";   
echo "</th>";
///////////


$i=1;
echo "</tr>";
  while ($row = mysql_fetch_array($result)) {
		
		
		echo "<tr class=\"data\">";
			
        echo "<td class=\"data\" align=\"center\">";
		echo $i;
		echo "</td>";

	    echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
	    echo $row["question"];
		echo "</div>";
	    echo "</td>";
 
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
		echo $row["answer1"];
		echo "</div>";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
        echo $row["answer2"];
		echo "</div>";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
        echo $row["answer3"];
		echo "</div>";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
        echo $row["answer4"];
		echo "</div>";
		echo "</td>";
		
        echo "</tr>";
        $i=$i+1;
    }
	

    echo "</table>";
	
	
	}
?>
		
	</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2016
</div>
</div>
</body>
</html>