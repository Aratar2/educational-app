<?php
  header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
?>
<html>
<head>
<title>Тесты</title>
    <style>
    #width_td{
      width:150px;
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
	<h3>Тесты</h3>
	
	
	<?php


require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";
  
 
 
   ////Удаление записи 
  if (isset($_REQUEST['delete']))
  {
  $pid=$_REQUEST['delete'];
 $result=mysql_query("DELETE FROM `tests_general` WHERE `pid`='$pid'")or die(mysql_error());
 $result2=mysql_query("DELETE FROM `test` WHERE `pid`='$pid'")or die(mysql_error());
  }
   ////Удаление записи 
 
  

  
  
 

 
$result = mysql_query("SELECT *FROM tests_general ORDER BY `pid`") or die(mysql_error());
echo "<br>";
echo "<table>";
echo "<tr class=\"data\">";

//////////
echo "<th class=\"data\" align=\"center\" >";
echo "№";   
echo "</th>";
//////////
echo "<th class=\"data\"  align=\"center\" >";
echo "Код теста";
echo "</th>";
//////////
echo "<th class=\"data\"  align=\"center\" >";
echo "Название";   
echo "</th>";
//////////
echo "<th class=\"data\" align=\"center\" >";
echo "Количество вопросов";   
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\" >";
echo "";   
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
	    echo $row["pid"];
	    echo "</td>";
		
        
		echo "<td  class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
		echo $row["name"];
		echo "</div>";
		echo "</td>";
		
		
		echo "<td class=\"data\" align=\"center\">";
        echo $row["count_qwestion"];
		echo "</td>";
		
		
		
		
		echo "<td class=\"data\"  align=\"center\">";
        
		echo "<form class=\"form_style\"  action= \"edit_test.php\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Редактировать\"   type= \"submit\" name=edit value=".$row["pid"]."><img src=\"/css/img/edit.png\" width=\"20px\" ></button>";
		echo "</form>";
		
			
	
			
		
		echo "<form class=\"form_style\"   action= \"tests_prev.php\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Просмотр\" type= \"submit\" name=prev value=".$row["pid"]."><img src=\"/css/img/prev.png\" width=\"20px\" ></button>";
		echo "</form>";
		
			
			

			
		
		echo "<form class=\"form_style\" action= \"\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Удалить\" type= \"submit\" name=delete value=".$row["pid"]."><img src=\"/css/img/delete.png\" width=\"20px\" ></button>";
		echo "</form>";
	
		echo "</td>";
		
		
        echo "</tr>";
        $i=$i+1;
    }
	
	echo "<form action= \"add_test.php\" method= \"POST\" >";
	echo "<tr class=\"data\">";
			
    echo "<td class=\"data\" align=\"center\">";
	echo "";
	echo "</td>";

	echo "<td class=\"data\" align=\"center\">";
	echo "                               ";
	echo "</td>";
 
	echo "<td class=\"data\" align=\"center\">";
	echo "<input type= \"text\" name= \"name\"  placeholder=\"Введите название\"  id=\"pole\" required>";
	echo "</td>";
		
	echo "<td class=\"data\" align=\"center\">";
	echo "<input type= \"text\" name= \"count_qwestion\" placeholder=\"Введите кол-во вопросов\" id=\"pole\" required>";
	echo "</td>";

	
		
		
		
		
	echo "<td class=\"data\" align=\"center\">";
	echo "<input class=\"button\" type= \"submit\" name=\"add_test\" value= \"Добавить тест\">";
    echo "</td>";
	
    echo "</tr>";
	
	echo "</form>";

    echo "</table>";

?>
		
	</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2016
</div>
</div>
</body>
</html>