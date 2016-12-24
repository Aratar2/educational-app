<?php
  header("Content-Type: text/html; charset=utf-8");
   require_once "auth_validation.php";
   
   require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";
  
  
  if(isset($_POST['add']))
    {
      header("location: admin.php");
      exit;
    }

  if(isset($_POST['prev']) && isset($_REQUEST['prev']))
   {
     $prev=$_REQUEST['prev'];
     header("location:".$prev);
      exit;
   }
   
?>

<html>
<head>
<title>Добавленные темы</title>
    <style>
    #width_td{
      width:150px;
      word-wrap:break-word;
	  text-align:center;
           }
	</style>

<link rel="shortcut icon" href="/stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
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
		<li><a href="/admin/add_theory.php">Добавить тему</a></li>
		<li><a href="/admin/all_theory.php">Добавленные темы</a></li>
		<li><a href="/admin/tests.php">Тесты</a></li>
		<li><a href="/admin/stat_tests.php">Статистика по тестам</a></li>
	    </ul>
	</div>
	<div id="rightContent">
	<h3>Добавленные темы</h3>
	<form action= "" method= "GET">
		<input type="text" style="width: 90%" placeholder="Поиск по названию" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''?>">
		<input type="submit" class="button" value="Поиск">
	</form>
	
	<?php
  
     $ITEM_LIMIT = 10;
     require_once $_SERVER['DOCUMENT_ROOT'].'/components/Pagination.php';
  
 
 
  ////Удаление записи 
  if (isset($_REQUEST['delete']) && isset($logSESS))
  {
   $adrees=$_REQUEST['delete'];
   $result = mysql_query("SELECT * FROM `informbd` WHERE `adrees`='$adrees'");
   $row = mysql_fetch_array($result);
   $adreesName= $row["adreesName"];
   
   mysql_query("DELETE FROM `informbd` WHERE `adrees`='$adrees'"); 
  
   $path=$_SERVER['DOCUMENT_ROOT']."/pages/".$adreesName.".html";

   if (file_exists($path)) 
     {
      unlink($path);
     }

  }
   ////Удаление записи 
 
  
  
  
  
 $offset = 0;
 $page = 1;
 if (isset($_GET['page']))
  {
  		$page = $_GET['page'];
  		$offset =($page - 1) * $ITEM_LIMIT;
  }

$whereSearch = '';
if (isset($_GET['search']))
{
	$whereSearch = " WHERE name LIKE '%{$_GET['search']}%' ";
}

$resultCount = mysql_query("SELECT count(pid) AS count FROM informbd {$whereSearch}");
$rowCount = mysql_fetch_array($resultCount);
$total =  $rowCount['count'];

$pagination = new Pagination($total, $page, $ITEM_LIMIT, '?page=');

$result = mysql_query("SELECT * FROM informbd {$whereSearch} ORDER BY `pid` ASC LIMIT $ITEM_LIMIT OFFSET $offset") or die(mysql_error());
echo "<br>";
echo "<table>";
echo "<tr class=\"data\">";

//////////
echo "<th class=\"data\" align=\"center\" >";
echo "№";   
echo "</th>";
//////////
echo "<th class=\"data\" align=\"center\" >";
echo "Название";   
echo "</th>";
///////////
//echo "<th class=\"data\" align=\"center\">";
//echo "Адрес";       
//echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Описание";      
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "Дата создания";     
echo "</th>";
///////////
echo "<th class=\"data\" align=\"center\">";
echo "";     
echo "</th>";
///////////


$i=0;
echo "</tr>";
  while ($row = mysql_fetch_array($result)) {
		$i=$i+1;
		
		echo "<tr class=\"data\">";
			
        echo "<td class=\"data\" align=\"center\">";
		echo $i;
		echo "</td>";
 
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
		echo $row["name"];
		echo "</div>";
		echo "</td>";
		

		
		echo "<td class=\"data\" align=\"center\">";
		echo "<div id=\"width_td\">";
        echo substr(strip_tags(base64_decode ($row["description"])), 0, 50)."...";
		echo "</div>";
		echo "</td>";
		
		echo "<td class=\"data\" align=\"center\">";

	    $dt_elements = explode(' ',$row["created_at"]);
	    $date_elements = explode('-',$dt_elements[0]);
	    $time_elements =  explode(':',$dt_elements[1]);
	    echo $date_elements[2]."-".$date_elements[1]."-".$date_elements[0];
	    echo "<br>";
	    echo $time_elements[0].":".$time_elements[1].":".$time_elements[2];

	    echo "</td>";
		echo "<td class=\"data\" align=\"center\">";
		echo "<form class=\"form_style\" action= \"edit.php\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Редактировать\" type= \"submit\" name=edit value=".$row["adrees"]."><img src=\"/css/img/edit.png\" width=\"20px\" ></button>";
		echo "</form>";
		
			
		echo "<form class=\"form_style\" action= \"\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Просмотр\" type= \"submit\" name=prev value=\"".$row["adrees"]."\"><img src=\"/css/img/prev.png\" width=\"20px\" ></button>";
		echo "</form>";
		
	
		
		echo "<form class=\"form_style\" action= \"\" method= \"POST\">";
		echo "<button class=\"button\" title=\"Удалить\" type= \"submit\" name=delete value=".$row["adrees"]."><img src=\"/css/img/delete.png\" width=\"20px\" ></button>";
		echo "</form>";
		
	
		echo "</td>";
		
		
        echo "</tr>";
        
    }
 echo "</table>";

?>
<div style="display: <? echo ($total <= $ITEM_LIMIT) ? 'none' : 'block' ?>">
<?= $pagination->get() ?>
</div>
		
	</div>
<div class="clear"></div>
<div id="footer">
	<a href="https://vk.com/aratar2">Абдалиев Айрат </a>  &copy; 2016</div>
</div>
</body>
</html>