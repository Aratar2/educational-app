<?php
  header("Content-Type: text/html; charset=utf-8");
  require_once "auth_validation.php";
?>
<html>
<head>
<title>Добавить тему</title>
 <script src="/tinymce/js/tinymce/tinymce.min.js"></script>
 <script src="/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> 
<link rel="stylesheet" type="text/css" href="/css/style.css"> 
</head>
<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
		Администратор<br>
		 <a href="config.php">Настройки</a> | <a href="logout.php">Выйти</a>
		</div>
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
	<h3>Добавление темы</h3>
	<br>
	<form action= "postBD.php" method= "POST"> 
<h2>Название:</h2>
 <p><input type="text" name="name" value="" placeholder="Например: Химия" required></p>
 <br>
<h2>Содержание страницы:</h2>
<p> <textarea rows= "10" cols= "45"  name= "message" id="message"></textarea></p> 
 <br>
 <center>
<input type= "submit" class="button" value= "Добавить" required>
</center>
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
  selector: '#message',  
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