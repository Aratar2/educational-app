<?php
        header("Content-Type: text/html; charset=utf-8");

require_once "auth_validation.php";


require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";
$editUrl="";

	////Редактирование записи
 if (isset($_REQUEST['edit']))
  {

   $editUrl=$_REQUEST['edit'];
$result = mysql_query("SELECT * FROM `informBD` WHERE `adrees`='$editUrl'");
$row = mysql_fetch_array($result);


  }
     ////Редактирование записи



  if(isset($_POST['messageBtn']) && isset($_REQUEST['messageBtn']))
{

$editName=$_POST['name'];
$messageEdit=$_POST['messageEdit'];

$messageEdit=base64_encode($messageEdit);
$adreesName=$_REQUEST["messageBtn"];
$result = mysql_query ("UPDATE informBD SET description='$messageEdit', name='$editName' WHERE adreesName='$adreesName'");
if ($result == 'true'){
createPage($editName,$adreesName,base64_decode($messageEdit));
header("location: /admin/all_theory.php");
exit;
	}
}	

	
 
  function createPage($nameTitle,$name,$msg) {
   $file = $_SERVER['DOCUMENT_ROOT']."/pages/".$name.".html";
$content = "
<html>
<head>
<title>$nameTitle</title>
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

<span class=\"name\">$nameTitle</span>
$msg

</div>

</body>
</html>


";
$fp = fopen($file, "w");
fwrite($fp, $content);
fclose($fp);
  }
   
?>
 

<html>
<head>
<title>Редактирование темы</title>
 
 <script src="/tinymce/js/tinymce/tinymce.min.js"></script>
 <script src="/tinymce/js/tinymce/jquery.tinymce.min.js"></script>

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
	<h3>Редактирование темы</h3>

	<br>
	
<form action= "" method= "POST"> 
  
  <br>
    Название:
 <p><input type="text" name="name" value="<?php echo $row["name"]; ?>" placeholder="Например: Химия" required></p>
 <br>
  Содержание страницы:
<p> <textarea rows= "10" cols= "45"  name= "messageEdit" id="messageEdit"> <?php echo base64_decode($row["description"]); ?></textarea></p> 

 <br>
 <center>
 <button class="button" type= "submit" name="messageBtn" value="<?php echo $row["adreesName"]; ?>">Изменить</button>
<center>
 <br>
</form>
	
	
	
	</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2016
</div>
</div>
</body>



    <script type="text/javascript">
 tinymce.init({
  selector: '#messageEdit',  // note the comma at the end of the line!
  theme: 'modern',
  
	language:"ru",
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
 
}); 
   </script>

</html>