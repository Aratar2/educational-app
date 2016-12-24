<?php
     header("Content-Type: text/html; charset=utf-8");
     require_once "auth_validation.php";
  
  
  if(isset($_POST['add_test'])) {

	  $name = $_POST["name"];
	  $count_qwestion = $_POST['count_qwestion'];

	  if (!empty($name) && !empty($count_qwestion)) {
		  require_once $_SERVER['DOCUMENT_ROOT'] . "/db_config.php";
		  $result = mysql_query("INSERT INTO tests_general(name,count_qwestion) VALUES('$name','$count_qwestion')") or die(mysql_error());

		  $query  = mysql_query("SHOW TABLE STATUS FROM `$dbName` LIKE 'tests_general'");
		  $kod = mysql_result($query, 0, 'Auto_increment');
		  $kod= $kod-1;
	  } else {
		  header("location: tests.php");
		  exit;
	  }

  }
else{
	header("location: tests.php");
	exit;
}

		?>
<!DOCTYPE html>
<html>
<head>
<title>Тесты</title>
    <style>
    #width_td{
      width:110px;
           }
		   #width_quest{
      width:155px;
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
	<h3>Добавление теста</h3>
	<br>



<?php
  ////Удаление записи 

   ////Удаление записи
echo "<table>";
echo "<tr class=\"data\">";

//////////
echo "<th class=\"data\" align=\"center\" >";
echo "№";   
echo "</th>";
//////////
echo "<th class=\"data\" align=\"center\" >";
echo "Вопрос";   
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Правильный ответ";     
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Вариант ответа";     
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Вариант ответа";     
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Вариант ответа";     
echo "</th>";
///////////
echo "</tr>";
?>
		<form action= "test_add2.php?count_qwestion=<?php echo $count_qwestion ?>&kod=<?php echo $kod ?>" method= "POST">
<?php
$i=0;
  while ($i<$count_qwestion) {
		$i=$i+1;
		
		echo "<tr class=\"data\">";
			
        echo "<td class=\"data\" align=\"center\">";
		echo $i;
		echo "</td>";
 
		echo "<td class=\"data\" align=\"center\">";
		echo "<input type= \"text\" name= \"question".$i."\"  id=\"width_quest\" >";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
        echo "<input type= \"text\" name= \"answer1".$i."\"  id=\"width_td\">";
		echo "</td>";
		

		echo "<td class=\"data\" align=\"center\">";
        echo "<input type= \"text\" name= \"answer2".$i."\"  id=\"width_td\">";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
        echo "<input type= \"text\" name= \"answer3".$i."\"  id=\"width_td\">";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
        echo "<input type= \"text\" name= \"answer4".$i."\"  id=\"width_td\">";
		echo "</td>";
		
        echo "</tr>";
        
    }

	
	
	
 echo "</table>";
     
?>
<center>

   <br>
<input type= "submit" class="button" name="add_test2" value= "Сохранить">
</form>
</center>

</div>
<div class="clear"></div>
<div id="footer">
	<a href="https://vk.com/aratar2">Абдалиев Айрат </a>  &copy; 2016</div>
</div>
</body>
</html>



