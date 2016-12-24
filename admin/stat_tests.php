<?php
  header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
?>
<html>
<head>
<title>Статистика по тестам</title>
   

<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="/css/style.css"> <!--pemanggilan file css-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
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
	<h3>Статистика по тестам</h3>
	
	
	<?php


require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";
  
 
 
   ////Удаление записи
  if (isset($_REQUEST['delete']))
  {
  $id=$_REQUEST['delete'];
 $result=mysql_query("DELETE FROM `tests_result` WHERE `id`='$id'")or die(mysql_error());
  }
   ////Удаление записи
 
  
  
  
  


 
$result = mysql_query("SELECT *FROM tests_result ORDER BY `id`") or die(mysql_error());
echo "<br>";
	echo "<table>";
	echo "<tr class=\"data\">";

	//////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "№";
	echo "</th>";
	//////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "Код теста";
	echo "</th>";
	//////////
	echo "<th class=\"data\"  align=\"center\" >";
	echo "Логин";
	echo "</th>";
	//////////
	echo "<th class=\"data\"  align=\"center\" >";
	echo "Имя";
	echo "</th>";
	//////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "Группа";
	echo "</th>";
	///////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "Результат";
	echo "</th>";
	///////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "Дата";
	echo "</th>";
	///////////
	echo "<th class=\"data\" align=\"center\" >";
	echo "";
	echo "</th>";
	///////////

	$i=1;
	echo "</tr>";
	$grafDate = array();
	while ($row = mysql_fetch_array($result)) {


		echo "<tr class=\"data\">";

		echo "<td class=\"data\" align=\"center\">";
		echo $i;
		echo "</td>";

		echo "<td class=\"data\" align=\"center\">";
		echo $row["kod_test"];
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";
		echo $row["login"];
		$grafDate[$i - 1]['login'] = $row["login"];
		echo "</td>";


		echo "<td  class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
		echo $row["fullname"];
		echo "</div>";
		echo "</td>";


		echo "<td class=\"data\" align=\"center\">";
		echo $row["groups"];
		echo "</td>";

		echo "<td class=\"data\" align=\"center\">";
		echo $row["result"];
		$grafDate[$i - 1]['result'] = substr($row["result"], 0, strpos($row["result"], "%"));
		echo "</td>";

		echo "<td class=\"data\" align=\"center\">";

		$dt_elements = explode(' ',$row["created_at"]);
		$date_elements = explode('-',$dt_elements[0]);
		$time_elements =  explode(':',$dt_elements[1]);
		echo $date_elements[2]."-".$date_elements[1]."-".$date_elements[0];
		echo "<br>";
		echo $time_elements[0].":".$time_elements[1].":".$time_elements[2];


		echo "</td>";


		echo "<td class=\"data\"  align=\"center\">";



		echo "<form class=\"form_style\"   action= \"test_result_prev.php\" method= \"POST\">";
		echo "<input type= \"hidden\" name= \"name_student\" value='".$row["fullname"]."''>";
		echo "<button class=\"button\" title=\"Посмотреть отчет\" type= \"submit\" name=prev value=".$row["id"]."><img src=\"/css/img/prev.png\" width=\"20px\" ></button>";
		echo "</form>";






		echo "<form class=\"form_style\" action= \"\" method= \"POST\">";

		echo "<button class=\"button\" title=\"Удалить\" type= \"submit\" name=delete value=".$row["id"]."><img src=\"/css/img/delete.png\" width=\"20px\" ></button>";
		echo "</form>";

		echo "</td>";


		echo "</tr>";
		$i=$i+1;
	}


	echo "</table>";

?>
	<br>
		<h3>График успеваемости</h3>
		<br>
				<div class="ct-chart" style="height: 400px; width: 730px">
				</div>

				<script>
					var grafDate = <?php echo json_encode($grafDate);?>;
					var labels = [];
					var series = [];
					$.each(grafDate, function( index, value ) {
						labels.push(value.login);
						series.push(value.result);
					});

					new Chartist.Bar('.ct-chart', {
						labels: labels,
						series: [
							series
						]
					}, {
						stackBars: true,
						axisY: {
							labelInterpolationFnc: function(value) {
								return value + '%';
							}
						}
					}).on('draw', function(data) {
						if(data.type === 'bar') {
							data.element.attr({
								style: 'stroke-width: 30px'
							});
						}
					});
				</script>
</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2016
</div>
</div>
</body>
</html>