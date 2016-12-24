<?php
header("Content-Type: text/html; charset=utf-8");

  session_start();
  $logSESS = $_SESSION['$logSESS'];
  if(isset($logSESS))
  {
    header("location: add_theory.php");
    exit; 
  }

?>

<html>
<head>
<title>Вход</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="arirusmanto.com">
<meta name="description" content="Admin MOS Template">
<meta name="keywords" content="Admin Page">
<meta name="author" content="Ari Rusmanto">
<meta name="language" content="Bahasa Indonesia">

<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="/css/style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>

<div id="loginForm">
	<div class="headLoginForm">
	Вход в  админ-панель:
	</div>
	<div class="fieldLogin">
	<form method="POST" action="login.php">
	<label>Логин</label><br>
	<input type="text" name="login" class="login"><br>
	<label>Пароль</label><br>
	<input type="password" name="pass" class="login"><br>
	<input type="submit" class="button" value="Войти">
	</form>
	</div>
</div>
</body>
</html>