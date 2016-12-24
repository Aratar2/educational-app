<?php
  header("Content-Type: text/html; charset=utf-8");

require_once "auth_validation.php";
require_once $_SERVER['DOCUMENT_ROOT']."/db_config.php";

if(isset($_POST['saveInvite']) && isset($_POST['invite'])  && !empty($_POST['invite']))
{
	$invite=$_POST['invite'];
	$resultInv = mysql_query ("UPDATE invitebd SET  invite='$invite' WHERE id='1'");
}

if(isset($_POST['savePass']) && isset($_POST['pass']) && isset($_POST['newPass'])  && !empty($_POST['pass']) && !empty($_POST['newPass']))
{
	$pass=$_POST['pass'];
	$newPass=$_POST['newPass'];

	$pass = md5($pass);//шифруем введенный пароль
	$newPass = md5($newPass);//шифруем введенный пароль

$resultAdm = mysql_query("SELECT `pass` FROM `admin` WHERE `login`='admin'");
$rowAdm = mysql_fetch_array($resultAdm);
 if($rowAdm['pass']  == $pass) {
	$resultPass = mysql_query ("UPDATE admin SET  pass='$newPass' WHERE pass='$pass'");
	if ($resultPass == 1){
		//header("location: /admin/all_theory.php");
		//exit;
	}
 }
}

$result = mysql_query("SELECT * FROM `invitebd` WHERE `id`='1'");
$row = mysql_fetch_array($result);

?>
<html>
<head>
<title>Настройки</title>
    <style>
    #width_td{
      width:30%;
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
	<h3>Настройки</h3>

		<br>
		<h2>Смена инвайта</h2>
		<form action="" method="post">

		<label>Инвайт: <input style="margin-left: 4.5em" type="text"  name="invite" value="<?php echo $row['invite']; ?>"></label>
			<br>
		<button class="button" style="margin-top: 0.7em" type= "submit" name="saveInvite">Поменять инвайт</button>

		</form>
		<br>
		<h2>Смена пароля</h2>
		<form action="" method="post">
			<label>Текущий пароль: <input style="margin-left: 0.7em" type="text" name="pass" ></label>
			<br>
			<label>Новый пароль: <input style="margin-left: 1.5em; margin-top: 0.7em" type="text" name="newPass" "></label>
			<br>
			<button class="button" style="margin-top: 0.7em" type= "submit" name="savePass">Поменять пароль</button>

		</form>
		<?
		if ($resultPass == 1){
        echo '<div style="padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px; color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;">Пароль изменен</div>';
		$resultPass=0;
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